<?php
if (!defined('ABSPATH')) {
    exit;
}
get_header();
?>
<main class="page-default">
    <section class="page-hero fade-in visible">
        <span class="eyebrow">Pacha Purum</span>
        <h1><?php single_post_title(); ?></h1>
    </section>
    <section class="section fade-in visible">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_content();
            }
        }
        ?>
    </section>
</main>
<?php
get_footer();

