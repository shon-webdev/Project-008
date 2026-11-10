<?php
/**
 * Plantilla Individual: Pieza del Catálogo
 * Presentación inmersiva vertical estilo Rick Owens y portal de oferta directa
 *
 * @package LAPRIEST
 */

get_header();

while (have_posts()) : the_post();
    $piece_id = get_the_ID();
    $piece_code = get_post_meta($piece_id, '_lapriest_piece_code', true) ?: 'LP-FW26-' . sprintf('%03d', $piece_id);
    $base_price = get_post_meta($piece_id, '_lapriest_base_price', true) ?: '$1,850 USD';
    $season = get_post_meta($piece_id, '_lapriest_season', true) ?: 'SERIE 01 // EL ECLIPSE DE LA ORTODOXIA';
    $materials = get_post_meta($piece_id, '_lapriest_materials', true) ?: '100% Lana Cruda Hervida Japonesa de Alta Densidad, Arnés Interno en Cupro, Cierres de Plata con Pátina Fría.';
    $edition_limit = get_post_meta($piece_id, '_lapriest_edition_limit', true) ?: 'Edición Estricta de 09 Piezas a Nivel Mundial — Confeccionada a Mano en París';
    $secondary_img = get_post_meta($piece_id, '_lapriest_secondary_image', true);
    $status = get_post_meta($piece_id, '_lapriest_inquiry_status', true) ?: 'available';

    $status_label = 'DISPONIBLE PARA OFERTA';
    if ($status === 'reserved') $status_label = 'RESERVADA';
    elseif ($status === 'archival') $status_label = 'ARCHIVO DE ATELIER';

    $terms = get_the_terms($piece_id, 'piece_category');
    $cat_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Abrigos';

    $primary_img = get_the_post_thumbnail_url($piece_id, 'full');
    if (!$primary_img) {
        $primary_img = 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1400&q=90';
    }
    if (!$secondary_img) {
        $secondary_img = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1400&q=90';
    }
?>

