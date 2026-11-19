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
      <div class="manifesto-kicker">// MANIFIESTO LAPRIEST</div>
      <h1 class="manifesto-hero-quote">
        &ldquo;ESTO NO ES CONSUMO, ES PURA VIDA.&rdquo;
      </h1>
      <div class="mono-meta" style="margin-top:1.25rem; color:var(--text-secondary);">
        LAPRIEST &bull; ATELIER MÉXICO
      </div>
    </header>

    <!-- =========================================================================
         DISEÑO EDITORIAL A DOS COLUMNAS (VIDEO + ENSAYO)
         ========================================================================= -->
    <div class="manifesto-layout">
      
      <!-- Columna Visual Fija: Video Manifiesto "Quién Soy" -->
      <aside class="manifesto-media-col">
        <div class="manifesto-portrait-frame">
          <video autoplay muted loop playsinline controls preload="metadata" poster="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/vic8134.jpg'); ?>">
            <source src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/quien-soy.mp4'); ?>" type="video/mp4">
          </video>
        </div>
        <div class="manifesto-caption">
          <span>MANIFIESTO // LAPRIEST</span>
          <span>ATELIER MÉXICO</span>
        </div>

        <div style="margin-top:1.75rem; padding-top:0.5rem;">
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
          LAPRIEST<br>
          <?php esc_html_e('Una idea. ¿Un movimiento? ¿Cuál es el instrumento?', 'lapriest'); ?>
        </div>

        <div class="manifesto-poem">
          <div class="manifesto-stanza">
            <p>
              Una marca que poco abarca.<br>
              Un mensaje, aprendizaje.<br>
              Contracorriente, ¿dónde está tu mente?
            </p>
          </div>

          <div class="manifesto-stanza">
            <p>
              ¿De qué va tu vida? ¿Qué te inspira? ¿Motiva?<br>
              Esto no es consumo, es pura vida.<br>
              Sentimientos complejos añejos,<br>
              no necesito consejos.
            </p>
          </div>

          <div class="manifesto-stanza">
            <p>
              Cada material, ideal, mortal, no banal.<br>
              Nada aspiracional.<br>
              Esto es solo para el que comprenda, entienda.<br>
              Que nada lo detenga.
            </p>
          </div>

          <div class="manifesto-stanza">
            <p>
              Pronto habrá pelea, caos, destrucción.<br>
              ¿Te quedarás en tu prisión?<br>
              ¿O buscarás cómo hacer tu revolución?
            </p>
          </div>

          <div class="manifesto-stanza">
            <p>
              Romper el ciclo<br>
              de todo lo que estaba escrito.<br>
              Pelear por un mejor mañana,<br>
              que ya se quite esta migraña.
            </p>
          </div>

          <div class="manifesto-stanza">
            <p>
              Pelear por las ideas.<br>
              Libertad, bondad, rescatar la humanidad.
            </p>
          </div>

          <div class="manifesto-signature">
            Esto es LAPRIEST.
          </div>
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
    <section style="margin-top: 5rem;">
      <div class="section-headline-bar">
        <div>
          <span class="mono-meta" style="color:var(--text-muted); display:block; margin-bottom:0.5rem;">// ESPACIO DE ATELIER</span>
          <h2 class="section-title"><?php esc_html_e('DETRÁS DEL MONOLITO', 'lapriest'); ?></h2>
        </div>
      </div>

      <div class="atelier-gallery-strip">
        <div class="atelier-gallery-item">
          <img src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/dsc04804.jpg'); ?>" alt="Intervención manual con aerosol sobre mezclilla en taller LAPRIEST" loading="lazy">
        </div>
        <div class="atelier-gallery-item">
          <img src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/img-3304.jpg'); ?>" alt="Archivo de piezas gráficas intervenidas a mano" loading="lazy">
        </div>
        <div class="atelier-gallery-item">
          <img src="<?php echo esc_url(LAPRIEST_URI . '/assets/media/web/dsc05091.jpg'); ?>" alt="Retrato exterior de colección LAPRIEST en Ciudad de México" loading="lazy">
        </div>
      </div>
    </section>

    <!-- =========================================================================
         DIRECTORIO DE CONTACTO OFICIAL Y ADQUISICIONES
         ========================================================================= -->
    <section class="atelier-contact-box">
      <div class="contact-box-grid">
        <div class="contact-meta-group">
          <div class="c-label"><?php esc_html_e('ATELIER MÉXICO (CON CITA PREVIA)', 'lapriest'); ?></div>
          <div class="c-val">Ciudad de México, México</div>
          <div class="mono-meta" style="margin-top:0.5rem;">Atención bajo cita privada</div>
        </div>
        <div class="contact-meta-group">
          <div class="c-label"><?php esc_html_e('COMUNICACIÓN DIGITAL DIRECTA', 'lapriest'); ?></div>
          <div class="c-val"><a href="mailto:atelier@lapriest.com" style="color:#fff;">atelier@lapriest.com</a></div>
          <div class="mono-meta" style="margin-top:0.5rem;">Instagram: <a href="https://www.instagram.com/__lapriest__/" target="_blank" rel="noopener noreferrer" style="color:#fff; text-decoration:underline;">@__lapriest__</a></div>
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
