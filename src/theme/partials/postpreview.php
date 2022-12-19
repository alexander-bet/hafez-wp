<?php
$archive_year  = get_the_time('Y');
$archive_month = get_the_time('m');
$archive_day   = get_the_time('d');
$posts_classes = 'hafezkids_blog_preview';
if (!empty($args['post_class']) && $args['exist_sticky'] !== '1') {
    $posts_classes .= ' ' . $args['post_class'];
}
if (!empty($args['exist_sticky']) && $args['exist_sticky'] == '1') {
    $args['featured_image'] = 'post-smallimage';
}

if (!get_the_post_thumbnail(get_the_ID())) {
    $posts_classes .= ' no_featured_image';
}

?>

<article <?php post_class($posts_classes); ?> id="post-<?php the_ID() ?>" data-post-id="<?php the_ID() ?>">
    <?php if (get_the_post_thumbnail($post->ID, 'post-smallimage')) { ?>
        <div class="featured_image">

            <?php
            $hafezkids_post_format = get_post_format();
            if ($hafezkids_post_format == 'video') {

                //Get Image
                if (!empty($args['featured_image'])) {
                    echo get_the_post_thumbnail($post->ID, $args['featured_image']);
                }

                //Get Video Button
                get_template_part('partials/format/video');
            } elseif ($hafezkids_post_format == 'gallery') {

                //Get Slider
                get_template_part('partials/format/gallery', '', $args['featured_image']);
            } else {

                //Get Image
                if (!empty($args['featured_image'])) {
                    echo '<div class="featured_image_holder"><a href="' . esc_url(get_the_permalink()) . '">';
                    echo get_the_post_thumbnail($post->ID, $args['featured_image']);
                    echo '</a></div>';
                }
            } ?>

            <span class="category font_one">
                <?php
                $hafezkids_categories = get_the_category();

                if (!empty($hafezkids_categories)) {
                    $i = 0;
                    foreach ($hafezkids_categories as $cat) {
                        echo '<a href="' . esc_url(get_category_link($cat->term_id)) . '" rel="category tag">' . esc_html($cat->name) . '</a>';
                        $i++;
                        if ($i == 5) break;
                    }
                }
                ?>
            </span>
        </div>
    <?php } ?>
    <span class="post_info">
        <span class="inner_info"><?php esc_html_e('By', 'hafezkids'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php the_author(); ?></a></span> <span class="inner_info"><?php esc_html_e('Posted on', 'hafezkids'); ?> <?php echo '<a href="' . esc_attr(get_day_link($archive_year, $archive_month, $archive_day)) . '">' . get_the_date() . '</a>'; ?></span>

        <?php if (!get_the_post_thumbnail()) { ?>
            <span class="inner_info">
                <?php esc_html_e('Posted in:', 'hafezkids') ?> <?php the_category(', '); ?>
            </span>
        <?php } ?>
    </span>


    <h3><a href="<?php echo esc_url(the_permalink()); ?>"><?php the_title(); ?></a></h3>

    <div class="post_excerpt">
        <?php
        if (!empty($args['post_class']) and $args['post_class'] == 'bigpost') {
            echo wp_kses_post(hafez_trim_excerpt(60));
        } else {
            echo wp_kses_post(hafez_trim_excerpt(23));
        } ?>
    </div>

    <a class="read_more_blog font_one" href="<?php echo esc_url(the_permalink()); ?>"><?php esc_html_e('Read More', 'hafezkids'); ?></a>

</article>