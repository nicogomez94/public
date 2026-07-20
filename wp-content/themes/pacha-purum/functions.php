<?php
if (!defined('ABSPATH')) {
    exit;
}

function pacha_asset($ruta) {
    return get_template_directory_uri() . '/assets/' . ltrim($ruta, '/');
}

function pacha_url_tienda() {
    return function_exists('wc_get_page_permalink') ? wc_get_page_permalink('shop') : home_url('/tienda/');
}

function pacha_url_carrito() {
    return function_exists('wc_get_cart_url') ? wc_get_cart_url() : home_url('/carrito/');
}

function pacha_configurar_theme() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');

    register_nav_menus([
        'principal' => __('Navegación principal', 'pacha-purum'),
    ]);
}
add_action('after_setup_theme', 'pacha_configurar_theme');

function pacha_cargar_assets() {
    wp_enqueue_style(
        'pacha-fuentes',
        'https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500;9..144,600&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        [],
        '6.5.2'
    );
    wp_enqueue_style(
        'pacha-estilos',
        pacha_asset('css/pacha.css'),
        [],
        filemtime(get_template_directory() . '/assets/css/pacha.css')
    );
    wp_enqueue_script(
        'pacha-scripts',
        pacha_asset('js/pacha.js'),
        [],
        filemtime(get_template_directory() . '/assets/js/pacha.js'),
        true
    );

    wp_localize_script('pacha-scripts', 'pachaDatos', [
        'productos' => pacha_productos_para_busqueda(),
    ]);
}
add_action('wp_enqueue_scripts', 'pacha_cargar_assets');

add_filter('woocommerce_enqueue_styles', '__return_empty_array');

function pacha_simbolo_peso_argentino($simbolo, $moneda) {
    return $moneda === 'ARS' ? 'ARS' : $simbolo;
}
add_filter('woocommerce_currency_symbol', 'pacha_simbolo_peso_argentino', 10, 2);

function pacha_traducciones_woocommerce($traduccion, $texto, $dominio) {
    if ($dominio !== 'woocommerce') {
        return $traduccion;
    }

    $traducciones = [
        'Remove %s from cart' => 'Quitar %s del carrito',
        'Product quantity' => 'Cantidad del producto',
    ];

    return $traducciones[$texto] ?? $traduccion;
}
add_filter('gettext', 'pacha_traducciones_woocommerce', 10, 3);

function pacha_productos_para_busqueda() {
    if (!class_exists('WooCommerce')) {
        return [];
    }

    $posts = get_posts([
        'post_type' => 'product',
        'post_status' => 'publish',
        'posts_per_page' => 20,
        'orderby' => 'menu_order title',
        'order' => 'ASC',
    ]);

    return array_values(array_filter(array_map(function ($post) {
        $producto = wc_get_product($post->ID);
        if (!$producto) {
            return null;
        }

        return [
            'nombre' => $producto->get_name(),
            'descripcion' => wp_strip_all_tags($producto->get_short_description()),
            'url' => get_permalink($producto->get_id()),
        ];
    }, $posts)));
}

function pacha_contador_carrito() {
    $cantidad = class_exists('WooCommerce') && WC()->cart ? WC()->cart->get_cart_contents_count() : 0;
    echo '<b class="cart-count">' . esc_html($cantidad) . '</b>';
}

function pacha_fragmentos_carrito($fragmentos) {
    ob_start();
    pacha_contador_carrito();
    $fragmentos['.cart-count'] = ob_get_clean();
    return $fragmentos;
}
add_filter('woocommerce_add_to_cart_fragments', 'pacha_fragmentos_carrito');

function pacha_pack_visual($nombre = 'Láminas Vegetales') {
    ?>
    <div class="product-pack" style="--pack-color:#9ab360;--pack-ink:#244431;--tilt:-3deg">
        <i class="fa-solid fa-seedling" aria-hidden="true"></i>
        <strong><?php echo esc_html($nombre); ?></strong>
        <small>origen vegetal · forma nueva</small>
    </div>
    <?php
}

