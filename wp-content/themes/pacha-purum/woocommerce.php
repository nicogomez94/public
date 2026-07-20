<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main class="<?php echo is_product() ? 'woo-product-page' : 'woo-shop-page'; ?>">
    <?php if (is_shop() || is_product_taxonomy()) : ?>
        <section class="page-hero fade-in visible">
            <span class="eyebrow">Tienda</span>
            <h1>Láminas Vegetales<br><em>Pacha Purum.</em></h1>
            <p>Origen vegetal. Forma nueva.</p>
        </section>
    <?php endif; ?>

    <?php woocommerce_content(); ?>
</main>
<?php
get_footer();
