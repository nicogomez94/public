<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<footer class="site-footer">
    <div class="footer-main">
        <div class="footer-brand">
            <a class="brand" href="<?php echo esc_url(home_url('/')); ?>">
                <span class="brand-mark"><i class="fa-solid fa-seedling" aria-hidden="true"></i></span>
                <span class="brand-name">Pacha Purum</span>
            </a>
            <p>Origen vegetal.<br>Forma nueva.</p>
        </div>
        <div>
            <h3>Explorá</h3>
            <a href="<?php echo esc_url(pacha_url_tienda()); ?>">Tienda</a>
            <a href="<?php echo esc_url(home_url('/nosotros/')); ?>">Nuestra raíz</a>
            <a href="<?php echo esc_url(home_url('/#recetario')); ?>">Recetario</a>
        </div>
        <div>
            <h3>Producto</h3>
            <span>100% Vegetal</span>
            <span>Sin TACC</span>
            <span>Sin Conservantes</span>
            <span>Sin Harinas</span>
            <span>Sin Aditivos</span>
        </div>
        <div>
            <h3>Recetario</h3>
            <a href="<?php echo esc_url(pacha_asset('docs/recetario-pacha-purum.pdf')); ?>" target="_blank" rel="noopener">Ver PDF</a>
            <a href="<?php echo esc_url(home_url('/contacto/')); ?>">Contacto</a>
        </div>
    </div>
    <div class="footer-bottom">
        <span>© <?php echo esc_html(date('Y')); ?> Pacha Purum</span>
        <span>Láminas Vegetales</span>
        <span>100% Vegetal · Sin TACC · Sin Conservantes</span>
        <a href="https://zigodev.com.ar" target="_blank" rel="noopener noreferrer">Hecho por zigodev</a>
    </div>
</footer>
<div class="toast" role="status" aria-live="polite"><i class="fa-solid fa-circle-check" aria-hidden="true"></i><span>Listo</span></div>
<?php wp_footer(); ?>
</body>
</html>
