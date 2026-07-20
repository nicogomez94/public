<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main>
    <section class="page-hero fade-in">
        <span class="eyebrow">Nuestra raíz</span>
        <h1>Pacha Purum nace<br><em>desde un lugar honesto.</em></h1>
        <p>Origen vegetal. Forma nueva.</p>
    </section>
    <section class="how-section fade-in">
        <div class="how-image">
            <img src="<?php echo esc_url(pacha_asset('images/productos/laminas-frutas-kiwi.jpg')); ?>" alt="Lámina de fruta de kiwi Pacha Purum">
        </div>
        <div class="how-copy">
            <span class="eyebrow light">Pacha Purum</span>
            <h2>Resignificar<br><em>lo vegetal.</em></h2>
            <p>Desde un lugar que, durante mucho tiempo, quedó vacío. Escuchamos una y otra vez que debemos alimentarnos mejor, incorporar más vegetales y cuidar nuestro cuerpo. Sin embargo, cuando buscamos opciones creativas, la harina sigue siendo la gran protagonista.</p>
            <p>Nuestra intención no es reemplazar la harina. Nuestra intención es resignificar lo vegetal.</p>
        </div>
    </section>
    <section class="how-section how-section-alt fade-in">
        <div class="how-copy">
            <span class="eyebrow light">Nuestra intención</span>
            <h2>El lugar principal<br><em>de un plato.</em></h2>
            <p>Demostrar que los vegetales pueden ocupar el lugar principal de un plato, sorprendiendo por su sabor, su textura y su versatilidad.</p>
            <p>Porque creemos que comer rico y cuidar nuestro cuerpo pueden ir de la mano. Cada lámina fue pensada para inspirarte.</p>
        </div>
        <div class="how-image">
            <img src="<?php echo esc_url(pacha_asset('images/productos/laminas-frutas-kiwi.jpg')); ?>" alt="Lámina de fruta de kiwi Pacha Purum">
        </div>
    </section>
</main>
<?php
get_footer();
