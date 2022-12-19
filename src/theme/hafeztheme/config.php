<?php

/**
 * Get current theme options
 * 
 * @return array
 */
function hafez_get_options()
{

    $headerfont = array_merge(hafez_get_safe_webfonts(), hafez_get_google_webfonts());

    $background_defaults = array(
        'color' => '',
        'image' => '',
        'repeat' => 'repeat',
        'position' => 'top center',
        'attachment' => 'scroll',
        'background-size' => 'cover'
    );

    // to do 
    $archive_sidebar = array(
        'no' => esc_html__('No Sideabar', 'hafezkids'),
        'left_third' => esc_html__('1/3 Left', 'hafezkids'),
        'left_fourth' => esc_html__('1/4 Left', 'hafezkids'),
        'right_third' => esc_html__('1/3 Right', 'hafezkids'),
        'right_fourth' => esc_html__('1/4 Right', 'hafezkids')
    );

    $archive_columns = array(
        '1' => esc_html__('One Column', 'hafezkids'),
        '2' => esc_html__('Two Columns', 'hafezkids'),
        '3' => esc_html__('Three Columns', 'hafezkids'),
        '4' => esc_html__('Four Columns', 'hafezkids')
    );



    $imagepath =  HafezTheme_URL . '/assets/images/';

    $options = array();

    $options[] = array(
        "name" => esc_html__("Brand", "hafezkids"),
        "tab" => "hafez-brand",
        "type" => "heading",
        "icon" => "fa-desktop"
    );

    $options[] = array(
        "name" => esc_html__("Site Logo", "hafezkids"),
        "desc" => esc_html__("Upload or put the site logo link.", "hafezkids"),
        "id" => "hafez_sitelogo",
        "std" => "",
        "type" => "upload"
    );

    $options[] = array(
        "name" => esc_html__("Site Logo Retina", "hafezkids"),
        "desc" => esc_html__("Upload or put the site logo link for retina devices. 2X.", "hafezkids"),
        "id" => "hafez_sitelogoretina",
        "std" => "",
        "type" => "upload"
    );

    $options[] = array(
        "name" => esc_html__("Footer Logo", "hafezkids"),
        "desc" => esc_html__("Upload or put the footer logo link.", "hafezkids"),
        "id" => "hafez_footerlogo",
        "std" => "",
        "type" => "upload",
    );

    $options[] = array(
        "name" => esc_html__("Footer Logo Retina", "hafezkids"),
        "desc" => esc_html__("Upload or put the footer logo link for retina devices. 2X.", "hafezkids"),
        "id" => "hafez_footerlogoretina",
        "std" => "",
        "type" => "upload"
    );

    $options[] = array(
        "name" => esc_html__("Style", "hafezkids"),
        "tab" => "hafez-style",
        "type" => "heading",
        "icon" => "fa-window-restore"
    );

    $options[] = array(
        'name' => esc_html__("Manage Background", "hafezkids"),
        'desc' => esc_html__("Select the background color, or upload a custom background image. Default background is the #f5f5f5 color", "hafezkids"),
        'id' => 'hafez_background',
        'std' => $background_defaults,
        'type' => 'background'
    );

    $options[] = array(
        "name" => esc_html__("Site Pre Loader", "hafezkids"),
        "desc" => esc_html__("Enable or Disable the site preloader", "hafezkids"),
        "id" => "hafez_preloder",
        "std" => "disable",
        "type" => "select",
        "options" => array(
            'disable' => esc_html__('Disable', 'hafezkids'),
            'enable' => esc_html__('Enable', 'hafezkids')
        )
    );




    $options[] = array(
        "name" => esc_html__("Footer Options", "hafezkids"),
        "tab" => "hafez-footer-settings",
        "type" => "heading",
        "icon" => "fa-copyright"
    );

    $options[] = array(
        "name" => esc_html__("Footer Info", "hafezkids"),
        "desc" => esc_html__("Insert the footer info text", "hafezkids"),
        "id" => "hafez_footer_info",
        "std" => "",
        "type" => "editor",
    );

    $options[] = array(
        "name" => esc_html__("Openning Hours Title", "hafezkids"),
        "desc" => esc_html__("Specify the title", "hafezkids"),
        "id" => "hafez_footer_openning_title",
        "std" => "",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Openning Hours", "hafezkids"),
        "desc" => esc_html__("Insert the text", "hafezkids"),
        "id" => "hafez_footer_openning_info",
        "std" => "",
        "type" => "editor",
    );

    $options[] = array(
        "name" => esc_html__("Navigation Title", "hafezkids"),
        "desc" => esc_html__("Specify the title", "hafezkids"),
        "id" => "hafez_footer_navigation_title",
        "std" => "",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Contacts Title", "hafezkids"),
        "desc" => esc_html__("Specify the title", "hafezkids"),
        "id" => "hafez_footer_contacts_title",
        "std" => "",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Address", "hafezkids"),
        "desc" => esc_html__("Specify the address", "hafezkids"),
        "id" => "hafez_footer_address",
        "std" => "",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Phone 1", "hafezkids"),
        "desc" => esc_html__("Specify the phone", "hafezkids"),
        "id" => "hafez_footer_phone1",
        "std" => "",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Phone 2", "hafezkids"),
        "desc" => esc_html__("Specify the phone", "hafezkids"),
        "id" => "hafez_footer_phone2",
        "std" => "",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Email", "hafezkids"),
        "desc" => esc_html__("Specify the email", "hafezkids"),
        "id" => "hafez_footer_email",
        "std" => "",
        "type" => "text",
    );


    $options[] = array(
        "name" => esc_html__("Copyrights", "hafezkids"),
        "desc" => esc_html__("Insert the Copyrights text", "hafezkids"),
        "id" => "hafez_copyrights",
        "std" => "",
        "type" => "editor",
    );



    $options[] = array(
        "name" => esc_html__("Typography", "hafezkids"),
        "tab" => "hafez-typography",
        "type" => "heading",
        "icon" => "fa-font"
    );

    $options[] = array(
        "name" => esc_html__("Select the First Font from Google Library", "hafezkids"),
        "desc" => esc_html__("The default Font is - Nunito", "hafezkids"),
        "id" => "hafez_font_one",
        "std" => "Nunito",
        "type" => "select",
        "options" => $headerfont
    );

    $options[] = array(
        "name" => esc_html__("Select the First Font Properties from Google Library", "hafezkids"),
        "desc" => esc_html__("The default Font (extended) is - 700,900", "hafezkids"),
        "id" => "hafez_font_one_ex",
        "std" => "400;700;900",
        "type" => "text",
    );

    $options[] = array(
        "name" => esc_html__("Select the Second Font from Google Library", "hafezkids"),
        "desc" => esc_html__("The default Font is - Playfair Display", "hafezkids"),
        "id" => "hafez_font_two",
        "std" => "Roboto",
        "type" => "select",
        "options" => $headerfont
    );

    $options[] = array(
        "name" => esc_html__("Select the Second Font Properties from Google Library", "hafezkids"),
        "desc" => esc_html__("The default Font (extended) is - 400", "hafezkids"),
        "id" => "hafez_font_two_ex",
        "std" => "400;700;900",
        "type" => "text",
    );


    $options[] = array(
        'name' => esc_html__("H1 Style", "hafezkids"),
        'desc' => esc_html__("Change the h1 style", "hafezkids"),
        'id' => 'hafez_h1sty',
        'std' => array('size' => '32px', 'face' => 'Nunito', 'style' => 'normal', 'transform' => 'none', 'weight' => '900', 'lineheight' => 'normal', 'color' => '#304566'),
        'type' => 'typography'
    );

    $options[] = array(
        'name' => esc_html__("H2 Style", "hafezkids"),
        'desc' => esc_html__("Change the h2 style", "hafezkids"),
        'id' => 'hafez_h2sty',
        'std' => array('size' => '28px', 'face' => 'Nunito', 'style' => 'normal', 'transform' => 'none', 'weight' => '900', 'lineheight' => 'normal', 'color' => '#304566'),
        'type' => 'typography'
    );

    $options[] = array(
        'name' => esc_html__("H3 Style", "hafezkids"),
        'desc' => esc_html__("Change the h3 style", "hafezkids"),
        'id' => 'hafez_h3sty',
        'std' => array('size' => '24px', 'face' => 'Nunito', 'style' => 'normal', 'transform' => 'none', 'weight' => '900', 'lineheight' => 'normal', 'color' => '#304566'),
        'type' => 'typography'
    );

    $options[] = array(
        'name' => esc_html__("H4 Style", "hafezkids"),
        'desc' => esc_html__("Change the h4 style", "hafezkids"),
        'id' => 'hafez_h4sty',
        'std' => array('size' => '20px', 'face' => 'Nunito', 'style' => 'normal', 'transform' => 'none', 'weight' => '900', 'lineheight' => 'normal', 'color' => '#304566'),
        'type' => 'typography'
    );

    $options[] = array(
        'name' => esc_html__("H5 Style", "hafezkids"),
        'desc' => esc_html__("Change the h5 style", "hafezkids"),
        'id' => 'hafez_h5sty',
        'std' => array('size' => '16px', 'face' => 'Nunito', 'style' => 'normal', 'transform' => 'none', 'weight' => '900', 'lineheight' => 'normal', 'color' => '#304566'),
        'type' => 'typography'
    );

    $options[] = array(
        'name' => esc_html__("H6 Style", "hafezkids"),
        'desc' => esc_html__("Change the h6 style", "hafezkids"),
        'id' => 'hafez_h6sty',
        'std' => array('size' => '14px', 'face' => 'Nunito', 'style' => 'normal', 'transform' => 'none', 'weight' => '900', 'lineheight' => 'normal', 'color' => '#304566'),
        'type' => 'typography'
    );

    $options[] = array(
        'name' => esc_html__("Body Style", "hafezkids"),
        'desc' => esc_html__("Change the body font style", "hafezkids"),
        'id' => 'hafez_bodystyle',
        'std' => array('size' => '18px', 'face' => 'Roboto', 'style' => 'normal', 'transform' => 'none', 'weight' => '400', 'lineheight' => '28px', 'color' => '#7D7D7D'),
        'type' => 'typography'
    );

    $options[] = array(
        "name" => esc_html__("Social Profiles & Share", "hafezkids"),
        "tab" => "hafez-social-profile",
        "type" => "heading",
        "icon" => "fa-address-book"
    );

    $options[] = array(
        "name" => esc_html__("Twitter", "hafezkids"),
        "desc" => esc_html__("Your twitter profile URL.", "hafezkids"),
        "id" => "hafez_twi",
        "std" => "",
        "type" => "text"
    );

    $options[] = array(
        "name" => esc_html__("Facebook", "hafezkids"),
        "desc" => esc_html__("Your facebook profile URL.", "hafezkids"),
        "id" => "hafez_fb",
        "std" => "",
        "type" => "text"
    );

    $options[] = array(
        "name" => esc_html__("Youtube", "hafezkids"),
        "desc" => esc_html__("Your youtube profile URL.", "hafezkids"),
        "id" => "hafez_you",
        "std" => "",
        "type" => "text"
    );

    $options[] = array(
        "name" => esc_html__("LinkedIn", "hafezkids"),
        "desc" => esc_html__("Your LinkedIn profile URL.", "hafezkids"),
        "id" => "hafez_lin",
        "std" => "",
        "type" => "text",
        "hidefor" => array("hafez_design_variant", array('bebe'))
    );

    $options[] = array(
        "name" => esc_html__("Pinterest", "hafezkids"),
        "desc" => esc_html__("Your Pinterest profile URL.", "hafezkids"),
        "id" => "hafez_pin",
        "std" => "",
        "type" => "text"
    );


    $options[] = array(
        "name" => esc_html__("Tumblr", "hafezkids"),
        "desc" => esc_html__("Your Tumblr profile URL.", "hafezkids"),
        "id" => "hafez_tum",
        "std" => "",
        "type" => "text",
        "hidefor" => array("hafez_design_variant", array('bebe'))
    );

    $options[] = array(
        "name" => esc_html__("Instagram", "hafezkids"),
        "desc" => esc_html__("Your Instagram profile URL.", "hafezkids"),
        "id" => "hafez_insta",
        "std" => "",
        "type" => "text"
    );

    $options[] = array(
        "name" => esc_html__("Reddit", "hafezkids"),
        "desc" => esc_html__("Your Reddit profile URL.", "hafezkids"),
        "id" => "hafez_red",
        "std" => "",
        "type" => "text",
        "hidefor" => array("hafez_design_variant", array('bebe'))
    );

    $options[] = array(
        "name" => esc_html__("VK", "hafezkids"),
        "desc" => esc_html__("Your VK profile URL.", "hafezkids"),
        "id" => "hafez_vk",
        "std" => "",
        "type" => "text",
        "hidefor" => array("hafez_design_variant", array('bebe'))
    );


    $options[] = array(
        "name" => esc_html__("Gallery Settings", "hafezkids"),
        "tab" => "hafez-gallery-settings",
        "type" => "heading",
    );

    $options[] = array(
        "name" => esc_html__("Posts Count", "hafezkids"),
        "desc" => esc_html__("Specify posts per page count", "hafezkids"),
        "id" => "hafez_gallery_count",
        "std" => "4",
        "type" => "text"
    );

    $options[] = array(
        "name" => esc_html__("WooCommerce Settings", "hafezkids"),
        "tab" => "hafez-woocommerce-settings",
        "type" => "heading",
        "icon" => "fa-newspaper-o"
    );

    $options[] = array(
        "name" => esc_html__("Columns Count", "hafezkids"),
        "desc" => esc_html__("Select the columns count for WooCommerce pages", "hafezkids"),
        "id" => "hafez_woo_columns",
        "std" => "3",
        "type" => "select",
        "options" => $archive_columns
    );

    $options[] = array(
        "name" => esc_html__("Products per page", "hafezkids"),
        "desc" => esc_html__("Specify the products per page count. by default it is 8", "hafezkids"),
        "id" => "hafez_products_per_page",
        "std" => "9",
        "type" => "text"
    );

    return $options;
}




