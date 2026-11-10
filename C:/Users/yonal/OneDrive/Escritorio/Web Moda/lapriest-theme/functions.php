<?php
/**
 * Funciones y Definiciones del Tema LAPRIEST
 * Arquitectura de Moda de Lujo (Brutalismo Oscuro / Editorial / Sistema de Oferta Directa)
 *
 * @package LAPRIEST
 * @version 1.0.0
 */

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

define('LAPRIEST_VERSION', '1.0.0');
define('LAPRIEST_DIR', get_template_directory());
define('LAPRIEST_URI', get_template_directory_uri());

/* ==========================================================================
   1. CONFIGURACIÓN DEL TEMA Y SOPORTES
   ========================================================================== */

function lapriest_theme_setup() {
    load_theme_textdomain('lapriest', LAPRIEST_DIR . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    // Tamaños de imagen para estética editorial (proporción vertical Rick Owens)
    add_image_size('lapriest-editorial-hero', 1920, 1080, true);
    add_image_size('lapriest-editorial-card', 1200, 800, true);
    add_image_size('lapriest-piece-portrait', 900, 1350, true); // Proporción 2:3 vertical
    add_image_size('lapriest-piece-square', 800, 800, true);

    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));

    add_theme_support('custom-logo', array(
        'height'      => 60,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ));

    // Menús de navegación
    register_nav_menus(array(
        'primary_menu' => esc_html__('Navegación Editorial Principal', 'lapriest'),
        'footer_menu'  => esc_html__('Navegación de Dossier en Pie de Página', 'lapriest'),
    ));
}
add_action('after_setup_theme', 'lapriest_theme_setup');

/* ==========================================================================
   2. CARGA DE HOJAS DE ESTILO Y SCRIPTS
   ========================================================================== */

function lapriest_enqueue_assets() {
    // Fuentes: SF Pro Display (Opción 3 oficial para títulos) + Colección Google Fonts
    wp_enqueue_style(
        'lapriest-font-sfpro',
        'https://fonts.cdnfonts.com/css/sf-pro-display',
        array(),
        null
    );

    wp_enqueue_style(
        'lapriest-fonts',
        'https://fonts.googleapis.com/css2?family=Archivo:wght@400;600;700;800;900&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,700;1,9..40,400&family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@300;400;500;600;700&family=Syne:wght@400;700;800&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;0,700;1,400&display=swap',
        array(),
        null
    );

    wp_enqueue_style(
        'lapriest-main',
        LAPRIEST_URI . '/assets/css/main.css',
        array(),
        LAPRIEST_VERSION
    );

    wp_enqueue_style('lapriest-style', get_stylesheet_uri(), array('lapriest-main'), LAPRIEST_VERSION);

    wp_enqueue_script(
        'lapriest-main-js',
        LAPRIEST_URI . '/assets/js/main.js',
        array(),
        LAPRIEST_VERSION,
        true
    );

    // Configuración y textos dinámicos en español neutral para el modal y llamadas AJAX
    wp_localize_script('lapriest-main-js', 'lapriest_data', array(
        'ajax_url'   => admin_url('admin-ajax.php'),
        'nonce'      => wp_create_nonce('lapriest_offer_nonce'),
        'brand_name' => 'LAPRIEST',
        'i18n'       => array(
            'sending'       => esc_html__('TRANSMITIENDO OFERTA AL ATELIER...', 'lapriest'),
            'success_title' => esc_html__('OFERTA REGISTRADA', 'lapriest'),
            'success_desc'  => esc_html__('Su propuesta de adquisición ha sido recibida directamente por el atelier de la marca. Nuestra dirección curatorial evaluará los detalles y responderá en un plazo máximo de 24 horas.', 'lapriest'),
            'error_title'   => esc_html__('ERROR EN LA TRANSMISIÓN', 'lapriest'),
            'error_desc'    => esc_html__('Por favor verifique los campos obligatorios o comuníquese directamente con el atelier vía Instagram @lapriest_studio.', 'lapriest'),
        )
    ));
}
add_action('wp_enqueue_scripts', 'lapriest_enqueue_assets');

/* ==========================================================================
   3. TIPOS DE CONTENIDO PERSONALIZADOS (CPT)
   ========================================================================== */

