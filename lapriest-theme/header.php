<?php
/**
 * Cabecera para el tema LAPRIEST
 * Arquitectura Brutalista Oscura, Editorial y de Alto Contraste
 *
 * @package LAPRIEST
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="profile" href="https://gmpg.org/xfn/11">
  <link rel="preconnect" href="https://fonts.cdnfonts.com">
  <link rel="stylesheet" href="https://fonts.cdnfonts.com/css/sf-pro-display">
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Filtro de textura de grano analógico de 35mm (Estética MUBI) -->
<div class="grain-overlay" aria-hidden="true"></div>

<!-- Cabecera del Sitio -->
<header class="site-header" id="siteHeader">
  
  <!-- Barra de telemetría y zonas horarias en tiempo real -->
  <div class="header-topbar">
    <div class="topbar-left">
      <span class="live-pulse"></span>
      <span id="paris-time">ATELIER PARÍS: 00:00:00 CET</span>
    </div>
    <div class="topbar-center">
      <span>PROTOCOLO: SOLO ADQUISICIÓN DIRECTA // SIN CARRITOS DE COMPRA</span>
    </div>
    <div class="topbar-right">
      <span id="tokyo-time">ARCHIVO TOKIO: 00:00:00 JST</span>
    </div>
  </div>

  <!-- Barra de Navegación Principal -->
  <div class="header-navbar container">
    <!-- Logotipo Monolítico -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-mark" rel="home">
      LAPRIEST<span>PARÍS</span>
    </a>

    <!-- Menú de Navegación Editorial -->
    <nav class="primary-navigation" aria-label="<?php esc_attr_e('Navegación Principal', 'lapriest'); ?>">
      <ul class="nav-menu" id="primaryNav">
        <li>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">
            <?php esc_html_e('EDITORIAL', 'lapriest'); ?> <span class="nav-counter">01</span>
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="nav-link <?php echo (is_page('catalogo') || is_page('catalog') || is_post_type_archive('catalog_piece') || is_singular('catalog_piece')) ? 'active' : ''; ?>">
            <?php esc_html_e('CATÁLOGO', 'lapriest'); ?> <span class="nav-counter">02</span>
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/quien-soy/')); ?>" class="nav-link <?php echo is_page('quien-soy') ? 'active' : ''; ?>">
            <?php esc_html_e('QUIÉN SOY', 'lapriest'); ?> <span class="nav-counter">03</span>
          </a>
        </li>
        <li>
          <a href="#offerModalOverlay" class="nav-link" data-action="make-offer" data-piece-title="CONSULTA GENERAL AL ATELIER" data-piece-code="LP-GEN" data-piece-price="A CONSULTAR">
            <?php esc_html_e('OFERTA DIRECTA', 'lapriest'); ?> <span class="nav-counter">&nearr;</span>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Herramientas de Interacción -->
    <div class="nav-actions">
      <!-- Generador de atmósfera sonora procedural Web Audio API -->
      <button type="button" class="btn-atmosphere" id="ambientToggle" aria-label="<?php esc_attr_e('Activar atmósfera sonora de baja frecuencia', 'lapriest'); ?>">
        <span class="live-pulse"></span>
        <span class="audio-status"><?php esc_html_e('ATMÓSFERA: DESACTIVADA', 'lapriest'); ?></span>
      </button>

      <!-- Botón de Menú Móvil -->
      <button type="button" class="mobile-nav-toggle" aria-label="<?php esc_attr_e('Alternar Menú', 'lapriest'); ?>">
        [ MENÚ ]
      </button>
    </div>
  </div>

  <!-- Cinta Ticker Brutalista Monolítica -->
  <div class="brutalist-ticker" aria-hidden="true">
    <div class="ticker-track">
      <div class="ticker-item">
        <span>COLECCIÓN DE ARCHIVO 001 // EL ECLIPSE DE LA ORTODOXIA</span>
        <span class="divider">&bull;</span>
        <span>SIN CARRITOS DE COMPRA // SOLO PROPUESTAS DIRECTAS AL ATELIER</span>
        <span class="divider">&bull;</span>
        <span>EDICIONES LIMITADAS NUMERADAS HECHAS A MANO EN PARÍS Y TOSCANA</span>
        <span class="divider">&bull;</span>
        <span>VISITAS PRIVADAS AL ATELIER DISPONIBLES A SOLICITUD</span>
        <span class="divider">&bull;</span>
        <span>LANA CRUDA JAPONESA Y CAPARAZONES DE CUERO ESCULPIDO</span>
        <span class="divider">&bull;</span>
      </div>
      <div class="ticker-item">
        <span>COLECCIÓN DE ARCHIVO 001 // EL ECLIPSE DE LA ORTODOXIA</span>
        <span class="divider">&bull;</span>
        <span>SIN CARRITOS DE COMPRA // SOLO PROPUESTAS DIRECTAS AL ATELIER</span>
        <span class="divider">&bull;</span>
        <span>EDICIONES LIMITADAS NUMERADAS HECHAS A MANO EN PARÍS Y TOSCANA</span>
        <span class="divider">&bull;</span>
        <span>VISITAS PRIVADAS AL ATELIER DISPONIBLES A SOLICITUD</span>
        <span class="divider">&bull;</span>
        <span>LANA CRUDA JAPONESA Y CAPARAZONES DE CUERO ESCULPIDO</span>
        <span class="divider">&bull;</span>
      </div>
    </div>
  </div>
</header>
