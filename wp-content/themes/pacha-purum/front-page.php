<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main>
    <section class="view active" data-view="home" aria-label="Inicio">
        <section class="hero fade-in">
            <div class="hero-copy">
                <span class="eyebrow"><i class="fa-solid fa-leaf" aria-hidden="true"></i> Origen vegetal. Forma nueva.</span>
                <h1>Pacha Purum<br><em>Láminas Vegetales</em></h1>
                <p>Creamos láminas 100% vegetales para que cocinar sea una experiencia diferente: más natural, más consciente y, sobre todo, deliciosa.</p>
                <div class="hero-actions">
                    <a class="button button-primary" href="<?php echo esc_url(pacha_url_tienda()); ?>">Conocé tus láminas <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
                    <button class="text-link" data-scroll="como-usarlas">Antes de comenzar <i class="fa-solid fa-play" aria-hidden="true"></i></button>
                </div>
                <div class="hero-proof">
                    <div class="avatars"><span>PP</span><span>LV</span><span>ST</span></div>
                    <div><div class="stars">★★★★★</div><small>100% Vegetal · Sin TACC · Sin Conservantes</small></div>
                </div>
            </div>

            <div class="hero-visual" aria-label="Láminas vegetales Pacha Purum">
                <span class="hero-sun"></span>
                <span class="orbit-copy">100% VEGETAL · SIN TACC ·</span>
                <div class="pack pack-hero pack-tomato">
                    <div class="pack-top">LÁMINAS VEGETALES</div>
                    <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                    <strong>Pacha Purum</strong>
                    <small>origen vegetal · forma nueva</small>
                    <span>Sin conservantes</span>
                </div>
                <div class="pack pack-side pack-spinach">
                    <div class="pack-top">LÁMINAS VEGETALES</div>
                    <i class="fa-solid fa-seedling" aria-hidden="true"></i>
                    <strong>Vegetales</strong>
                    <small>artesanal y natural</small>
                </div>
                <span class="hero-sticker">SIN<br><b>TACC</b></span>
                <span class="scribble"><i class="fa-solid fa-arrow-turn-up" aria-hidden="true"></i> fácil de preparar</span>
            </div>
        </section>

        <section class="marquee" aria-label="Beneficios">
            <div class="marquee-track">
                <span>Sin harinas</span><i class="fa-solid fa-seedling" aria-hidden="true"></i>
                <span>Sin aditivos</span><i class="fa-solid fa-seedling" aria-hidden="true"></i>
                <span>Sin conservantes</span><i class="fa-solid fa-seedling" aria-hidden="true"></i>
                <span>100% vegetal</span><i class="fa-solid fa-seedling" aria-hidden="true"></i>
                <span>Sin TACC</span><i class="fa-solid fa-seedling" aria-hidden="true"></i>
                <span>Natural</span><i class="fa-solid fa-seedling" aria-hidden="true"></i>
            </div>
        </section>

        <section class="section bestsellers fade-in" id="productos">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Conocé tus</span>
                    <h2>Láminas<br><em>Pacha Purum.</em></h2>
                </div>
                <a class="text-link desktop-only" href="<?php echo esc_url(pacha_url_tienda()); ?>">Ver tienda <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="product-grid">
                <?php
                if (class_exists('WooCommerce')) {
                    $posts_productos = get_posts([
                        'post_type' => 'product',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'orderby' => 'menu_order',
                        'order' => 'ASC',
                    ]);
                    if ($posts_productos) {
                        foreach ($posts_productos as $post_producto) {
                            $producto = wc_get_product($post_producto->ID);
                            if ($producto) {
                                pacha_tarjeta_producto($producto);
                            }
                        }
                    } else {
                        pacha_tarjeta_laminas_estatica();
                    }
                } else {
                    pacha_tarjeta_laminas_estatica();
                }
                ?>
            </div>
            <a class="button button-outline mobile-only" href="<?php echo esc_url(pacha_url_tienda()); ?>">Ver tienda</a>
        </section>

        <section class="how-section fade-in" id="como-usarlas">
            <div class="how-image">
                <img src="<?php echo esc_url(pacha_asset('images/productos/laminas-tomate-albahaca.jpg')); ?>" alt="Lámina de tomate con albahaca Pacha Purum">
                <span class="image-note">Fácil de<br>preparar</span>
            </div>
            <div class="how-copy">
                <span class="eyebrow light">Antes de comenzar</span>
                <h2>Conocé tus<br><em>láminas.</em></h2>
                <p>Cada lámina Pacha Purum está elaborada artesanalmente con vegetales cuidadosamente seleccionados. Nuestro objetivo es que disfrutes una cocina más natural, respetando el sabor y las propiedades propias de cada ingrediente.</p>
                <ol class="steps">
                    <li><b>01</b><span><strong>Listas para usar</strong><small>Ya están cocidas y pueden consumirse directamente o incorporarse a preparaciones frías y calientes.</small></span></li>
                    <li><b>02</b><span><strong>Manipulalas con delicadeza</strong><small>Poseen una textura suave y flexible. Manipulalas con cuidado para conservar su forma.</small></span></li>
                    <li><b>03</b><span><strong>No hervir ni hidratar</strong><small>No requieren hidratación previa ni deben cocinarse en agua hirviendo.</small></span></li>
                </ol>
                <a class="button button-cream" href="<?php echo esc_url(pacha_url_tienda()); ?>">Ir a la tienda</a>
            </div>
        </section>

        <section class="section story fade-in" id="story">
            <div class="story-title">
                <span class="eyebrow">Nuestra raíz</span>
                <h2>Resignificar<br>lo vegetal.<br><em>Inspirarte.</em></h2>
            </div>
            <div class="story-copy">
                <p class="lead">Pacha Purum nace desde un lugar honesto.</p>
                <p>Nuestra intención no es reemplazar la harina. Nuestra intención es resignificar lo vegetal. Demostrar que los vegetales pueden ocupar el lugar principal de un plato, sorprendiendo por su sabor, su textura y su versatilidad.</p>
                <a href="<?php echo esc_url(home_url('/nosotros/')); ?>" class="text-link">Conocé nuestra raíz <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></a>
            </div>
            <div class="story-seal"><i class="fa-solid fa-seedling" aria-hidden="true"></i><span>ORIGEN VEGETAL<br>FORMA NUEVA</span></div>
        </section>

        <section class="section recipes fade-in" id="recetario">
            <div class="section-heading">
                <div>
                    <span class="eyebrow">Recetario</span>
                    <h2>Recetas, inspiración<br><em>y técnicas.</em></h2>
                </div>
                <a href="<?php echo esc_url(pacha_asset('docs/recetario-pacha-purum.pdf')); ?>" target="_blank" rel="noopener" class="text-link desktop-only">Ver PDF <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
            </div>
            <div class="recipe-grid">
                <article class="recipe-card recipe-large">
                    <img src="<?php echo esc_url(pacha_asset('images/recetario-pacha-purum.png')); ?>" alt="Recetario Láminas Vegetales Pacha Purum">
                    <div><span>Pacha Purum</span><h3>Recetario Láminas Vegetales</h3></div>
                </article>
                <article class="recipe-card">
                    <img src="<?php echo esc_url(pacha_asset('images/qr-recetario-pacha-purum.jpeg')); ?>" alt="Código QR del recetario Pacha Purum">
                    <div><span>Escaneá el QR</span><h3>Descubrí nuestro recetario</h3></div>
                </article>
                <article class="recipe-card quote-card">
                    <i class="fa-solid fa-quote-left" aria-hidden="true"></i>
                    <p>Dejate llevar por tu creatividad. Sorprendete. Sorprendé.</p>
                    <span>Bienvenido al universo Pacha Purum.</span>
                </article>
            </div>
        </section>

        <section class="newsletter fade-in">
            <span class="newsletter-icon"><i class="fa-solid fa-seedling" aria-hidden="true"></i></span>
            <div><span class="eyebrow light">Láminas Vegetales</span><h2>Natural,<br>nutritivo<br>y <em>sin conservantes.</em></h2></div>
            <a class="button button-cream" href="<?php echo esc_url(pacha_url_tienda()); ?>">Conocer producto</a>
            <small>Fácil de preparar · 100% Vegetal · Sin TACC</small>
        </section>
    </section>
</main>
<?php
get_footer();
