<?php
/**
 * Plantilla Individual: Publicación Editorial y Evento
 * Formato de artículo editorial híbrido estilo 032c y MUBI
 *
 * @package LAPRIEST
 */

get_header();

while (have_posts()) : the_post();
    $event_id = get_the_ID();
    $event_date = get_post_meta($event_id, '_lapriest_event_date', true) ?: 'PARÍS // ARCHIVO';
    $event_location = get_post_meta($event_id, '_lapriest_event_location', true) ?: 'Subterráneo Palais de Tokyo';
    $video_url = get_post_meta($event_id, '_lapriest_event_video_url', true);
    $read_time = get_post_meta($event_id, '_lapriest_reading_time', true) ?: '6 MIN DE LECTURA';

    $types = get_the_terms($event_id, 'editorial_type');
    $type_name = ($types && !is_wp_error($types)) ? $types[0]->name : 'Editorial';

    $hero_img = get_the_post_thumbnail_url($event_id, 'lapriest-editorial-hero');
    if (!$hero_img) {
        $hero_img = 'https://images.unsplash.com/photo-1509631179647-0177331693ae?auto=format&fit=crop&w=1800&q=85';
    }
?>

<main id="primary" class="site-main" style="padding-top: clamp(180px, 15vh, 220px); padding-bottom: 8rem;">
  <article class="container">
    
    <!-- Barra Superior Editorial -->
    <div style="border-bottom:1px solid var(--border-subtle); padding-bottom:1.5rem; margin-bottom:3rem; display:flex; justify-content:space-between; align-items:center;">
      <a href="<?php echo esc_url(home_url('/')); ?>" class="mono-meta">
        &larr; <?php esc_html_e('VOLVER AL FEED EDITORIAL', 'lapriest'); ?>
      </a>
      <span class="mono-meta"><?php echo esc_html($type_name); ?> &bull; <?php echo esc_html($event_date); ?></span>
    </div>

    <!-- Bloque de Título -->
    <div style="max-width:960px; margin-bottom:3rem;">
      <span class="mono-meta" style="color:var(--text-muted); display:block; margin-bottom:1rem;">// REGISTRO DE DOSSIER &bull; <?php echo esc_html($event_location); ?></span>
      <h1 style="font-family:var(--font-title); font-size:clamp(2.5rem, 5vw, 4.75rem); font-weight:var(--font-title-weight); letter-spacing:var(--font-title-spacing); line-height:1.05; text-transform:uppercase;">
        <?php the_title(); ?>
      </h1>
    </div>

    <!-- Imagen Principal a Sangre Completa -->
    <div style="width:100%; aspect-ratio:16/9; max-height:720px; overflow:hidden; border:1px solid var(--border-subtle); margin-bottom:4rem; background:#000;">
      <img src="<?php echo esc_url($hero_img); ?>" alt="<?php echo esc_attr(get_the_title()); ?>" style="width:100%; height:100%; object-fit:cover; filter:contrast(1.1) grayscale(0.85);">
    </div>

    <!-- Cuerpo del Artículo -->
    <div style="max-width:760px; margin:0 auto; font-size:1.0625rem; line-height:1.9; color:#b0b0b0;">
      <div style="font-family:var(--font-serif); font-size:1.625rem; font-weight:300; line-height:1.4; color:#fff; border-left:2px solid #fff; padding-left:1.75rem; margin-bottom:2.5rem;">
        <?php echo esc_html(get_the_excerpt()); ?>
      </div>

      <div class="editorial-entry-content">
        <?php the_content(); ?>
      </div>

      <!-- Enlace al Catálogo al pie del artículo -->
      <div style="border-top:1px solid var(--border-subtle); margin-top:4rem; padding-top:2.5rem; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:1.5rem;">
        <div>
          <span class="mono-meta"><?php esc_html_e('ADQUISICIONES DE ARCHIVO', 'lapriest'); ?></span>
          <div style="font-size:1.125rem; color:#fff; margin-top:0.25rem;"><?php esc_html_e('Explore las siluetas documentadas en este registro.', 'lapriest'); ?></div>
        </div>
        <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="btn-make-offer" style="padding:0.85rem 1.75rem;">
          <span><?php esc_html_e('VER COLECCIÓN 001', 'lapriest'); ?> &rarr;</span>
        </a>
      </div>
    </div>

  </article>
</main>

<?php
endwhile;
get_footer();
