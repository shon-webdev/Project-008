<?php
/**
 * Parte de Plantilla: Tarjeta de Pieza
 * Muestra una prenda del catálogo con vista previa doble al pasar el cursor y botón de oferta directa
 *
 * @package LAPRIEST
 */

$piece_id = get_the_ID();
$piece_code = get_post_meta($piece_id, '_lapriest_piece_code', true) ?: 'LP-FW26-' . sprintf('%03d', $piece_id);
$base_price = get_post_meta($piece_id, '_lapriest_base_price', true) ?: '$1,850 USD';
$season = get_post_meta($piece_id, '_lapriest_season', true) ?: 'SERIE 01 // EL ECLIPSE';
$materials = get_post_meta($piece_id, '_lapriest_materials', true) ?: '100% Lana Cruda Hervida Japonesa, Cierres de Plata Oxidada al Frío.';
$secondary_img = get_post_meta($piece_id, '_lapriest_secondary_image', true);
$status = get_post_meta($piece_id, '_lapriest_inquiry_status', true) ?: 'available';

$status_label = 'DISPONIBLE';
if ($status === 'reserved') $status_label = 'RESERVADA';
elseif ($status === 'archival') $status_label = 'ARCHIVO';

$terms = get_the_terms($piece_id, 'piece_category');
$cat_slug = ($terms && !is_wp_error($terms)) ? $terms[0]->slug : 'all';
$cat_name = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Pieza de Colección';

$primary_img = get_the_post_thumbnail_url($piece_id, 'lapriest-piece-portrait');
if (!$primary_img) {
    $primary_img = 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1200&q=85';
}
if (!$secondary_img) {
    $secondary_img = 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?auto=format&fit=crop&w=1200&q=85';
}
?>

<article class="piece-card" data-category="<?php echo esc_attr($cat_slug); ?>" id="piece-<?php echo esc_attr($piece_id); ?>">
  <!-- Marco visual vertical con vista previa doble -->
  <div class="piece-visual-frame">
    <a href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr(get_the_title()); ?>">
      <img src="<?php echo esc_url($primary_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" class="piece-img-primary" loading="lazy">
      <img src="<?php echo esc_url($secondary_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?> Ángulo Alternativo" class="piece-img-hover" loading="lazy">
    </a>

    <!-- Distintivos de identificación -->
    <div class="piece-badge-code"><?php echo esc_html($piece_code); ?></div>
    <div class="piece-badge-status"><?php echo esc_html($status_label); ?></div>
  </div>

  <!-- Información y acción de oferta -->
  <div class="piece-info-box">
    <div>
      <div class="piece-category-meta"><?php echo esc_html($cat_name); ?> // <?php echo esc_html($season); ?></div>
      <h3 class="piece-title-text">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h3>
      <div class="piece-materials-text">
        <?php echo esc_html($materials); ?>
      </div>
    </div>

    <div class="piece-action-row">
      <div class="piece-price-wrap">
        <span class="price-meta-label"><?php esc_html_e('VALOR BASE', 'lapriest'); ?></span>
        <span class="price-value"><?php echo esc_html($base_price); ?></span>
      </div>

      <!-- Botón de Oferta Directa -->
      <button type="button" 
              class="btn-make-offer"
              data-action="make-offer"
              data-piece-id="<?php echo esc_attr($piece_id); ?>"
              data-piece-title="<?php echo esc_attr(get_the_title()); ?>"
              data-piece-code="<?php echo esc_attr($piece_code); ?>"
              data-piece-price="<?php echo esc_attr($base_price); ?>"
              aria-haspopup="dialog">
        <span><?php esc_html_e('HACER UNA OFERTA / CONSULTAR', 'lapriest'); ?></span>
      </button>
    </div>
  </div>
</article>