/**
 * Get image sizes for images
 * 
 * @return array
 */
function hafez_get_images_sizes()
{
    return array(

        'post' => array(
            array(
                'name'      => 'post-smallimage',
                'width'     => 380,
                'height'    => 300,
                'crop'      => true,
            ),
            array(
                'name'      => 'post-bigimage',
                'width'     => 780,
                'height'    => 300,
                'crop'      => true,
            ),
            array(
                'name'      => 'post-featured',
                'width'     => 1180,
                'height'    => 700,
                'crop'      => true,
            ),

        ),

        'gallery' => array(
            array(
                'name'      => 'gallery-square',
                'width'     => 495,
                'height'    => 500,
                'crop'      => true,
            ),
            array(
                'name'      => 'gallery-slider',
                'width'     => 780,
                'height'    => 480,
                'crop'      => true,
            ),

        ),
    );
}

/**
 * Add post formats that are used in theme
 * 
 * @return array
 */
function hafez_get_post_formats()
{
    return array('gallery', 'link', 'quote', 'video', 'audio');
}


/**
 * Post types where metaboxes should show
 * 
 * @return array
 */
function hafez_get_post_types_with_gallery()
{
    return array('gallery');
}

/**
 * Add custom fields for media attachments
 * @return array
 */
function hafez_media_custom_fields()
{
    return array();
}