function lapriest_register_custom_post_types() {
    // CPT 1: PIEZAS DEL CATÁLOGO (Garments / Catalog Pieces)
    $labels_pieces = array(
        'name'                  => _x('Piezas del Catálogo', 'Nombre general del tipo de contenido', 'lapriest'),
        'singular_name'         => _x('Pieza del Catálogo', 'Nombre singular', 'lapriest'),
        'menu_name'             => _x('Catálogo de Piezas', 'Menú del Administrador', 'lapriest'),
        'name_admin_bar'        => _x('Pieza de Catálogo', 'Añadir en barra superior', 'lapriest'),
        'add_new'               => __('Añadir Nueva Pieza', 'lapriest'),
        'add_new_item'          => __('Añadir Nueva Pieza al Catálogo', 'lapriest'),
        'new_item'              => __('Nueva Pieza', 'lapriest'),
        'edit_item'             => __('Editar Pieza', 'lapriest'),
        'view_item'             => __('Ver Pieza', 'lapriest'),
        'all_items'             => __('Todas las Piezas', 'lapriest'),
        'search_items'          => __('Buscar Piezas', 'lapriest'),
        'not_found'             => __('No se encontraron piezas en el catálogo.', 'lapriest'),
        'not_found_in_trash'    => __('No hay piezas en la papelera.', 'lapriest'),
    );

    $args_pieces = array(
        'labels'             => $labels_pieces,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'pieza', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => 'catalogo',
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-tag',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('catalog_piece', $args_pieces);

    // Taxonomía: Categorías de Piezas
    register_taxonomy('piece_category', array('catalog_piece'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'          => __('Categorías de Piezas', 'lapriest'),
            'singular_name' => __('Categoría de Pieza', 'lapriest'),
            'search_items'  => __('Buscar Categorías', 'lapriest'),
            'all_items'     => __('Todas las Categorías', 'lapriest'),
            'edit_item'     => __('Editar Categoría', 'lapriest'),
            'update_item'   => __('Actualizar Categoría', 'lapriest'),
            'add_new_item'  => __('Añadir Nueva Categoría', 'lapriest'),
            'new_item_name' => __('Nombre de la Nueva Categoría', 'lapriest'),
            'menu_name'     => __('Categorías', 'lapriest'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'categoria-coleccion'),
        'show_in_rest'      => true,
    ));

    // CPT 2: EDITORIAL Y EVENTOS
    $labels_editorial = array(
        'name'                  => _x('Editorial y Eventos', 'Nombre general', 'lapriest'),
        'singular_name'         => _x('Editorial o Evento', 'Nombre singular', 'lapriest'),
        'menu_name'             => _x('Editorial y Eventos', 'Menú del Administrador', 'lapriest'),
        'name_admin_bar'        => _x('Publicación Editorial', 'Barra superior', 'lapriest'),
        'add_new'               => __('Añadir Publicación', 'lapriest'),
        'add_new_item'          => __('Añadir Nueva Publicación Editorial / Evento', 'lapriest'),
        'new_item'              => __('Nueva Publicación', 'lapriest'),
        'edit_item'             => __('Editar Publicación', 'lapriest'),
        'view_item'             => __('Ver Publicación', 'lapriest'),
        'all_items'             => __('Todas las Publicaciones', 'lapriest'),
        'search_items'          => __('Buscar en Editorial', 'lapriest'),
        'not_found'             => __('No se encontraron artículos editoriales.', 'lapriest'),
        'not_found_in_trash'    => __('No hay artículos en la papelera.', 'lapriest'),
    );

    $args_editorial = array(
        'labels'             => $labels_editorial,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'editorial', 'with_front' => false),
        'capability_type'    => 'post',
        'has_archive'        => 'editoriales',
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-format-gallery',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('editorial_event', $args_editorial);

    // Taxonomía: Tipo de Editorial
    register_taxonomy('editorial_type', array('editorial_event'), array(
        'hierarchical'      => true,
        'labels'            => array(
            'name'          => __('Tipos de Editorial', 'lapriest'),
            'singular_name' => __('Tipo de Editorial', 'lapriest'),
            'menu_name'     => __('Tipos / Etiquetas', 'lapriest'),
        ),
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'tipo-editorial'),
        'show_in_rest'      => true,
    ));
}
add_action('init', 'lapriest_register_custom_post_types');

/* ==========================================================================
   4. METABOXES NATIVOS EN EL PANEL DE WORDPRESS
   ========================================================================== */

