<?php get_header(); ?>
<div class="wrapper">
    <?php
    $hafezkids_blog_grid = ['featured_image' => 'post-smallimage', 'post_class' => 'smallpost', 'exist_sticky' => ''];
    $i = 1;

    if (have_posts()) {
        echo '<div class="posts_grid">';
        while (have_posts()) : the_post();

            if ($i == 4) {
                $hafezkids_blog_grid['featured_image'] = 'post-bigimage';
                $hafezkids_blog_grid['post_class'] = 'bigpost';
            } else {
                $hafezkids_blog_grid['featured_image'] = 'post-smallimage';
                $hafezkids_blog_grid['post_class'] = 'smallpost';
            }

            //Change grid if sticky post exist.
            $hafezkids_sticky_post_ids = array();
            $hafezkids_sticky_post_ids = get_option('sticky_posts');

            foreach ($hafezkids_sticky_post_ids as $sticky_id) {
                if ($sticky_id == get_the_ID()) {
                    $hafezkids_blog_grid['exist_sticky'] = '1';
                }
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