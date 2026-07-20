<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();

$es_carrito = function_exists('is_cart') && is_cart();
$es_checkout = function_exists('is_checkout') && is_checkout();
?>
<main class="<?php echo $es_checkout ? 'checkout-view' : ($es_carrito ? 'cart-view' : 'page-default'); ?>">
    <?php if ($es_checkout) : ?>
        <div class="checkout-header">
            <a href="<?php echo esc_url(pacha_url_carrito()); ?>"><i class="fa-solid fa-arrow-left" aria-hidden="true"></i> Volver al carrito</a>
            <div class="checkout-brand"><i class="fa-solid fa-seedling" aria-hidden="true"></i> Pacha Purum</div>
            <span><i class="fa-solid fa-lock" aria-hidden="true"></i> Compra segura</span>
        </div>
    <?php else : ?>
        <section class="page-hero compact fade-in visible">
            <span class="eyebrow"><?php echo $es_carrito ? 'Tu selección' : esc_html(get_the_title()); ?></span>
            <h1><?php echo $es_carrito ? 'Carrito' : esc_html(get_the_title()); ?></h1>
        </section>
    <?php endif; ?>

    <section class="<?php echo $es_checkout ? 'checkout-layout' : 'section'; ?> fade-in visible">
        <?php
        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </section>
</main>
<?php
get_footer();
