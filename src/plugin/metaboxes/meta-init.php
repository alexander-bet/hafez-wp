<?php

/**
 * Add Metaboxes
 * @param array $meta_boxes
 * @return array 
 */
function hafez_metaboxes($meta_boxes)
{

    $meta_boxes = array();

    $prefix = "hafez_";


    $meta_boxes[] = array(
        'id'         => 'pages_metabox',
        'title'      => esc_html__('Pages Settings', 'hafez'),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(

            array(
                'name' => esc_html__('Select Icon for Heading', 'hafez'),
                'desc' => esc_html__('Select a specified icon for page heading.', 'hafez'),
                'id'   => $prefix . 'post_heading_icon',
                'type'    => 'select',
                'options' => array(
                    array('name' => esc_html__('Sun Icon', 'hafez'), 'value' => 'sun',),
                    array('name' => esc_html__('Map Icon', 'hafez'), 'value' => 'mapicon',),
                    array('name' => esc_html__('Shafez Icon', 'hafez'), 'value' => 'shafezicon',),
                    array('name' => esc_html__('Gallery Icon', 'hafez'), 'value' => 'galicon',),
                    array('name' => esc_html__('Leaf Icon', 'hafez'), 'value' => 'listicon',),
                ),
            ),

        )
    );
    $meta_boxes[] = array(
        'id'         => 'sidebar_metabox',
        'title'      => esc_html__('Sidebar Settings', 'hafez'),
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'show_on' => array('key' => 'page-template', 'value' => array('template-pagewithsidebar.php'),),
        'fields' => array(


            array(
                'name' => esc_html__('Sidebar', 'hafez'),
                'desc' => esc_html__('Select a sidebar position or disable it', 'hafez'),
                'id'   => $prefix . 'sidebar_position',
                'type'    => 'select',
                'options' => array(
                    array('name' => esc_html__('Disable Sidebar', 'hafez'), 'value' => 'no',),
                    array('name' => esc_html__('Left Sidebar', 'hafez'), 'value' => 'leftsidebar',),
                    array('name' => esc_html__('Right Sidebar', 'hafez'), 'value' => 'rightsidebar',),
                ),
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'posts_metabox',
        'title'      => esc_html__('Posts Settings', 'hafez'),
        'pages'      => array('post'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_html__('Video Link for Video Format Post', 'hafez'),
                'desc' => esc_html__('Specify a video link', 'hafez'),
                'id'   => $prefix . 'video_link',
                'type'    => 'text',
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'galleries_metabox',
        'title'      => esc_html__('Gallery Settings', 'hafez'),
        'pages'      => array('galleries'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        'fields' => array(
            array(
                'name' => esc_html__('Author', 'hafez'),
                'desc' => esc_html__('Specify the Author', 'hafez'),
                'id'   => $prefix . 'author',
                'type'    => 'text',
            ),
            array(
                'name' => esc_html__('Year', 'hafez'),
                'desc' => esc_html__('Specify the year', 'hafez'),
                'id'   => $prefix . 'year',
                'type'    => 'text',
            ),
            array(
                'name' => esc_html__('Location', 'hafez'),
                'desc' => esc_html__('Specify the location', 'hafez'),
                'id'   => $prefix . 'location',
                'type'    => 'text',
            ),
        )
    );


    return $meta_boxes;
}
