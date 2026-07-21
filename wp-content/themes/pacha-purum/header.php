<?php
if (!defined('ABSPATH')) {
    exit;
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Pacha Purum: láminas vegetales. Origen vegetal. Forma nueva.">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div class="announcement">
    <span>100% Vegetal</span><i></i><span>Sin TACC</span><i></i><span>Sin Conservantes</span>
</div>

<header class="site-header" id="siteHeader">
    <a class="brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Ir al inicio">
        <span class="brand-mark"><img src="<?php echo esc_url(pacha_asset('images/branding/logo-pacha-purum.png')); ?>" alt="" aria-hidden="true"></span>
        <span class="brand-name">Pacha Purum</span>
    </a>
    <nav class="desktop-nav" aria-label="Navegación principal">
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
        <a href="<?php echo esc_url(pacha_url_tienda()); ?>">Tienda</a>
        <a href="<?php echo esc_url(home_url('/nosotros/')); ?>">Nuestra raíz</a>
        <a href="<?php echo esc_url(home_url('/#recetario')); ?>">Recetario</a>
    </nav>
    <div class="header-actions">
        <button class="icon-button search-trigger" aria-label="Buscar"><i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i></button>
        <a class="cart-trigger" href="<?php echo esc_url(pacha_url_carrito()); ?>" aria-label="Ver carrito">
            <i class="fa-solid fa-bag-shopping" aria-hidden="true"></i>
            <span>Carrito</span>
            <?php pacha_contador_carrito(); ?>
        </a>
        <button class="menu-toggle" aria-label="Abrir menú" aria-expanded="false"><i class="fa-solid fa-bars" aria-hidden="true"></i></button>
    </div>
</header>

<nav class="mobile-menu" aria-label="Navegación móvil">
    <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
    <a href="<?php echo esc_url(pacha_url_tienda()); ?>">Tienda</a>
    <a href="<?php echo esc_url(home_url('/nosotros/')); ?>">Nuestra raíz</a>
    <a href="<?php echo esc_url(home_url('/#recetario')); ?>">Recetario</a>
</nav>

<div class="search-panel" aria-hidden="true">
    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
        <input type="search" id="globalSearch" placeholder="Buscá productos..." aria-label="Buscar productos">
        <button class="search-close" aria-label="Cerrar búsqueda"><i class="fa-solid fa-xmark" aria-hidden="true"></i></button>
    </div>
    <div id="searchResults" class="search-results"></div>
</div>
