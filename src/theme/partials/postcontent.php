    <?php
    $archive_year  = get_the_time('Y');
    $archive_month = get_the_time('m');
    $archive_day   = get_the_time('d');
    ?>
    <?php if (get_the_post_thumbnail($post->ID, 'post-featured')) { ?>
        <div class="featured_image">
            <?php
            $hafezkids_post_format = get_post_format();
            if ($hafezkids_post_format == 'video') {
                echo get_the_post_thumbnail($post->ID, 'post-featured');
                //Get Video Button
                get_template_part('partials/format/video');
            } elseif ($hafezkids_post_format == 'gallery') {

                //Get Slider
                get_template_part('partials/format/gallery', '', 'post-featured');
            } else {

                //Get Image
                echo get_the_post_thumbnail($post->ID, 'post-featured');
            } ?>

            <span class="category font_one"><?php the_category(' '); ?></span>
        </div>
    <?php } ?>

    <span class="post_info">
        <?php esc_html_e('By', 'hafezkids'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a> <?php esc_html_e('posted on', 'hafezkids'); ?> <?php echo '<a href="' . esc_attr(get_day_link($archive_year, $archive_month, $archive_day)) . '">' . get_the_date() . '</a>'; ?>.

        <?php if (!get_the_post_thumbnail()) { ?>
            <?php esc_html_e('Posted in:', 'hafezkids') ?> <?php the_category(', '); ?>
        <?php } ?>
    </span>

    <div class="colored_line top_line">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>

    <?php the_content(); ?>

    <?php wp_link_pages(array(
        'before' => '<p class="post_pages">' . esc_html__('Pages:', 'hafezkids'),
        'after'     => '</p>',
    )); ?>

    <?php if (get_the_tags()) { ?>
        <p class="tagsphar"><?php the_tags('', ' ', '');  ?></p>
    <?php } ?>

    <div class="colored_line blog_single_bottom">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>