function pacha_tarjeta_producto($producto = null) {
    if (!$producto) {
        global $product;
        $producto = $product;
    }

    if (!$producto instanceof WC_Product) {
        return;
    }

    $url = get_permalink($producto->get_id());
    $descripcion = $producto->get_short_description() ?: $producto->get_description();
    $imagen = get_the_post_thumbnail_url($producto->get_id(), 'medium_large');
    ?>
    <article <?php wc_product_class('product-card', $producto); ?>>
        <a class="product-card-link" href="<?php echo esc_url($url); ?>" aria-label="<?php echo esc_attr(sprintf(__('Ver %s', 'pacha-purum'), $producto->get_name())); ?>">
            <div class="product-visual">
                <span class="product-badge">100% vegetal</span>
                <?php if ($imagen) : ?>
                    <img src="<?php echo esc_url($imagen); ?>" alt="<?php echo esc_attr($producto->get_name()); ?>" loading="lazy">
                <?php endif; ?>
            </div>
            <div class="product-meta">
                <h3><?php echo esc_html($producto->get_name()); ?></h3>
                <?php if ($descripcion) : ?>
                    <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags($descripcion), 18)); ?></p>
                <?php endif; ?>
                <div class="product-price">
                    <?php echo wp_kses_post($producto->get_price_html()); ?>
                </div>
            </div>
        </a>
        <?php if ($producto->is_purchasable() && $producto->is_in_stock()) : ?>
            <a class="quick-add add_to_cart_button ajax_add_to_cart" href="<?php echo esc_url($producto->add_to_cart_url()); ?>" data-product_id="<?php echo esc_attr($producto->get_id()); ?>" aria-label="<?php echo esc_attr(sprintf(__('Agregar %s al carrito', 'pacha-purum'), $producto->get_name())); ?>">
                <i class="fa-solid fa-plus" aria-hidden="true"></i>
            </a>
        <?php endif; ?>
    </article>
    <?php
}

function pacha_tarjeta_laminas_estatica() {
    ?>
    <article class="product-card">
        <a class="product-card-link" href="<?php echo esc_url(pacha_url_tienda()); ?>">
            <div class="product-visual">
                <span class="product-badge">100% vegetal</span>
                <?php pacha_pack_visual('Láminas Vegetales'); ?>
            </div>
            <div class="product-meta">
                <h3>Láminas Vegetales</h3>
                <p>100% Vegetal · Sin TACC · Sin Conservantes.</p>
                <div class="product-price"><b>Sin precio publicado</b></div>
            </div>
        </a>
    </article>
    <?php
}

function pacha_woocommerce_inicio() {
    if (is_product()) {
        echo '<main class="woo-product-page">';
        return;
    }

    echo '<main class="woo-shop-page">';
    if (is_shop() || is_product_taxonomy()) {
        echo '<section class="page-hero fade-in visible"><span class="eyebrow">Tienda Pacha</span><h1>Láminas Vegetales<br><em>Pacha Purum.</em></h1><p>Origen vegetal. Forma nueva.</p></section>';
    }
}

function pacha_woocommerce_fin() {
    echo '</main>';
}

remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
add_action('woocommerce_before_main_content', 'pacha_woocommerce_inicio', 10);
add_action('woocommerce_after_main_content', 'pacha_woocommerce_fin', 10);

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

function pacha_catalogo_referencia() {
    return [
        [
            'nombre' => 'Lámina de zanahoria',
            'slug' => 'laminas-de-zanahoria',
            'precio' => '10800',
            'descripcion' => 'Pack x 6 láminas.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-zanahoria.jpg',
        ],
        [
            'nombre' => 'Láminas de frutas deshidratadas',
            'slug' => 'laminas-de-frutas-deshidratadas',
            'precio' => '14000',
            'descripcion' => '3 láminas de frutas.',
            'categoria' => 'Láminas de fruta',
            'imagen' => 'laminas-frutas-mango.jpg',
        ],
        [
            'nombre' => 'Lámina de tomate con albahaca',
            'slug' => 'lamina-de-tomate-con-albahaca',
            'precio' => '13000',
            'descripcion' => 'Lámina de tomate con albahaca.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-tomate-albahaca.jpg',
        ],
        [
            'nombre' => 'Boniato',
            'slug' => 'laminas-de-boniato',
            'precio' => '13000',
            'descripcion' => 'Pack x 6 láminas.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-boniato.jpg',
        ],
        [
            'nombre' => 'Lámina de choclo',
            'slug' => 'laminas-de-choclo',
            'precio' => '13000',
            'descripcion' => 'Pack x 6 unidades.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-choclo.jpg',
        ],
        [
            'nombre' => 'Portobellos y aceite de trufas',
            'slug' => 'laminas-de-portobellos-y-aceite-de-trufas',
            'precio' => '13200',
            'descripcion' => 'Pack x 6 unidades.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-portobellos-trufa.jpg',
        ],
        [
            'nombre' => 'Láminas de berenjena',
            'slug' => 'laminas-de-berenjena',
            'precio' => '10800',
            'descripcion' => 'Pack x 6 unidades.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-berenjena.jpg',
        ],
        [
            'nombre' => 'Láminas de remolachas',
            'slug' => 'laminas-de-remolacha',
            'precio' => '10800',
            'descripcion' => 'Pack x 6 unidades.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-remolacha.jpg',
        ],
        [
            'nombre' => 'Láminas de morrón',
            'slug' => 'laminas-de-morron',
            'precio' => '10800',
            'descripcion' => 'Pack x 6 láminas.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-morron.jpg',
        ],
        [
            'nombre' => 'Zapallo',
            'slug' => 'laminas-de-zapallo',
            'precio' => '10800',
            'descripcion' => 'Pack x 6 láminas.',
            'categoria' => 'Láminas vegetales',
            'imagen' => 'laminas-zapallo.jpg',
        ],
    ];
}

