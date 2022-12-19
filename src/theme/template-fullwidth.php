<?php

/**
 * Template name: hafezKids Full Width
 */
get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <section <?php post_class('story'); ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
            <?php the_content(); ?>

            <?php wp_link_pages(array(
                'before' => '<p class="post_pages">' . esc_html__('Pages:', 'hafezkids'),
                'after'     => '</p>',
            )) ?>
        </section>

    <?php endwhile;
else : ?>
    <?php get_template_part('partials/notfound') ?>
<?php endif; ?>

<?php if (comments_open()) : ?>
    <?php comments_template(); ?>
<?php endif; ?>

<?php get_footer(); ?>