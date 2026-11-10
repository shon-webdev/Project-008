<?php
/**
 * Pie de página del tema LAPRIEST
 * Monolítico, Brutalista y Protocolo de Adquisición Directa
 *
 * @package LAPRIEST
 */
?>

<!-- Pie de Página Brutalista Monolítico -->
<footer class="site-footer">
  <div class="container">
    <div class="footer-top-grid">
      
      <!-- Declaración del Monolito de Marca -->
      <div>
        <div class="footer-brand-monolith">LAPRIEST</div>
        <p class="footer-brand-bio">
          <?php esc_html_e('Un laboratorio arquitectónico de alta costura que opera bajo principios de monasticismo material, geometría extrema en la silueta y protocolos de adquisición no comerciales.', 'lapriest'); ?>
        </p>
        <div class="mono-meta" style="margin-top: 1.5rem;">
          48.864716&deg; N, 2.349014&deg; E &bull; ATELIER PARÍS<br>
          35.658581&deg; N, 139.745438&deg; E &bull; ARCHIVO TOKIO
        </div>
      </div>

      <!-- Directorio de Archivos -->
      <div>
        <div class="footer-col-title"><?php esc_html_e('ARCHIVOS // DOSSIERS', 'lapriest'); ?></div>
        <ul class="footer-links-list">
          <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('01 Portal Editorial', 'lapriest'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/catalogo/')); ?>"><?php esc_html_e('02 Catálogo de Piezas', 'lapriest'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/quien-soy/')); ?>"><?php esc_html_e('03 Quién Soy (Manifiesto)', 'lapriest'); ?></a></li>
          <li><a href="#offerModalOverlay" data-action="make-offer" data-piece-title="DOSSIER CONFIDENCIAL DEL ATELIER" data-piece-code="LP-DOSSIER" data-piece-price="A CONSULTAR"><?php esc_html_e('04 Proponer Adquisición', 'lapriest'); ?></a></li>
        </ul>
      </div>

      <!-- Canales Directos -->
      <div>
        <div class="footer-col-title"><?php esc_html_e('CANALES DIRECTOS', 'lapriest'); ?></div>
        <ul class="footer-links-list">
          <li><a href="https://instagram.com" target="_blank" rel="noopener noreferrer">Instagram (@lapriest_studio)</a></li>
          <li><a href="mailto:atelier@lapriest.com">atelier@lapriest.com</a></li>
          <li><a href="#offerModalOverlay" data-action="make-offer" data-piece-title="CITA PRIVADA EN EL ATELIER" data-piece-code="LP-CITA" data-piece-price="PRIVADO"><?php esc_html_e('Citas Privadas', 'lapriest'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/quien-soy/')); ?>#pilares"><?php esc_html_e('Los 4 Pilares', 'lapriest'); ?></a></li>
        </ul>
      </div>

      <!-- Registro de Despacho Confidencial -->
      <div>
        <div class="footer-col-title"><?php esc_html_e('DESPACHO CONFIDENCIAL', 'lapriest'); ?></div>
        <p style="font-size: 0.75rem; color: #888; line-height: 1.6;">
          <?php esc_html_e('Suscríbase para recibir lookbooks privados, coordenadas de exposiciones y lanzamientos de ediciones limitadas antes de su anuncio público.', 'lapriest'); ?>
        </p>
        <form class="footer-dispatch-form" onsubmit="event.preventDefault(); alert('Su dirección ha sido registrada en el libro privado de despachos de LAPRIEST.'); this.reset();">
          <input type="email" class="footer-dispatch-input" placeholder="cliente@dominio.com" required aria-label="<?php esc_attr_e('Correo electrónico para el despacho', 'lapriest'); ?>">
          <button type="submit" class="footer-dispatch-btn"><?php esc_html_e('REGISTRARME', 'lapriest'); ?></button>
        </form>
      </div>

    </div>

    <!-- Barra Inferior de Derechos -->
    <div class="footer-bottom-bar">
      <div>
        &copy; <?php echo date('Y'); ?> LAPRIEST HAUTE BRUTALISME. <?php esc_html_e('TODOS LOS DERECHOS RESERVADOS.', 'lapriest'); ?>
      </div>
      <div>
        <?php esc_html_e('ARQUITECTURA SIN CARRITO DE COMPRA &bull; SOLO ADQUISICIONES DIRECTAS', 'lapriest'); ?>
      </div>
    </div>

    <!-- Crédito de Autoría / Friendly Dev by Shon -->
    <div class="footer-credit-bar">
      <div class="friendly-dev-credit">
        <span class="friendly-dev-dot" aria-hidden="true"></span>
        <span class="friendly-dev-text">Friendly Dev by Shon</span>
      </div>
    </div>
  </div>
</footer>

<!-- Componente Modal de Oferta Directa -->
<?php get_template_part('template-parts/modal-offer'); ?>

<?php wp_footer(); ?>
</body>
</html>
