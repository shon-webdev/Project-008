<?php
/**
 * Parte de Plantilla: Tarjeta Editorial
 * Tarjeta brutalista estilo revista 032c
 *
 * @package LAPRIEST
 */

$event_id = get_the_ID();
$event_date = get_post_meta($event_id, '_lapriest_event_date', true) ?: 'TEMPORADA 2026';
$event_location = get_post_meta($event_id, '_lapriest_event_location', true) ?: 'Palais de Tokyo, París';
$read_time = get_post_meta($event_id, '_lapriest_reading_time', true) ?: '5 MIN DE LECTURA';

$types = get_the_terms($event_id, 'editorial_type');
$type_name = ($types && !is_wp_error($types)) ? $types[0]->name : 'Editorial';

$img_url = get_the_post_thumbnail_url($event_id, 'lapriest-editorial-card');
if (!$img_url) {
    $img_url = 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1200&q=85';
}
?>

<article class="editorial-card" id="editorial-<?php echo esc_attr($event_id); ?>">
  <div class="editorial-img-box">
    <a href="<?php the_permalink(); ?>">
      <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" loading="lazy">
    </a>
    <div class="editorial-type-badge"><?php echo esc_html($type_name); ?></div>
    <div class="editorial-meta-tag"><?php echo esc_html($read_time); ?></div>
  </div>

  <div class="editorial-body">
    <div>
      <div class="mono-meta" style="margin-bottom: 0.5rem;">
        <?php echo esc_html($event_date); ?> &bull; <?php echo esc_html($event_location); ?>
      </div>
      <h3 class="editorial-title">
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h3>
      <p class="editorial-excerpt">
        <?php echo esc_html(get_the_excerpt()); ?>
      </p>
    </div>

    <div class="editorial-footer-bar">
      <span><?php echo esc_html($event_location); ?></span>
      <a href="<?php the_permalink(); ?>" class="read-cta">
        <span><?php esc_html_e('INGRESAR AL DOSSIER', 'lapriest'); ?></span> &rarr;
      </a>
    </div>
  </div>
</article>