function lapriest_add_custom_meta_boxes() {
    add_meta_box(
        'lapriest_piece_details',
        __('Especificaciones de la Prenda y Adquisición LAPRIEST', 'lapriest'),
        'lapriest_render_piece_meta_box',
        'catalog_piece',
        'normal',
        'high'
    );

    add_meta_box(
        'lapriest_editorial_details',
        __('Detalles de Publicación Editorial y Evento LAPRIEST', 'lapriest'),
        'lapriest_render_editorial_meta_box',
        'editorial_event',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'lapriest_add_custom_meta_boxes');

function lapriest_render_piece_meta_box($post) {
    wp_nonce_field('lapriest_save_piece_meta', 'lapriest_piece_meta_nonce');

    $garment_code     = get_post_meta($post->ID, '_lapriest_piece_code', true);
    $base_price       = get_post_meta($post->ID, '_lapriest_base_price', true);
    $season           = get_post_meta($post->ID, '_lapriest_season', true);
    $materials        = get_post_meta($post->ID, '_lapriest_materials', true);
    $edition_limit    = get_post_meta($post->ID, '_lapriest_edition_limit', true);
    $secondary_image  = get_post_meta($post->ID, '_lapriest_secondary_image', true);
    $video_loop_url   = get_post_meta($post->ID, '_lapriest_video_loop_url', true);
    $inquiry_status   = get_post_meta($post->ID, '_lapriest_inquiry_status', true);

    if (empty($inquiry_status)) {
        $inquiry_status = 'available';
    }
    ?>
    <div style="background:#111; color:#eee; padding:18px; border:1px solid #333; font-family:monospace; line-height:1.6;">
        <h4 style="color:#fff; margin-top:0; border-bottom:1px solid #333; padding-bottom:8px; text-transform:uppercase; letter-spacing:1px;">
            // ESPECIFICACIONES DE CATÁLOGO DE LUJO
        </h4>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:14px;">
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">CÓDIGO DE PRENDA (REQUERIDO PARA OFERTAS):</label>
                <input type="text" name="lapriest_piece_code" value="<?php echo esc_attr($garment_code); ?>" placeholder="Ej: LP-FW26-001" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">PRECIO BASE DE ADQUISICIÓN:</label>
                <input type="text" name="lapriest_base_price" value="<?php echo esc_attr($base_price); ?>" placeholder="Ej: $1,850 USD" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:14px;">
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">TEMPORADA / SERIE:</label>
                <input type="text" name="lapriest_season" value="<?php echo esc_attr($season); ?>" placeholder="Ej: SERIE 01 // EL ECLIPSE DE LA ORTODOXIA" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">ESPECIFICACIÓN DE LA EDICIÓN:</label>
                <input type="text" name="lapriest_edition_limit" value="<?php echo esc_attr($edition_limit); ?>" placeholder="Ej: Edición de 12 Piezas a Nivel Mundial — Numeradas a Mano" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
        </div>

        <div style="margin-bottom:14px;">
            <label style="display:block; font-weight:bold; margin-bottom:4px;">PROCEDENCIA Y TEXTURA DE LOS MATERIALES:</label>
            <textarea name="lapriest_materials" rows="2" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;" placeholder="Ej: 100% Lana Cruda Hervida Japonesa de Alta Densidad, Detalles en Cuero de Caballo Toscano Curado al Frío, Cierres de Plata Oxidada"><?php echo esc_textarea($materials); ?></textarea>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:14px;">
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">IMAGEN SECUNDARIA (VISTA PREVIA AL PASAR EL CURSOR):</label>
                <input type="url" name="lapriest_secondary_image" value="<?php echo esc_url($secondary_image); ?>" placeholder="https://..." style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
                <small style="color:#888;">Se muestra al pasar el cursor sobre la prenda en el catálogo.</small>
            </div>
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">VIDEO DE FONDO EN BUCLE (OPCIONAL MP4):</label>
                <input type="url" name="lapriest_video_loop_url" value="<?php echo esc_url($video_loop_url); ?>" placeholder="https://..." style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
                <small style="color:#888;">Bucle de video cinematográfico estilo MUBI para la vista individual.</small>
            </div>
        </div>

        <div>
            <label style="display:block; font-weight:bold; margin-bottom:4px;">ESTADO DE ADQUISICIÓN:</label>
            <select name="lapriest_inquiry_status" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
                <option value="available" <?php selected($inquiry_status, 'available'); ?>>DISPONIBLE PARA ADQUISICIÓN / PROPUESTA</option>
                <option value="reserved" <?php selected($inquiry_status, 'reserved'); ?>>RESERVADA (SOLO LISTA DE ESPERA PRIVADA)</option>
                <option value="archival" <?php selected($inquiry_status, 'archival'); ?>>ARCHIVO PERMANENTE DEL ATELIER (SOLO EXHIBICIÓN)</option>
            </select>
        </div>
    </div>
    <?php
}

function lapriest_render_editorial_meta_box($post) {
    wp_nonce_field('lapriest_save_editorial_meta', 'lapriest_editorial_meta_nonce');

    $event_date     = get_post_meta($post->ID, '_lapriest_event_date', true);
    $event_location = get_post_meta($post->ID, '_lapriest_event_location', true);
    $video_url      = get_post_meta($post->ID, '_lapriest_event_video_url', true);
    $read_time      = get_post_meta($post->ID, '_lapriest_reading_time', true);
    ?>
    <div style="background:#111; color:#eee; padding:18px; border:1px solid #333; font-family:monospace; line-height:1.6;">
        <h4 style="color:#fff; margin-top:0; border-bottom:1px solid #333; padding-bottom:8px; text-transform:uppercase; letter-spacing:1px;">
            // METADATOS DE EDITORIAL / EVENTO
        </h4>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px; margin-bottom:14px;">
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">FECHA / CÓDIGO DE TEMPORADA:</label>
                <input type="text" name="lapriest_event_date" value="<?php echo esc_attr($event_date); ?>" placeholder="Ej: OCTUBRE 2026 // SEMANA DE LA MODA DE PARÍS" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">UBICACIÓN / RECINTO:</label>
                <input type="text" name="lapriest_event_location" value="<?php echo esc_attr($event_location); ?>" placeholder="Ej: Subterráneo Palais de Tokyo, París" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px;">
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">URL DE VIDEO CINEMATOGRÁFICO (VIMEO/MP4):</label>
                <input type="url" name="lapriest_event_video_url" value="<?php echo esc_url($video_url); ?>" placeholder="https://..." style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
            <div>
                <label style="display:block; font-weight:bold; margin-bottom:4px;">FORMATO / DURACIÓN:</label>
                <input type="text" name="lapriest_reading_time" value="<?php echo esc_attr($read_time); ?>" placeholder="Ej: 6 MIN DE LECTURA // PASARELA 4K" style="width:100%; background:#222; color:#fff; border:1px solid #444; padding:8px;">
            </div>
        </div>
    </div>
    <?php
}

function lapriest_save_custom_meta_boxes($post_id) {
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
    if (!current_user_can('edit_post', $post_id)) return;

    if (isset($_POST['lapriest_piece_meta_nonce']) && wp_verify_nonce($_POST['lapriest_piece_meta_nonce'], 'lapriest_save_piece_meta')) {
        $fields = array(
            'lapriest_piece_code'     => '_lapriest_piece_code',
            'lapriest_base_price'     => '_lapriest_base_price',
            'lapriest_season'         => '_lapriest_season',
            'lapriest_materials'      => '_lapriest_materials',
            'lapriest_edition_limit'  => '_lapriest_edition_limit',
            'lapriest_secondary_image' => '_lapriest_secondary_image',
            'lapriest_video_loop_url' => '_lapriest_video_loop_url',
            'lapriest_inquiry_status' => '_lapriest_inquiry_status',
        );

        foreach ($fields as $input_key => $meta_key) {
            if (isset($_POST[$input_key])) {
                update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$input_key]));
            }
        }
    }

    if (isset($_POST['lapriest_editorial_meta_nonce']) && wp_verify_nonce($_POST['lapriest_editorial_meta_nonce'], 'lapriest_save_editorial_meta')) {
        $fields_editorial = array(
            'lapriest_event_date'     => '_lapriest_event_date',
            'lapriest_event_location' => '_lapriest_event_location',
            'lapriest_event_video_url' => '_lapriest_event_video_url',
            'lapriest_reading_time'   => '_lapriest_reading_time',
        );

        foreach ($fields_editorial as $input_key => $meta_key) {
            if (isset($_POST[$input_key])) {
                update_post_meta($post_id, $meta_key, sanitize_text_field($_POST[$input_key]));
            }
        }
    }
}
add_action('save_post', 'lapriest_save_custom_meta_boxes');

