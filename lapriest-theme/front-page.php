<?php
/**
 * Plantilla: Inicio (Portal Editorial y Centro Cultural)
 * Plantilla principal de portada para LAPRIEST
 *
 * @package LAPRIEST
 */

get_header(); ?>

<main id="primary" class="site-main">

  <!-- =========================================================================
       PORTADA LIMPIA DE MARCA (FONDO CLARO DE ESTUDIO)
       ========================================================================= -->
  <section class="editorial-hero" aria-label="Portada LAPRIEST">
    <div class="hero-media-wrapper">
      <img src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/vic8079.jpg'); ?>" 
           alt="LAPRIEST — Archivo Fotográfico de Estudio en México" 
           fetchpriority="high">
    </div>

    <div class="container hero-scroll-bar">
      <a href="#film-principal" class="hero-scroll-cue"><?php esc_html_e('EXPLORAR ARCHIVO', 'lapriest'); ?> &darr;</a>
    </div>
  </section>

  <!-- FILM PRINCIPAL Y MANIFIESTO AL DESCENDER -->
  <section class="hero-manifesto-band" id="film-principal">
    <div class="container brand-film-grid">
      <div class="brand-film-frame">
        <video autoplay muted loop playsinline controls preload="metadata" poster="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/vic8092.jpg'); ?>">
          <source src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/hero-principal.mp4'); ?>" type="video/mp4">
        </video>
      </div>

      <div class="brand-film-copy">
        <h1 class="hero-title">
          MONOLÍTICO<br>
          <em>ARMADURA PARA LA MENTE.</em>
        </h1>

        <p class="brand-film-lead">
          <?php esc_html_e('Desde nuestro taller independiente en México, LAPRIEST desarrolla piezas únicas de patronaje experimental, denim intervenido a mano e indumentaria concebida fuera de los ciclos comerciales tradicionales.', 'lapriest'); ?>
        </p>

        <div class="brand-film-actions">
          <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="btn-flat-solid"><?php esc_html_e('VER CATÁLOGO', 'lapriest'); ?></a>
          <button type="button" class="btn-flat-muted" data-action="make-offer" data-piece-title="CONSULTA GENERAL LAPRIEST" data-piece-code="LP-GEN" data-piece-price="BAJO CONSULTA">
            <?php esc_html_e('SOLICITAR OFERTA DIRECTA', 'lapriest'); ?>
          </button>
        </div>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       FEED EDITORIAL Y EVENTOS: CUADRÍCULA ESTILO REVISTA 032c
       ========================================================================= -->
  <section class="editorial-section">
    <div class="container">
      
      <!-- Encabezado de Sección -->
      <div class="section-headline-bar">
        <div>
          <span class="mono-meta" style="color:var(--text-muted); display:block; margin-bottom:0.5rem;">// COMUNICADOS Y PASARELAS</span>
          <h2 class="section-title"><?php esc_html_e('EDITORIAL Y EVENTOS', 'lapriest'); ?></h2>
        </div>
      </div>

      <?php
      $args_editorial = array(
          'post_type'      => 'editorial_event',
          'posts_per_page' => 4,
          'post_status'    => 'publish',
      );
      $editorial_query = new WP_Query($args_editorial);
      ?>

      <div class="editorial-grid">
        <?php
        if ($editorial_query->have_posts()) :
            while ($editorial_query->have_posts()) : $editorial_query->the_post();
                get_template_part('template-parts/card-editorial');
            endwhile;
            wp_reset_postdata();
        else :
            $sample_editorials = lapriest_get_sample_editorials();
            foreach ($sample_editorials as $index => $item) :
        ?>
              <article class="editorial-card <?php echo $index === 0 ? 'editorial-card-featured' : ''; ?>">
                <div class="editorial-img-box">
                  <a href="<?php echo esc_url(home_url('/editorial/')); ?>">
                    <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                  </a>
                  <div class="editorial-type-badge"><?php echo esc_html($item['type']); ?></div>
                  <div class="editorial-meta-tag"><?php echo esc_html($item['read_time']); ?></div>
                </div>

                <div class="editorial-body">
                  <div>
                    <div class="mono-meta" style="margin-bottom: 0.5rem;">
                      <?php echo esc_html($item['date']); ?> &bull; <?php echo esc_html($item['location']); ?>
                    </div>
                    <h3 class="editorial-title">
                      <a href="<?php echo esc_url(home_url('/editorial/')); ?>"><?php echo esc_html($item['title']); ?></a>
                    </h3>
                    <p class="editorial-excerpt">
                      <?php echo esc_html($item['excerpt']); ?>
                    </p>
                  </div>

                  <div class="editorial-footer-bar">
                    <span><?php echo esc_html($item['location']); ?></span>
                    <a href="<?php echo esc_url(home_url('/editorial/')); ?>" class="read-cta">
                      <span><?php esc_html_e('INGRESAR AL DOSSIER', 'lapriest'); ?></span> &rarr;
                    </a>
                  </div>
                </div>
              </article>
        <?php
            endforeach;
        endif;
        ?>
      </div>

    </div>
  </section>

  <!-- =========================================================================
       BANNER DE PASARELA CINEMATOGRÁFICA (INMERSIÓN VISUAL Y SONORA)
       ========================================================================= -->
  <section class="runway-banner">
    <div class="runway-banner-bg">
      <video autoplay muted loop playsinline preload="metadata" poster="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/vic8257.jpg'); ?>">
        <source src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/pasarelas.mp4'); ?>" type="video/mp4">
      </video>
    </div>
    <div class="container runway-banner-inner">
      <span class="mono-meta" style="color:#ccc; display:block; margin-bottom:1rem;">// DOCUMENTO EN PASARELA</span>
      <h2 class="runway-banner-title">
        PASARELA LAPRIEST
      </h2>
      <p class="runway-banner-desc">
        <?php esc_html_e('Movimiento, caída y presencia en vivo de las piezas desarrolladas en estudio. Cada silueta se asigna mediante consulta u oferta directa.', 'lapriest'); ?>
      </p>
      <div style="display:flex; justify-content:center; gap:1rem; flex-wrap:wrap;">
        <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="btn-flat-solid">
          <?php esc_html_e('EXPLORAR CATÁLOGO', 'lapriest'); ?> &rarr;
        </a>
        <button type="button" class="btn-flat-muted" data-action="make-offer" data-piece-title="CONSULTA DE PASARELA LAPRIEST" data-piece-code="LP-RUNWAY" data-piece-price="BAJO CONSULTA">
          <?php esc_html_e('SOLICITAR OFERTA DIRECTA', 'lapriest'); ?>
        </button>
      </div>
    </div>
  </section>

  <!-- =========================================================================
       DESTACADOS DEL CATÁLOGO (VISTA MONOLÍTICA ESTILO RICK OWENS)
       ========================================================================= -->
  <section class="editorial-section" style="background-color: #0b0b0b;">
    <div class="container">
      
      <div class="section-headline-bar">
        <div>
          <span class="mono-meta" style="color:var(--text-muted); display:block; margin-bottom:0.5rem;">// EDICIONES LIMITADAS</span>
          <h2 class="section-title"><?php esc_html_e('PIEZAS DE ARCHIVO', 'lapriest'); ?></h2>
        </div>
        <div>
          <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="mono-meta" style="color:var(--text-primary); text-decoration:underline;">
            <?php esc_html_e('VER CATÁLOGO COMPLETO [06 PIEZAS]', 'lapriest'); ?> &rarr;
          </a>
        </div>
      </div>

      <div class="pieces-grid">
        <?php
        $args_pieces = array(
            'post_type'      => 'catalog_piece',
            'posts_per_page' => 3,
            'post_status'    => 'publish',
        );
        $pieces_query = new WP_Query($args_pieces);

        if ($pieces_query->have_posts()) :
            while ($pieces_query->have_posts()) : $pieces_query->the_post();
                get_template_part('template-parts/card-piece');
            endwhile;
            wp_reset_postdata();
        else :
            $samples = array_slice(lapriest_get_sample_pieces(), 0, 3);
            foreach ($samples as $piece) :
        ?>
              <article class="piece-card" data-category="abrigos">
                <div class="piece-visual-frame">
                  <img src="<?php echo esc_url($piece['image']); ?>" alt="<?php echo esc_attr($piece['title']); ?>" class="piece-img-primary" loading="lazy">
                  <img src="<?php echo esc_url($piece['hover_image']); ?>" alt="<?php echo esc_attr($piece['title']); ?> Reverso" class="piece-img-hover" loading="lazy">
                  <div class="piece-badge-code"><?php echo esc_html($piece['code']); ?></div>
                  <div class="piece-badge-status"><?php esc_html_e('DISPONIBLE', 'lapriest'); ?></div>
                </div>

                <div class="piece-info-box">
                  <div>
                    <div class="piece-category-meta"><?php echo esc_html($piece['category']); ?> // <?php echo esc_html($piece['season']); ?></div>
                    <h3 class="piece-title-text"><?php echo esc_html($piece['title']); ?></h3>
                    <div class="piece-materials-text"><?php echo esc_html($piece['materials']); ?></div>
                  </div>

                  <div class="piece-action-row">
                    <div class="piece-price-wrap">
                      <span class="price-meta-label"><?php esc_html_e('VALOR BASE', 'lapriest'); ?></span>
                      <span class="price-value"><?php echo esc_html($piece['price']); ?></span>
                    </div>

                    <button type="button" 
                            class="btn-make-offer"
                            data-action="make-offer"
                            data-piece-title="<?php echo esc_attr($piece['title']); ?>"
                            data-piece-code="<?php echo esc_attr($piece['code']); ?>"
                            data-piece-price="<?php echo esc_attr($piece['price']); ?>">
                      <span><?php esc_html_e('HACER UNA OFERTA / CONSULTAR', 'lapriest'); ?></span>
                    </button>
                  </div>
                </div>
              </article>
        <?php
            endforeach;
        endif;
        ?>
      </div>

    </div>
  </section>

</main>

<?php get_footer(); ?>
