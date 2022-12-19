<?php get_header(); ?>

<div class="wrapper hafezkids_page_template">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

            <?php get_template_part('partials/pagehead') ?>
            <?php the_content(); ?>

            <?php wp_link_pages(array(
                'before' => '<p class="post_pages">' . esc_html__('Pages:', 'hafezkids'),
                'after'     => '</p>',
            )) ?>
            <?php get_template_part('partials/pagefooter') ?>
        <?php endwhile;
    else : ?>
        <?php get_template_part('partials/notfound') ?>
    <?php endif; ?>

    <?php if (comments_open()) : ?>
        <?php comments_template(); ?>
    <?php endif; ?>

</div>
<?php get_footer(); ?>