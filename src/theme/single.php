<?php get_header();
$hafezkids_sidebar = 'no_sidebar';
if (is_active_sidebar('main-sidebar')) {
    $hafezkids_sidebar = 'show_sidebar';
}
?>
<div class="wrapper hafezkids_single_post <?php echo esc_attr($hafezkids_sidebar); ?>">
    <div class="post_content">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('partials/posthead'); ?>
                <?php get_template_part('partials/postcontent'); ?>
                <?php get_template_part('partials/postfooter'); ?>
            <?php endwhile;
        else : ?>
            <?php get_template_part('partials/notfound') ?>
        <?php endif; ?>

        <?php if (comments_open() || get_comments_number()) : ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    </div>
    <?php get_sidebar(); ?>
</div>
<?php get_footer(); ?>