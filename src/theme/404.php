<?php get_header(); ?>

<div class="wrapper not_fount_page">

    <h2 class="sub-title errorh1"><?php esc_html_e('Error 404', 'hafezkids'); ?></h2>
    <p class="errorp"><?php esc_html_e('Sorry, but the page you\'re looking for has not found. Try checking the URL for errors, then hit the refresh button on your browser.', 'hafezkids'); ?></p>

    <a href="<?php echo esc_js('javascript:history.go(-1)'); ?>" class="hafezkids_button">
        <div class="container">
            <span><?php esc_html_e('Go Back', 'hafezkids'); ?></span>
            <svg class="hafezkids_dashed">
                <rect x="5px" y="5px" rx="26px" ry="26px" width="0" height="0"></rect>
            </svg>
        </div>
    </a>

</div>
<?php get_footer(); ?>