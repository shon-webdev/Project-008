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
  <!-- Barra de Navegación Principal -->
  <div class="header-navbar container">
    <!-- Logotipo Monolítico -->
    <a href="<?php echo esc_url(home_url('/')); ?>" class="brand-mark" rel="home">
      LAPRIEST
    </a>

    <!-- Menú de Navegación Editorial -->
    <nav class="primary-navigation" aria-label="<?php esc_attr_e('Navegación Principal', 'lapriest'); ?>">
      <ul class="nav-menu" id="primaryNav">
        <li>
          <a href="<?php echo esc_url(home_url('/quien-soy/')); ?>" class="nav-link <?php echo is_page('quien-soy') ? 'active' : ''; ?>">
            <?php esc_html_e('QUIÉN SOY', 'lapriest'); ?>
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link <?php echo is_front_page() ? 'active' : ''; ?>">
            <?php esc_html_e('EDITORIAL', 'lapriest'); ?>
          </a>
        </li>
        <li>
          <a href="<?php echo esc_url(home_url('/catalogo/')); ?>" class="nav-link <?php echo (is_page('catalogo') || is_page('catalog') || is_post_type_archive('catalog_piece') || is_singular('catalog_piece')) ? 'active' : ''; ?>">
            <?php esc_html_e('CATÁLOGO', 'lapriest'); ?>
          </a>
        </li>
        <li>
          <a href="#offerModalOverlay" class="nav-link" data-action="make-offer" data-piece-title="CONSULTA GENERAL LAPRIEST" data-piece-code="LP-GEN" data-piece-price="A CONSULTAR">
            <?php esc_html_e('OFERTA DIRECTA', 'lapriest'); ?>
          </a>
        </li>
      </ul>
    </nav>

    <!-- Herramientas de Interacción -->
    <div class="nav-actions">
      <!-- Generador de atmósfera sonora procedural Web Audio API -->
      <button type="button" class="btn-atmosphere" id="ambientToggle" aria-label="<?php esc_attr_e('Activar atmósfera sonora', 'lapriest'); ?>">
        <span class="audio-status"><?php esc_html_e('AUDIO: OFF', 'lapriest'); ?></span>
      </button>

      <!-- Botón de Menú Móvil -->
      <button type="button" class="mobile-nav-toggle" aria-label="<?php esc_attr_e('Alternar Menú', 'lapriest'); ?>">
        MENÚ
      </button>
    </div>
  </div>
</header>
