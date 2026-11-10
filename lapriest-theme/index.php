<?php
/**
 * Archivo de Plantilla Principal (Respaldo)
 *
 * @package LAPRIEST
 */

get_header(); ?>

<main id="primary" class="site-main" style="padding-top: 140px; padding-bottom: 8rem;">
  <div class="container">
    <?php if (have_posts()) : ?>
      <header class="section-headline-bar">
        <h1 class="section-title"><?php esc_html_e('DOSSIER DE ARCHIVO', 'lapriest'); ?></h1>
      </header>

      <div class="editorial-grid">
        <?php
        while (have_posts()) : the_post();
          get_template_part('template-parts/card-editorial');
        endwhile;
        ?>
      </div>
    <?php else : ?>
      <div style="padding: 4rem 0; text-align: center;">
        <h2 style="font-family:var(--font-title); font-size: 2rem; font-weight:var(--font-title-weight); letter-spacing:var(--font-title-spacing); margin-bottom: 1rem;"><?php esc_html_e('NO SE ENCONTRARON REGISTROS DE ARCHIVO', 'lapriest'); ?></h2>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-make-offer" style="display:inline-block; margin-top:1rem;">
          <span><?php esc_html_e('VOLVER AL INICIO', 'lapriest'); ?></span>
        </a>
      </div>
    <?php endif; ?>
  </div>
</main>

<?php get_footer(); ?>
