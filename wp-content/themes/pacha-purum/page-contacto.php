<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main>
    <section class="page-hero fade-in">
        <span class="eyebrow">Contacto</span>
        <h1>Pacha Purum<br><em>Láminas Vegetales.</em></h1>
        <p>Origen vegetal. Forma nueva.</p>
    </section>
    <section class="section story fade-in">
        <div class="story-title">
            <span class="eyebrow">Recetario</span>
            <h2>Recetas,<br>inspiración<br><em>y técnicas.</em></h2>
        </div>
        <div class="story-copy">
            <p class="lead">Escaneá el QR y descubrí nuestro recetario.</p>
            <p>100% Vegetal · Sin TACC · Sin Conservantes.</p>
            <a href="<?php echo esc_url(pacha_asset('docs/recetario-pacha-purum.pdf')); ?>" target="_blank" rel="noopener" class="text-link">Ver recetario <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i></a>
        </div>
        <div class="story-seal"><i class="fa-solid fa-seedling" aria-hidden="true"></i><span>PACHA PURUM<br>LÁMINAS VEGETALES</span></div>
    </section>
</main>
<?php
get_footer();

