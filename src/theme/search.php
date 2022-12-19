<?php get_header(); ?>
<div class="wrapper">
    <?php
    $hafezkids_blog_grid = ['featured_image' => 'post-smallimage', 'post_class' => 'smallpost', 'exist_sticky' => ''];
    $i = 1;

    if (have_posts()) {
        echo '<div class="posts_grid search_archive_page">';
        while (have_posts()) : the_post();
            if ($i == 4) {
                $hafezkids_blog_grid['featured_image'] = 'post-bigimage';
                $hafezkids_blog_grid['post_class'] = 'bigpost';
            } else {
                $hafezkids_blog_grid['featured_image'] = 'post-smallimage';
                $hafezkids_blog_grid['post_class'] = 'smallpost';
            }
            get_template_part('partials/postpreview', '', $hafezkids_blog_grid);
            $i++;
        endwhile;
        echo '</div>';

        get_template_part('partials/pagination');
    } else {
        get_template_part('partials/notfound');
    } ?>
</div>
<?php get_footer(); ?>