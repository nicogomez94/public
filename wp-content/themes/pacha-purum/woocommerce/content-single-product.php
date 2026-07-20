<?php
if (!defined('ABSPATH')) {
    exit;
}

global $product;

if (!$product || !is_a($product, WC_Product::class)) {
    return;
}

do_action('woocommerce_before_single_product');

if (post_password_required()) {
    echo get_the_password_form();
    return;
}

$categorias = wc_get_product_category_list($product->get_id(), ', ');
$descripcion_corta = $product->get_short_description();
$descripcion = $product->get_description();
?>
<article id="product-<?php the_ID(); ?>" <?php wc_product_class('pacha-ficha-producto', $product); ?>>
    <nav class="pacha-migas" aria-label="Ruta de navegación">
        <a href="<?php echo esc_url(home_url('/')); ?>">Inicio</a>
        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        <a href="<?php echo esc_url(pacha_url_tienda()); ?>">Tienda</a>
        <i class="fa-solid fa-chevron-right" aria-hidden="true"></i>
        <span><?php echo esc_html($product->get_name()); ?></span>
    </nav>

    <div class="pacha-producto-layout">
        <figure class="pacha-producto-imagen">
            <?php if ($product->get_image_id()) : ?>
                <?php echo wp_kses_post(wp_get_attachment_image($product->get_image_id(), 'large', false, [
                    'alt' => $product->get_name(),
                    'fetchpriority' => 'high',
                ])); ?>
            <?php endif; ?>
        </figure>

        <div class="pacha-producto-resumen">
            <?php if ($categorias) : ?>
                <div class="eyebrow"><?php echo wp_kses_post($categorias); ?></div>
            <?php endif; ?>

            <h1><?php echo esc_html($product->get_name()); ?></h1>

            <?php if ($descripcion_corta) : ?>
                <div class="pacha-producto-descripcion">
                    <?php echo wp_kses_post(wpautop($descripcion_corta)); ?>
                </div>
            <?php endif; ?>

            <div class="pacha-producto-precio"><?php echo wp_kses_post($product->get_price_html()); ?></div>

            <?php woocommerce_template_single_add_to_cart(); ?>

            <ul class="pacha-producto-beneficios" aria-label="Características">
                <li><i class="fa-solid fa-leaf" aria-hidden="true"></i><span><b>100% vegetal</b>Origen vegetal.</span></li>
                <li><i class="fa-solid fa-wheat-awn-circle-exclamation" aria-hidden="true"></i><span><b>Sin TACC</b>Sin harinas.</span></li>
                <li><i class="fa-solid fa-seedling" aria-hidden="true"></i><span><b>Natural</b>Sin conservantes ni aditivos.</span></li>
            </ul>
        </div>
    </div>

    <?php if ($descripcion) : ?>
        <section class="pacha-producto-informacion">
            <span class="eyebrow">El producto</span>
            <h2>Simple, vegetal<br><em>y listo para usar.</em></h2>
            <div><?php echo wp_kses_post(wpautop($descripcion)); ?></div>
        </section>
    <?php endif; ?>

    <section class="pacha-producto-uso">
        <i class="fa-solid fa-seedling" aria-hidden="true"></i>
        <p>Manipulalas con delicadeza. No hervir ni hidratar. Calor moderado.</p>
    </section>
</article>

<?php
woocommerce_output_related_products([
    'posts_per_page' => 4,
    'columns' => 4,
]);

do_action('woocommerce_after_single_product');
