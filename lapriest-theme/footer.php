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
          19.432608&deg; N, 99.133209&deg; O &bull; CIUDAD DE MÉXICO<br>
          PIEZA ÚNICA &amp; ARCHIVO
        </div>
      </div>

      <!-- Directorio de Archivos -->
      <div>
        <div class="footer-col-title"><?php esc_html_e('ARCHIVOS // DOSSIERS', 'lapriest'); ?></div>
        <ul class="footer-links-list">
          <li><a href="<?php echo esc_url(home_url('/quien-soy/')); ?>"><?php esc_html_e('Quién Soy (Manifiesto)', 'lapriest'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Editorial', 'lapriest'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/catalogo/')); ?>"><?php esc_html_e('Catálogo de Piezas', 'lapriest'); ?></a></li>
          <li><a href="#offerModalOverlay" data-action="make-offer" data-piece-title="DOSSIER CONFIDENCIAL LAPRIEST" data-piece-code="LP-DOSSIER" data-piece-price="A CONSULTAR"><?php esc_html_e('Oferta Directa', 'lapriest'); ?></a></li>
        </ul>
      </div>

      <!-- Canales Directos -->
      <div>
        <div class="footer-col-title"><?php esc_html_e('CANALES DIRECTOS', 'lapriest'); ?></div>
        <ul class="footer-links-list">
          <li><a href="https://www.instagram.com/__lapriest__/" target="_blank" rel="noopener noreferrer">Instagram (@__lapriest__)</a></li>
          <li><a href="mailto:contacto@lapriest.com">contacto@lapriest.com</a></li>
          <li><a href="#offerModalOverlay" data-action="make-offer" data-piece-title="CITA PRIVADA LAPRIEST" data-piece-code="LP-CITA" data-piece-price="PRIVADO"><?php esc_html_e('Citas Privadas', 'lapriest'); ?></a></li>
          <li><a href="<?php echo esc_url(home_url('/quien-soy/')); ?>#pilares"><?php esc_html_e('Los 4 Pilares', 'lapriest'); ?></a></li>
        </ul>
      </div>

      <!-- Registro de Despacho Confidencial -->
      <div>
        <div class="footer-col-title"><?php esc_html_e('DESPACHO CONFIDENCIAL', 'lapriest'); ?></div>
        <p style="font-size: 0.75rem; color: #888; line-height: 1.6;">
          <?php esc_html_e('Suscríbase para recibir lookbooks privados, coordenadas de exposiciones y lanzamientos de ediciones limitadas antes de su anuncio público.', 'lapriest'); ?>
        </p>
        <form class="footer-dispatch-form">
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
        <?php esc_html_e('SISTEMA DE ADQUISICIÓN DIRECTA &bull; MÉXICO', 'lapriest'); ?>
      </div>
    </div>

    <!-- Crédito de Autoría / Friendly Dev by Shon -->
    <div class="footer-credit-bar">
      <div class="friendly-dev-credit">
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
