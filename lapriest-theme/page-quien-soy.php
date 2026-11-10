<?php
/**
 * Plantilla: Quién Soy (Acerca de & Manifiesto de Marca)
 * Manifiesto Editorial y Retrato del Creador
 *
 * @package LAPRIEST
 */

get_header(); ?>

<main id="primary" class="site-main manifesto-page">
  <div class="container">

    <!-- =========================================================================
         ENCABEZADO HERO DEL MANIFIESTO
         ========================================================================= -->
    <header class="manifesto-header">
      <div class="manifesto-kicker">// FILOSOFÍA DE MARCA Y DECLARACIÓN DEL CREADOR</div>
      <h1 class="manifesto-hero-quote">
        &ldquo;LA MODA NO ES CONSUMO; ES UNA ARMADURA ARQUITECTÓNICA PARA LA CONCIENCIA HUMANA.&rdquo;
      </h1>
      <div class="mono-meta" style="margin-top:2rem; color:var(--text-secondary);">
        FUNDADO POR STUDIO LAPRIEST &bull; ESTABLECIDO EN PARÍS Y TOKIO &bull; ALTA COSTURA NO CONFORMISTA
      </div>
    </header>

    <!-- =========================================================================
         DISEÑO EDITORIAL A DOS COLUMNAS (RETRATO + ENSAYO)
         ========================================================================= -->
    <div class="manifesto-layout">
      
      <!-- Columna Visual Fija: Retrato del Creador y Entorno del Atelier -->
      <aside class="manifesto-media-col">
        <div class="manifesto-portrait-frame">
          <img src="https://images.unsplash.com/photo-1507679799987-c73779587ccf?auto=format&fit=crop&w=1200&q=90" 
               alt="Director Creativo en el Atelier de París" 
               loading="lazy">
        </div>
        <div class="manifesto-caption">
          <span>RETRATO // DIRECCIÓN CREATIVA</span>
          <span>ATELIER 75003 PARÍS</span>
        </div>

        <div style="margin-top:2.5rem; border-top:1px solid var(--border-subtle); padding-top:1.5rem;">
          <div class="mono-meta" style="margin-bottom:0.75rem; color:#fff;">DOSSIER PRIVADO DE ATELIER</div>
          <p style="font-size:0.8125rem; color:#777; line-height:1.6; margin-bottom:1.25rem;">
            <?php esc_html_e('Curadores, coleccionistas privados y prensa especializada pueden solicitar la monografía confidencial completa, que incluye muestras físicas de textiles.', 'lapriest'); ?>
          </p>
          <button type="button" 
                  class="btn-make-offer"
                  data-action="make-offer"
                  data-piece-title="MONOGRAFÍA CONFIDENCIAL DE ATELIER"
                  data-piece-code="LP-PRENSA-MONOGRAFIA"
                  data-piece-price="PRENSA / CURADURÍA">
            <span><?php esc_html_e('SOLICITAR DOSSIER DE ATELIER', 'lapriest'); ?> &rarr;</span>
          </button>
        </div>
      </aside>

      <!-- Columna de Narrativa: El Manifiesto -->
      <article class="manifesto-text-col">
        
        <div class="manifesto-lead-statement">
          <?php esc_html_e('Existimos fuera de la velocidad frenética del comercio minorista convencional. No fabricamos prendas desechables de temporada; esculpimos objetos arquitectónicos permanentes para el cuerpo.', 'lapriest'); ?>
        </div>

        <div class="manifesto-body-text">
          <p>
            <?php esc_html_e('LAPRIEST nació como una respuesta a la homogeneización del lujo contemporáneo. Cuando la moda se convirtió en un algoritmo diseñado para llenar carritos de compra con prendas sintéticas idénticas, el lujo murió. El verdadero lujo nunca ha tenido que ver con el pago digital instantáneo: reside en la escasez, la tensión física y una dedicación intransigente a la pureza del material.', 'lapriest'); ?>
          </p>

          <p>
            <?php esc_html_e('Nuestras siluetas se inspiran en la arquitectura brutalista, los hábitos monásticos medievales y el diseño industrial. Tratamos la lana cruda japonesa hervida, el cuero de caballo curtido al vegetal y las sargas sin procesar no como textiles desechables, sino como escudos protectores que absorben la vida, el tiempo y la pátina junto a quien los porta.', 'lapriest'); ?>
          </p>

          <p>
            <?php esc_html_e('Al prescindir deliberadamente de carritos de compra y compras automáticas, LAPRIEST recupera el vínculo histórico entre el creador y el coleccionista. Toda adquisición comienza con una propuesta, una conversación y un intercambio humano directo.', 'lapriest'); ?>
          </p>
        </div>

        <!-- Los 4 Pilares de la Marca -->
        <div class="pillars-section" id="pilares">
          <div class="pillars-title">// LOS 4 PILARES DE LAPRIEST</div>

          <div class="pillar-item">
            <div class="pillar-index">[ 01 ]</div>
            <div>
              <h3 class="pillar-heading"><?php esc_html_e('MONASTICISMO MATERIAL', 'lapriest'); ?></h3>
              <p class="pillar-desc">
                <?php esc_html_e('Trabajamos exclusivamente con fibras naturales crudas y de alto gramaje: lana hervida japonesa de alta densidad, cuero de caballo toscano curado en frío y alpaca peruana sin refinar. Sin rellenos sintéticos. Sin concesiones.', 'lapriest'); ?>
              </p>
            </div>
          </div>

          <div class="pillar-item">
            <div class="pillar-index">[ 02 ]</div>
            <div>
              <h3 class="pillar-heading"><?php esc_html_e('PROPORCIÓN BRUTALISTA', 'lapriest'); ?></h3>
              <p class="pillar-desc">
                <?php esc_html_e('Hombros estructurados de proporciones imponentes, caftanes monásticos que rozan el suelo y cortes asimétricos diseñados para conferir presencia física y aplomo psicológico a quien los viste.', 'lapriest'); ?>
              </p>
            </div>
          </div>

          <div class="pillar-item">
            <div class="pillar-index">[ 03 ]</div>
            <div>
              <h3 class="pillar-heading"><?php esc_html_e('PROTOCOLO ANTICONSUMISTA', 'lapriest'); ?></h3>
              <p class="pillar-desc">
                <?php esc_html_e('Sin rebajas de temporada. Sin códigos de descuento. Sin intermediarios de distribución masiva. Las piezas permanecen en el catálogo hasta agotar sus series limitadas numeradas hacia archivos privados.', 'lapriest'); ?>
              </p>
            </div>
          </div>

          <div class="pillar-item">
            <div class="pillar-index">[ 04 ]</div>
            <div>
              <h3 class="pillar-heading"><?php esc_html_e('MICROEDICIONES LIMITADAS', 'lapriest'); ?></h3>
              <p class="pillar-desc">
                <?php esc_html_e('Cada prenda es cortada, ensamblada y terminada a mano en tiradas estrictamente limitadas de entre 6 y 18 piezas a nivel mundial. Cada ejemplar lleva grabado su número de registro de archivo.', 'lapriest'); ?>
              </p>
            </div>
          </div>
        </div>

      </article>

    </div>

    <!-- =========================================================================
         SUITE DE ATELIER Y REGISTRO VISUAL DE CONFECCIÓN
         ========================================================================= -->
    <section style="margin-top: 6rem;">
      <div class="section-headline-bar">
        <div>
          <span class="mono-meta" style="color:var(--text-muted); display:block; margin-bottom:0.5rem;">// ESPACIO DE ATELIER</span>
          <h2 class="section-title"><?php esc_html_e('DETRÁS DEL MONOLITO', 'lapriest'); ?></h2>
        </div>
        <div class="section-index">[ PROCESO Y CONFECCIÓN ]</div>
      </div>

      <div class="atelier-gallery-strip">
        <div class="atelier-gallery-item">
          <img src="https://images.unsplash.com/photo-1552374196-1ab2a1c593e8?auto=format&fit=crop&w=800&q=85" alt="Curado en aceites de chaqueta de cuero" loading="lazy">
        </div>
        <div class="atelier-gallery-item">
          <img src="https://images.unsplash.com/photo-1490481651871-ab68de25d43d?auto=format&fit=crop&w=800&q=85" alt="Corte de patrones de lana cruda" loading="lazy">
        </div>
        <div class="atelier-gallery-item">
          <img src="https://images.unsplash.com/photo-1520639888713-7851133b1ed0?auto=format&fit=crop&w=800&q=85" alt="Montaje de fornituras de plata forjadas a mano" loading="lazy">
        </div>
      </div>
    </section>

    <!-- =========================================================================
         DIRECTORIO DE CONTACTO OFICIAL Y ADQUISICIONES
         ========================================================================= -->
    <section class="atelier-contact-box">
      <div class="contact-box-grid">
        <div class="contact-meta-group">
          <div class="c-label"><?php esc_html_e('ATELIER PARÍS (CON CITA PREVIA)', 'lapriest'); ?></div>
          <div class="c-val">Rue de Turenne, 75003 París, Francia</div>
          <div class="mono-meta" style="margin-top:0.5rem;">Coordenadas: 48.8647° N, 2.3490° E</div>
        </div>
        <div class="contact-meta-group">
          <div class="c-label"><?php esc_html_e('COMUNICACIÓN DIGITAL DIRECTA', 'lapriest'); ?></div>
          <div class="c-val"><a href="mailto:atelier@lapriest.com" style="color:#fff;">atelier@lapriest.com</a></div>
          <div class="mono-meta" style="margin-top:0.5rem;">Instagram: @lapriest_studio</div>
        </div>
        <div class="contact-meta-group">
          <div class="c-label"><?php esc_html_e('CONSULTAS CURATORIALES Y PRENSA', 'lapriest'); ?></div>
          <div class="c-val">press@lapriest.com</div>
          <div class="mono-meta" style="margin-top:0.5rem;">Llave de Cifrado: PGP 0x7F41A9</div>
        </div>
      </div>
    </section>

  </div>
</main>

<?php get_footer(); ?>