// Columnas personalizadas en el panel de administración
function lapriest_piece_columns($columns) {
    $new_columns = array();
    $new_columns['cb'] = $columns['cb'];
    $new_columns['thumbnail'] = __('Visual', 'lapriest');
    $new_columns['title'] = $columns['title'];
    $new_columns['piece_code'] = __('Código de Prenda', 'lapriest');
    $new_columns['base_price'] = __('Precio Base', 'lapriest');
    $new_columns['taxonomy-piece_category'] = __('Categoría', 'lapriest');
    $new_columns['status'] = __('Estado', 'lapriest');
    $new_columns['date'] = $columns['date'];
    return $new_columns;
}
add_filter('manage_catalog_piece_posts_columns', 'lapriest_piece_columns');

function lapriest_piece_custom_columns_content($column, $post_id) {
    switch ($column) {
        case 'thumbnail':
            if (has_post_thumbnail($post_id)) {
                echo get_the_post_thumbnail($post_id, array(50, 75), array('style' => 'object-fit:cover; border:1px solid #333;'));
            } else {
                echo '<span style="color:#666;">—</span>';
            }
            break;
        case 'piece_code':
            $code = get_post_meta($post_id, '_lapriest_piece_code', true);
            echo $code ? '<strong>' . esc_html($code) . '</strong>' : '<span style="color:#666;">N/D</span>';
            break;
        case 'base_price':
            $price = get_post_meta($post_id, '_lapriest_base_price', true);
            echo $price ? esc_html($price) : '<span style="color:#666;">—</span>';
            break;
        case 'status':
            $status = get_post_meta($post_id, '_lapriest_inquiry_status', true);
            echo '<span style="text-transform:uppercase; font-size:11px; letter-spacing:0.5px;">' . esc_html($status) . '</span>';
            break;
    }
}
add_action('manage_catalog_piece_posts_custom_column', 'lapriest_piece_custom_columns_content', 10, 2);