<main id="primary" class="site-main" style="padding-top: clamp(180px, 15vh, 220px); padding-bottom: 8rem;">
  <div class="container">
    
    <!-- Barra de Navegación y Estado -->
    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1px solid var(--border-subtle); padding-bottom:1rem; margin-bottom:3rem;">
      <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="mono-meta">
        &larr; <?php esc_html_e('VOLVER AL CATÁLOGO RAZONADO', 'lapriest'); ?>
      </a>
      <span class="mono-meta"><?php echo esc_html($piece_code); ?> // <?php echo esc_html($status_label); ?></span>
    </div>

    <!-- Presentación Editorial a Dos Columnas -->
    <div class="single-piece-layout">
      
      <!-- Columna de Galería Visual Vertical -->
      <div>
        <div style="border:1px solid var(--border-subtle); margin-bottom:2rem; background:#070707;">
          <img src="<?php echo esc_url($primary_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?> Principal" style="width:100%; height:auto; filter:contrast(1.08) grayscale(0.85);">
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:1.5rem; margin-bottom:2rem;">
          <div style="border:1px solid var(--border-subtle); background:#070707;">
            <img src="<?php echo esc_url($secondary_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?> Detalle" style="width:100%; height:auto; filter:contrast(1.1) grayscale(0.4);">
          </div>
          <div style="border:1px solid var(--border-subtle); background:#070707; display:flex; flex-direction:column; justify-content:center; padding:2rem;">
            <span class="mono-meta" style="color:var(--text-muted); margin-bottom:1rem;">// NOTA DE ARCHIVO</span>
            <p style="font-size:0.875rem; color:#aaa; line-height:1.7;">
              <?php esc_html_e('Cada prenda se corta individualmente a partir de rollos continuos de tela con orillo sin procesar para evitar cortes estructurales innecesarios. Las variaciones de textura son señas intencionales de su confección artesanal.', 'lapriest'); ?>
            </p>
          </div>
        </div>
      </div>

      <!-- Columna Fija: Especificaciones y Terminal de Oferta -->
      <aside class="single-piece-sidebar">
        <div class="mono-meta" style="color:var(--text-muted); margin-bottom:0.5rem;">
          <?php echo esc_html($cat_name); ?> &bull; <?php echo esc_html($season); ?>
        </div>

        <h1 style="font-family:var(--font-title); font-size:clamp(2rem, 3.5vw, 3rem); font-weight:var(--font-title-weight); letter-spacing:var(--font-title-spacing); line-height:1.1; margin-bottom:1.5rem; text-transform:uppercase;">
          <?php the_title(); ?>
        </h1>

        <div style="border-top:1px solid var(--border-subtle); border-bottom:1px solid var(--border-subtle); padding:1.5rem 0; margin-bottom:2rem; display:flex; justify-content:space-between; align-items:flex-end;">
          <div>
            <div style="font-size:0.625rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--text-muted);"><?php esc_html_e('VALOR BASE', 'lapriest'); ?></div>
            <div style="font-size:1.75rem; font-weight:700; color:var(--accent-white); font-family:var(--font-sans);"><?php echo esc_html($base_price); ?></div>
          </div>
          <div style="text-align:right;">
            <div style="font-size:0.625rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--text-muted);"><?php esc_html_e('CÓDIGO DE REGISTRO', 'lapriest'); ?></div>
            <div class="mono-meta" style="color:#fff; font-size:0.875rem;"><?php echo esc_html($piece_code); ?></div>
          </div>
        </div>

        <!-- Botón de Oferta Directa -->
        <button type="button" 
                class="btn-make-offer" 
                data-action="make-offer"
                data-piece-title="<?php echo esc_attr(get_the_title()); ?>"
                data-piece-code="<?php echo esc_attr($piece_code); ?>"
                data-piece-price="<?php echo esc_attr($base_price); ?>"
                style="width:100%; padding:1.25rem; font-size:0.8125rem; margin-bottom:2rem;">
          <span><?php esc_html_e('HACER UNA OFERTA DE ADQUISICIÓN', 'lapriest'); ?> &rarr;</span>
        </button>

        <!-- Tabla de Especificaciones Técnicas -->
        <div style="font-size:0.8125rem; line-height:1.8; color:#999;">
          <div style="border-bottom:1px solid #1a1a1a; padding:0.75rem 0;">
            <strong style="color:#fff; letter-spacing:0.08em; text-transform:uppercase;"><?php esc_html_e('PROCEDENCIA DEL MATERIAL:', 'lapriest'); ?></strong><br>
            <?php echo esc_html($materials); ?>
          </div>

          <div style="border-bottom:1px solid #1a1a1a; padding:0.75rem 0;">
            <strong style="color:#fff; letter-spacing:0.08em; text-transform:uppercase;"><?php esc_html_e('TIRADA DE LA EDICIÓN:', 'lapriest'); ?></strong><br>
            <?php echo esc_html($edition_limit); ?>
          </div>

          <div style="border-bottom:1px solid #1a1a1a; padding:0.75rem 0;">
            <strong style="color:#fff; letter-spacing:0.08em; text-transform:uppercase;"><?php esc_html_e('PROTOCOLO DE ADQUISICIÓN:', 'lapriest'); ?></strong><br>
            <?php esc_html_e('Proponga un valor de oferta en torno al precio base. Nuestra dirección curatorial revisa las solicitudes en un plazo de 24 horas. El envío se coordina mediante mensajería asegurada o retiro privado en el atelier.', 'lapriest'); ?>
          </div>
        </div>

        <div style="margin-top:2rem;">
          <a href="<?php echo esc_url(home_url('/quien-soy/')); ?>" class="mono-meta" style="color:#666; text-decoration:underline;">
            <?php esc_html_e('LEER EL MANIFIESTO Y FILOSOFÍA DEL ATELIER', 'lapriest'); ?> &rarr;
          </a>
        </div>
      </aside>

    </div>
  </div>
</main>

<?php
endwhile;
get_footer();
