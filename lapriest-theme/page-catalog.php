<?php
/**
 * Plantilla: Catálogo (Piezas y Sistema de Oferta Directa)
 * Muestra el catálogo completo con la cuadrícula vertical tipo lookbook estilo Rick Owens
 *
 * @package LAPRIEST
 */

get_header(); ?>

<main id="primary" class="site-main">

  <!-- =========================================================================
       ENCABEZADO DEL CATÁLOGO Y DIRECTIVA DE ADQUISICIÓN
       ========================================================================= -->
  <header class="catalog-header-area">
    <div class="container">
      <div class="catalog-intro-grid">
        <div>
          <span class="mono-meta" style="color:var(--text-muted); display:block; margin-bottom:0.75rem;">// CATÁLOGO RAZONADO // SERIE 01</span>
          <h1 class="catalog-main-heading">
            PIEZAS DE<br>
            ARCHIVO.
          </h1>
        </div>
        <div class="catalog-intro-manifesto">
          <p>
            <?php esc_html_e('LAPRIEST produce prendas en microediciones estrictamente limitadas y numeradas de 6 a 18 piezas en todo el mundo. Rechazamos el carrito de compras estandarizado. Cada adquisición se gestiona como un diálogo privado con el cliente mediante nuestro sistema de oferta directa.', 'lapriest'); ?>
          </p>
          <div class="mono-meta" style="margin-top: 1rem; color: #fff;">
            <?php esc_html_e('SELECCIONE UNA PIEZA Y PROPONGA UN VALOR DE ADQUISICIÓN A CONTINUACIÓN.', 'lapriest'); ?>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- =========================================================================
       BARRA DE FILTROS Y CUADRÍCULA DE PIEZAS
       ========================================================================= -->
  <section class="container" style="padding-top: 2rem;">
    
    <!-- Filtros de categoría -->
    <div class="catalog-toolbar">
      <div class="filter-pills" role="tablist">
        <button type="button" class="filter-btn active" data-filter="all" role="tab"><?php esc_html_e('TODAS LAS PIEZAS [06]', 'lapriest'); ?></button>
        <button type="button" class="filter-btn" data-filter="abrigos" role="tab"><?php esc_html_e('ABRIGOS Y CAPAS', 'lapriest'); ?></button>
        <button type="button" class="filter-btn" data-filter="sastreria" role="tab"><?php esc_html_e('SASTRERÍA Y TÚNICAS', 'lapriest'); ?></button>
        <button type="button" class="filter-btn" data-filter="cuero" role="tab"><?php esc_html_e('CUERO Y PRENDAS PESADAS', 'lapriest'); ?></button>
        <button type="button" class="filter-btn" data-filter="calzado" role="tab"><?php esc_html_e('CALZADO', 'lapriest'); ?></button>
      </div>
      <div class="catalog-count-meta" id="catalogFilterCount">
        <?php esc_html_e('MOSTRANDO 6 DE 6 PIEZAS DE ARCHIVO', 'lapriest'); ?>
      </div>
    </div>

    <!-- Cuadrícula Vertical de Piezas -->
    <div class="pieces-grid" id="catalogPiecesGrid">
      <?php
      $args_all_pieces = array(
          'post_type'      => 'catalog_piece',
          'posts_per_page' => -1,
          'post_status'    => 'publish',
          'orderby'        => 'date',
          'order'          => 'DESC',
      );
      $query_all = new WP_Query($args_all_pieces);

      if ($query_all->have_posts()) :
          while ($query_all->have_posts()) : $query_all->the_post();
              get_template_part('template-parts/card-piece');
          endwhile;
          wp_reset_postdata();
      else :
          $sample_pieces = lapriest_get_sample_pieces();
          foreach ($sample_pieces as $piece) :
              $cat_key = 'abrigos';
              if (stripos($piece['category'], 'cuero') !== false) $cat_key = 'cuero';
              elseif (stripos($piece['category'], 'sastrer') !== false) $cat_key = 'sastreria';
              elseif (stripos($piece['category'], 'calzado') !== false) $cat_key = 'calzado';
      ?>
            <article class="piece-card" data-category="<?php echo esc_attr($cat_key); ?>" id="piece-<?php echo esc_attr($piece['code']); ?>">
              <div class="piece-visual-frame">
                <img src="<?php echo esc_url($piece['image']); ?>" alt="<?php echo esc_attr($piece['title']); ?>" class="piece-img-primary" loading="lazy">
                <img src="<?php echo esc_url($piece['hover_image']); ?>" alt="<?php echo esc_attr($piece['title']); ?> Ángulo Secundario" class="piece-img-hover" loading="lazy">
                
                <div class="piece-badge-code"><?php echo esc_html($piece['code']); ?></div>
                <div class="piece-badge-status"><?php esc_html_e('DISPONIBLE PARA OFERTA', 'lapriest'); ?></div>
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

    <!-- Encargos a medida en el Atelier -->
    <div style="border-top: 1px solid var(--border-subtle); padding: 3rem 0 6rem; text-align: center;">
      <span class="mono-meta" style="color:#666;">// ENCARGOS A MEDIDA</span>
      <h3 style="font-family:var(--font-title); font-size:1.75rem; margin:0.75rem 0 1rem; font-weight:var(--font-title-weight); letter-spacing:var(--font-title-spacing); text-transform:uppercase;">
        <?php esc_html_e('¿BUSCA UN ENCARGO DE ARCHIVO O MEDIDAS PERSONALIZADAS?', 'lapriest'); ?>
      </h3>
      <p style="font-size:0.875rem; color:#888; max-width:600px; margin:0 auto 2rem; line-height:1.6;">
        <?php esc_html_e('Los encargos privados se confeccionan a la medida de la morfología del cliente utilizando fibras crudas japonesas de stock muerto y cierres forjados a mano.', 'lapriest'); ?>
      </p>
      <button type="button" 
              class="btn-make-offer"
              data-action="make-offer"
              data-piece-title="ENCARGO A MEDIDA EN EL ATELIER"
              data-piece-code="LP-MEDIDA"
              data-piece-price="BAJO CONSULTA"
              style="padding: 1rem 2.5rem;">
        <span><?php esc_html_e('SOLICITAR PIEZA A MEDIDA', 'lapriest'); ?> &rarr;</span>
      </button>
    </div>

  </section>

</main>

<?php get_footer(); ?>