/* ==========================================================================
   5. SISTEMA AJAX DE RECEPCIÓN DE OFERTAS
   ========================================================================== */

function lapriest_handle_offer_submission() {
    if (!check_ajax_referer('lapriest_offer_nonce', 'security', false)) {
        wp_send_json_error(array('message' => __('El token de seguridad ha expirado. Por favor actualice la página.', 'lapriest')));
    }

    $full_name       = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $email           = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $instagram       = isset($_POST['instagram']) ? sanitize_text_field($_POST['instagram']) : '';
    $proposed_offer  = isset($_POST['proposed_offer']) ? sanitize_text_field($_POST['proposed_offer']) : '';
    $reply_method    = isset($_POST['reply_method']) ? sanitize_text_field($_POST['reply_method']) : 'Correo Electrónico';
    $message         = isset($_POST['message']) ? sanitize_textarea_field($_POST['message']) : '';
    $piece_title     = isset($_POST['piece_title']) ? sanitize_text_field($_POST['piece_title']) : 'Pieza no especificada';
    $piece_code      = isset($_POST['piece_code']) ? sanitize_text_field($_POST['piece_code']) : 'LP-ARCHIVO';
    $piece_baseline  = isset($_POST['piece_baseline']) ? sanitize_text_field($_POST['piece_baseline']) : 'N/D';

    if (empty($full_name) || empty($email) || empty($proposed_offer)) {
        wp_send_json_error(array('message' => __('Por favor complete los campos obligatorios (Nombre, Correo y Oferta propuesta).', 'lapriest')));
    }

    $reference_id = 'LP-ACQ-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 6));

    $admin_email = get_option('admin_email');
    $subject = sprintf('[ATELIER LAPRIEST] Propuesta de Adquisición Privada: %s (%s)', $piece_code, $reference_id);

    // Correo HTML en español neutral
    $body = '
    <!DOCTYPE html>
    <html lang="es">
    <head>
      <meta charset="utf-8">
      <style>
        body { background:#0D0D0D; color:#F5F5F5; font-family:"Space Grotesk", Helvetica, Arial, sans-serif; padding:40px 20px; }
        .wrapper { max-width:600px; margin:0 auto; background:#141414; border:1px solid #222; padding:32px; }
        .brand { font-size:24px; letter-spacing:4px; font-weight:800; border-bottom:1px solid #333; padding-bottom:16px; margin-bottom:24px; }
        .badge { background:#222; color:#fff; display:inline-block; padding:4px 10px; font-size:11px; letter-spacing:2px; margin-bottom:20px; }
        .field-row { margin-bottom:16px; border-bottom:1px solid #1c1c1c; padding-bottom:12px; }
        .label { font-size:11px; text-transform:uppercase; letter-spacing:1.5px; color:#888; margin-bottom:4px; }
        .value { font-size:16px; color:#F5F5F5; font-weight:500; }
        .offer-val { font-size:26px; color:#FFFFFF; font-weight:700; letter-spacing:1px; }
        .footer { margin-top:32px; font-size:11px; color:#555; text-transform:uppercase; letter-spacing:2px; text-align:center; }
      </style>
    </head>
    <body>
      <div class="wrapper">
        <div class="brand">L A P R I E S T</div>
        <div class="badge">DOSSIER OFICIAL DE CONSULTA // ' . esc_html($reference_id) . '</div>
        
        <div class="field-row">
          <div class="label">PRENDA SOLICITADA</div>
          <div class="value">' . esc_html($piece_title) . ' (' . esc_html($piece_code) . ')</div>
        </div>

        <div class="field-row">
          <div class="label">PRECIO BASE DE CATÁLOGO</div>
          <div class="value">' . esc_html($piece_baseline) . '</div>
        </div>

        <div class="field-row">
          <div class="label">OFERTA DE ADQUISICIÓN PROPUESTA</div>
          <div class="offer-val">$' . esc_html($proposed_offer) . ' USD</div>
        </div>

        <div class="field-row">
          <div class="label">NOMBRE COMPLETO DEL CLIENTE</div>
          <div class="value">' . esc_html($full_name) . '</div>
        </div>

        <div class="field-row">
          <div class="label">CORREO ELECTRÓNICO</div>
          <div class="value"><a href="mailto:' . esc_attr($email) . '" style="color:#FFF;">' . esc_html($email) . '</a></div>
        </div>

        <div class="field-row">
          <div class="label">CUENTA DE INSTAGRAM</div>
          <div class="value">' . ($instagram ? esc_html($instagram) : 'No especificada') . '</div>
        </div>

        <div class="field-row">
          <div class="label">CANAL DE RESPUESTA PREFERIDO</div>
          <div class="value">' . esc_html($reply_method) . '</div>
        </div>

        <div class="field-row">
          <div class="label">NOTAS DEL CLIENTE / MEDIDAS</div>
          <div class="value">' . ($message ? nl2br(esc_html($message)) : 'Sin notas adicionales.') . '</div>
        </div>

        <div class="footer">
          REGISTRO CONFIDENCIAL DEL ATELIER // TRANSMITIDO MEDIANTE EL SISTEMA DE OFERTA DIRECTA LAPRIEST
        </div>
      </div>
    </body>
    </html>';

    $headers = array(
        'Content-Type: text/html; charset=UTF-8',
        'From: Atelier LAPRIEST <' . $admin_email . '>',
        'Reply-To: ' . $full_name . ' <' . $email . '>'
    );

    wp_mail($admin_email, $subject, $body, $headers);

    wp_send_json_success(array(
        'reference_id' => $reference_id,
        'piece_code'   => $piece_code,
        'message'      => sprintf(__('La propuesta para %s ha sido registrada con éxito. Código de referencia: %s', 'lapriest'), $piece_code, $reference_id)
    ));
}
add_action('wp_ajax_lapriest_submit_offer', 'lapriest_handle_offer_submission');
add_action('wp_ajax_nopriv_lapriest_submit_offer', 'lapriest_handle_offer_submission');

/* ==========================================================================
   6. CREACIÓN AUTOMÁTICA DE PÁGINAS PRINCIPALES AL ACTIVAR EL TEMA
   ========================================================================== */

function lapriest_on_theme_activation() {
    $home_page = get_page_by_path('inicio');
    if (!$home_page) {
        $home_id = wp_insert_post(array(
            'post_title'     => 'Inicio',
            'post_name'      => 'inicio',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '<!-- Portal Editorial LAPRIEST -->',
        ));
        update_option('show_on_front', 'page');
        update_option('page_on_front', $home_id);
    }

    $catalog_page = get_page_by_path('catalogo');
    if (!$catalog_page) {
        $cat_id = wp_insert_post(array(
            'post_title'     => 'Catálogo',
            'post_name'      => 'catalogo',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '<!-- Archivo de Catálogo LAPRIEST -->',
        ));
        update_post_meta($cat_id, '_wp_page_template', 'page-catalog.php');
    }

    $about_page = get_page_by_path('quien-soy');
    if (!$about_page) {
        $about_id = wp_insert_post(array(
            'post_title'     => 'Quién Soy',
            'post_name'      => 'quien-soy',
            'post_status'    => 'publish',
            'post_type'      => 'page',
            'post_content'   => '<!-- Manifiesto de Marca y Filosofía del Creador -->',
        ));
        update_post_meta($about_id, '_wp_page_template', 'page-quien-soy.php');
    }

    lapriest_register_custom_post_types();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'lapriest_on_theme_activation');

/* ==========================================================================
   7. DATOS DE EJEMPLO DE ALTA COSTURA EN ESPAÑOL NEUTRAL
   ========================================================================== */

function lapriest_get_sample_pieces() {
    return array(
        array(
            'title'       => 'PIEZA 01: CAFTÁN DRAPEADO OBSIDIANA',
            'code'        => 'LP-FW26-001',
            'price'       => '$1,850 USD',
            'category'    => 'Abrigos y Capas',
            'season'      => 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA',
            'materials'   => '100% Lana Cruda Hervida Japonesa de Alta Densidad, Arnés Interno en Cupro, Cierre de Acero Oxidado al Frío.',
            'edition'     => 'Edición de 09 Piezas a Nivel Mundial — Cortado a Mano en el Atelier de París',
            'image'       => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1200&q=85',
            'hover_image' => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1200&q=85',
            'excerpt'     => 'Volumen arquitectónico drapeado sobre el torso con severidad monástica. Silueta fluida confeccionada en paño continuo de orillo vivo.',
        ),
        array(
            'title'       => 'PIEZA 02: CAPARAZÓN DE CUERO BRUTALISTA',
            'code'        => 'LP-FW26-002',
            'price'       => '$2,650 USD',
            'category'    => 'Cuero y Prendas Pesadas',
            'season'      => 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA',
            'materials'   => 'Cuero de Caballo Crudo al Vegetal (1.8mm), Pátina Carbón Desgastada, Cortes Geométricos con Bordes Vivos.',
            'edition'     => 'Edición de 06 Piezas a Nivel Mundial — Grabadas con Sello en el Cuero',
            'image'       => 'https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&fit=crop&w=1200&q=85',
            'hover_image' => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=1200&q=85',
            'excerpt'     => 'Un exoesqueleto anatómico esculpido. Moldeado en húmedo sobre torsos de madera y curado en aceites durante 45 días en la Toscana.',
        ),
        array(
            'title'       => 'PIEZA 03: TRENCH ASIMÉTRICO MONOLÍTICO',
            'code'        => 'LP-FW26-003',
            'price'       => '$1,420 USD',
            'category'    => 'Abrigos y Capas',
            'season'      => 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA',
            'materials'   => 'Sarga Cruda Japonesa Encerada, Fornituras Industriales en Zinc, Solapas con Interior en Lana.',
            'edition'     => 'Edición de 15 Piezas a Nivel Mundial',
            'image'       => 'https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=1200&q=85',
            'hover_image' => 'https://images.unsplash.com/photo-1529139574466-a303027c1d8b?auto=format&fit=crop&w=1200&q=85',
            'excerpt'     => 'Largo extremo con solapa envolvente para cuello alto y hombros caídos con arquitectura monolítica.',
        ),
        array(
            'title'       => 'PIEZA 04: TÚNICA CEREMONIAL PLISADA',
            'code'        => 'LP-SS26-004',
            'price'       => '$890 USD',
            'category'    => 'Sastrería y Túnicas',
            'season'      => 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA',
            'materials'   => 'Mezcla de Seda y Lana Crepé (450gsm), Tinte Negro Carbón Mate, Dobladillo Deshilachado en Diagonal.',
            'edition'     => 'Edición de 18 Piezas a Nivel Mundial',
            'image'       => 'https://images.unsplash.com/photo-1485230895905-ec40ba36b9bc?auto=format&fit=crop&w=1200&q=85',
            'hover_image' => 'https://images.unsplash.com/photo-1469334031218-e382a71b716b?auto=format&fit=crop&w=1200&q=85',
            'excerpt'     => 'Prenda ceremonial deconstruida con pliegues tipo acordeón que caen diagonalmente cruzando el pecho.',
        ),
        array(
            'title'       => 'PIEZA 05: PANTALÓN ESCULPIDO GEOMÉTRICO',
            'code'        => 'LP-SS26-005',
            'price'       => '$780 USD',
            'category'    => 'Sastrería y Túnicas',
            'season'      => 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA',
            'materials'   => 'Franela Pesada de Lana Virgen, Fuelles Invertidos Profundos, Doble Ajuste con Aros de Plata.',
            'edition'     => 'Edición de 20 Piezas a Nivel Mundial',
            'image'       => 'https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=85',
            'hover_image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=1200&q=85',
            'excerpt'     => 'Tiro caído esculpido con pinzas anatómicas diseñadas para caer elegantemente sobre el calzado sin arrastrar.',
        ),
        array(
            'title'       => 'PIEZA 06: BOTA MILITAR DE ARCHIVO DE ATELIER',
            'code'        => 'LP-FW26-006',
            'price'       => '$1,150 USD',
            'category'    => 'Calzado y Accesorios',
            'season'      => 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA',
            'materials'   => 'Cuero Vacuno Flor Entera, Suela Vibram Commando con Vira Goodyear, Cremallera Interna en Titanio.',
            'edition'     => 'Edición de 12 Pares Confeccionados en Civitanova Marche',
            'image'       => 'https://images.unsplash.com/photo-1520639888713-7851133b1ed0?auto=format&fit=crop&w=1200&q=85',
            'hover_image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?auto=format&fit=crop&w=1200&q=85',
            'excerpt'     => 'Bota de combate de proporciones monolíticas con banda de rodadura agresiva y lengüeta brutalista extendida.',
        ),
    );
}

function lapriest_get_sample_editorials() {
    return array(
        array(
            'title'     => 'NOCTURNO EN PALAIS DE TOKYO: PASARELA SERIE 01',
            'type'      => 'Pasarela',
            'date'      => 'OCTUBRE 2026 // SEMANA DE LA MODA DE PARÍS',
            'location'  => 'Subterráneo Palais de Tokyo, 75116 París',
            'read_time' => '6 MIN DE RECORRIDO // 4K VISUAL',
            'image'     => 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1600&q=85',
            'excerpt'   => 'Cámaras subterráneas de hormigón resonando con frecuencias sonoras industriales. Una procesión litúrgica de siluetas de lana cruda en penumbra absoluta.',
        ),
        array(
            'title'     => 'SOBRE LA PROPORCIÓN BRUTALISTA: DIÁLOGO CON 032c',
            'type'      => 'Exposición',
            'date'      => 'SEPTIEMBRE 2026 // BERLÍN',
            'location'  => 'Galería St. Agnes / Taller 032c, Berlín',
            'read_time' => '8 MIN DE ENSAYO Y CONVERSACIÓN',
            'image'     => 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1600&q=85',
            'excerpt'   => 'Por qué la alta moda debe abandonar la rueda del consumo desechable para concebir cada prenda como una escultura permanente e inmutable.',
        ),
        array(
            'title'     => 'LA SUITE DE FABRICACIÓN: PÁTINAS DE CUERO EN TOSCANA',
            'type'      => 'Notas del Atelier',
            'date'      => 'AGOSTO 2026 // FLORENCIA',
            'location'  => 'Atelier Santa Croce, Toscana',
            'read_time' => '4 MIN DE PROCESO ARTESANAL',
            'image'     => 'https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&fit=crop&w=1600&q=85',
            'excerpt'   => 'Detrás del proceso de curado en frío. Documentamos el ciclo de 45 días necesario para transformar los cueros crudos en la chaqueta Caparazón.',
        ),
        array(
            'title'     => 'BANDA SONORA 001: RUIDO RITUAL PARA MONOLITOS',
            'type'      => 'Paisaje Sonoro',
            'date'      => 'JULIO 2026 // TOKIO',
            'location'  => 'Subterráneo Daikanyama, Tokio',
            'read_time' => '48 MIN DE GRABACIÓN',
            'image'     => 'https://images.unsplash.com/photo-1539571696357-5a69c17a67c6?auto=format&fit=crop&w=1600&q=85',
            'excerpt'   => 'Una edición en vinilo de archivo compuesta exclusivamente para la presentación en pasarela de la Colección 001 mediante sintetizadores analógicos.',
        ),
    );
}