function pacha_importar_imagen_producto($archivo, $nombre) {
    $existente = get_posts([
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => 1,
        'meta_key' => '_pacha_archivo_producto',
        'meta_value' => $archivo,
        'fields' => 'ids',
    ]);

    if ($existente) {
        $adjunto = (int) $existente[0];
        if (!get_attached_file($adjunto)) {
            $subida = wp_upload_dir();
            $destino = trailingslashit($subida['basedir']) . 'pacha-productos/' . $archivo;
            if (file_exists($destino)) {
                require_once ABSPATH . 'wp-admin/includes/image.php';
                update_attached_file($adjunto, $destino);
                wp_update_attachment_metadata($adjunto, wp_generate_attachment_metadata($adjunto, $destino));
            }
        }
        return $adjunto;
    }

    $origen = get_template_directory() . '/assets/images/productos/' . $archivo;
    if (!file_exists($origen)) {
        return 0;
    }

    $subida = wp_upload_dir();
    $directorio = trailingslashit($subida['basedir']) . 'pacha-productos';
    wp_mkdir_p($directorio);
    $destino = trailingslashit($directorio) . $archivo;

    if (!file_exists($destino) && !copy($origen, $destino)) {
        return 0;
    }

    $tipo = wp_check_filetype($archivo);
    $adjunto = wp_insert_attachment([
        'post_mime_type' => $tipo['type'],
        'post_title' => $nombre,
        'post_content' => '',
        'post_status' => 'inherit',
    ], $destino);

    if (is_wp_error($adjunto)) {
        return 0;
    }

    require_once ABSPATH . 'wp-admin/includes/image.php';
    update_attached_file($adjunto, $destino);
    wp_update_attachment_metadata($adjunto, wp_generate_attachment_metadata($adjunto, $destino));
    update_post_meta($adjunto, '_wp_attachment_image_alt', $nombre);
    update_post_meta($adjunto, '_pacha_archivo_producto', $archivo);

    return (int) $adjunto;
}

function pacha_sincronizar_catalogo() {
    if (!class_exists('WooCommerce')) {
        return new WP_Error('woocommerce_inactivo', 'WooCommerce debe estar activo para cargar el catálogo.');
    }

    $slugs_validos = [];
    foreach (pacha_catalogo_referencia() as $orden => $datos) {
        $slugs_validos[] = $datos['slug'];
        $publicacion = get_page_by_path($datos['slug'], OBJECT, 'product');
        $producto = $publicacion ? wc_get_product($publicacion->ID) : new WC_Product_Simple();

        $producto->set_name($datos['nombre']);
        $producto->set_slug($datos['slug']);
        $producto->set_status('publish');
        $producto->set_catalog_visibility('visible');
        $producto->set_menu_order($orden);
        $producto->set_regular_price($datos['precio']);
        $producto->set_short_description($datos['descripcion']);
        $producto->set_description($datos['descripcion']);
        $producto->set_stock_status('instock');
        $producto->set_manage_stock(false);

        $termino = term_exists($datos['categoria'], 'product_cat');
        if (!$termino) {
            $termino = wp_insert_term($datos['categoria'], 'product_cat');
        }
        if (!is_wp_error($termino)) {
            $producto->set_category_ids([(int) $termino['term_id']]);
        }

        $imagen = pacha_importar_imagen_producto($datos['imagen'], $datos['nombre']);
        if ($imagen) {
            $producto->set_image_id($imagen);
        }

        $producto->set_gallery_image_ids([]);
        $producto->save();
    }

    $anteriores = get_posts([
        'post_type' => 'product',
        'post_status' => ['publish', 'draft', 'pending', 'private'],
        'posts_per_page' => -1,
    ]);
    foreach ($anteriores as $anterior) {
        if (!in_array($anterior->post_name, $slugs_validos, true)) {
            wp_trash_post($anterior->ID);
        }
    }

    return count($slugs_validos);
}
