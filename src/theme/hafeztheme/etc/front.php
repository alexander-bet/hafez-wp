<?php

/**
 * Enqueue Theme Styles
 */
function hafez_enqueue_styles()
{
    wp_enqueue_style('hafezkids_styles', HAFEZTHEME_THEME_URL . '/assets/css/main.css', array(), HAFEZTHEME_THEME_VERSION, 'all');
}
add_action('wp_enqueue_scripts', 'hafez_enqueue_styles');


/**
 * Enqueue Theme Scripts
 */
function hafez_enqueue_scripts()
{

    //Libs
    //wp_register_script( 'venobox', HAFEZTHEME_THEME_URL . '/assets/js/libs/venobox.min.js', array( 'jquery' ), HAFEZTHEME_THEME_VERSION, true );
    //wp_register_script( 'slick', HAFEZTHEME_THEME_URL . '/assets/js/libs/slick.min.js', array( 'jquery' ), HAFEZTHEME_THEME_VERSION, true );
    // wp_register_script('hafez-appear', HAFEZTHEME_THEME_URL . '/assets/js/libs/jquery.appear.js', array('jquery'), HAFEZTHEME_THEME_VERSION, true);

    wp_enqueue_script('hafez-scripts', HAFEZTHEME_THEME_URL . '/assets/js/scripts.min.js', array('jquery'), HAFEZTHEME_THEME_VERSION, true);


    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'hafez_enqueue_scripts');

/**
 * Register Fonts
 */
function hafez_google_font_one()
{
    $font_url = '';
    $hafez_font_one = hafez_get_option('font_one');
    $hafez_font_one_ex = hafez_get_option('font_one_ex');

    if ('off' !== _x('on', $hafez_font_one . ' font: on or off', 'hafezkids')) {
        $query_args = array(
            'family' =>  urlencode(str_replace('+', ' ', $hafez_font_one) . ":wght@" . esc_attr($hafez_font_one_ex)),
            'subset' => urlencode('latin,latin-ext'),
            'display' => urlencode('swap'),
        );
        $font_url = add_query_arg($query_args, '//fonts.googleapis.com/css2');
    }

    return $font_url;
}

function hafez_google_font_two()
{
    $font_url = '';
    $hafez_font_two = hafez_get_option('font_two');
    $hafez_font_two_ex = hafez_get_option('font_two_ex');

    if ('off' !== _x('on', $hafez_font_two . ' font: on or off', 'hafezkids')) {
        $query_args = array(
            'family' =>  urlencode(str_replace('+', ' ', $hafez_font_two) . ":wght@" . esc_attr($hafez_font_two_ex)),
            'subset' => urlencode('latin,latin-ext'),
            'display' => urlencode('swap'),
        );
        $font_url = add_query_arg($query_args, '//fonts.googleapis.com/css2');
    }

    return $font_url;
}
/**
 * Enqueue scripts and styles.
 */
function hafez_google_fonts_scripts()
{
    wp_enqueue_style('hafezkids-google-font-one', hafez_google_font_one(), array(), '1.0.0');
    wp_enqueue_style('hafezkids-google-font-two', hafez_google_font_two(), array(), '1.0.0');
}
add_action('wp_enqueue_scripts', 'hafez_google_fonts_scripts');


/**
 * Add header information 
 */
function hafez_head()
{
?>
    <meta name="viewport" content="width=device-width, initial-schafez=1, maximum-schafez=1" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> <?php esc_html_e('RSS Feed', 'hafezkids') ?>" href="<?php hafez_rss(); ?>" />
    <link rel="preconnect" href="//fonts.gstatic.com">
<?php
    get_template_part('partials/css-option');
}
add_action('wp_head', 'hafez_head');


/**
 * Comment callback function
 * @param object $comment
 * @param array $args
 * @param int $depth
 */


function hafezkids_comment_default($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo esc_attr($tag) ?> <?php comment_class(empty($args['has_children']) ? '' : 'parent') ?> id="comment-<?php comment_ID() ?>">
        <?php if ('div' != $args['style']) : ?>
            <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
            <?php endif; ?>
            <?php if ($depth > 1) { ?>
                <div class="comment-item comment2 second-level cf">
                    <div class="response"></div>
                <?php } else { ?>
                    <div class="comment-item comment1 first-level cf">
                    <?php } ?>
                    <div class="left_part">
                        <div class="commenter-avatar">
                            <div class="circle_avatar"></div>
                            <?php if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
                        </div>
                        <span class="comment_date font_one">
                            <?php echo esc_html(get_comment_date()); ?>
                        </span>
                    </div>

                    <div class="comment-box">
                        <div class="info-meta font_one">
                            <?php printf("<span class='author'>" . esc_html__('%s', 'hafezkids') . "</span>", get_comment_author_link()); ?>
                            <?php if ($depth == 1) { ?><span class="reply-link"><?php comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span><?php } ?>
                        </div>
                        <div class="info-content">
                            <?php if ($comment->comment_approved == '0') : ?>
                                <em class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'hafezkids') ?></em>
                                <br />
                            <?php endif; ?>
                            <?php comment_text() ?>
                        </div>
                    </div>

                    </div>
                    <?php if ('div' != $args['style']) : ?>
                </div>
            <?php endif; ?>
        <?php
    }

    add_action(
        'after_setup_theme',
        function () {
            add_theme_support('html5', ['script', 'style']);
        }
    );
