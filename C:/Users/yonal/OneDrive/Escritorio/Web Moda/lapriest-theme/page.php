<?php
/**
 * Plantilla para mostrar páginas estándar
 *
 * @package LAPRIEST
 */

get_header(); ?>

<main id="primary" class="site-main" style="padding-top: 140px; padding-bottom: 8rem;">
  <article class="container">
    <?php while (have_posts()) : the_post(); ?>
      <header class="section-headline-bar" style="margin-bottom: 3rem;">
        <h1 class="section-title"><?php the_title(); ?></h1>
        <span class="section-index">[ REGISTRO DE PÁGINA ]</span>
      </header>

      <div style="max-width: 820px; line-height: 1.85; font-size: 1.0625rem; color: #b5b5b5;">
        <?php the_content(); ?>
      </div>
    <?php endwhile; ?>
  </article>
</main>

<?php get_footer(); ?>
