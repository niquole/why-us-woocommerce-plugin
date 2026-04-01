<?php

if (!defined('ABSPATH')) {
    exit;
}

// check if woocomerce is active
register_activation_hook(__FILE__, function () {
    if (!class_exists('WooCommerce')) {
        deactivate_plugins(plugin_basename(__FILE__));
        wp_die('WooCommerce must be active.');
    }
});


add_action('acf/init', function() {

    if (!function_exists('acf_add_options_page')) return;

    acf_add_options_page(array(
        'page_title' => 'Why Us Settings',
        'menu_title' => 'Why Us',
        'menu_slug'  => 'why-us-settings',
        'capability' => 'manage_options',
        'redirect'   => false
    ));

});

// acf fields
add_action('acf/init', function() {

    if (!function_exists('acf_add_local_field_group')) return;

    acf_add_local_field_group(array(
        'key' => 'group_why_us',
        'title' => 'Why Us Section',
        'fields' => array(

            array(
                'key' => 'field_section_title',
                'label' => 'Section Title',
                'name' => 'section_title',
                'type' => 'text',
            ),

            array(
                'key' => 'field_section_bg',
                'label' => 'Section Background Image',
                'name' => 'section_background_image',
                'type' => 'image',
                'return_format' => 'array',
            ),

            array(
                'key' => 'field_items',
                'label' => 'Items',
                'name' => 'items',
                'type' => 'repeater',
                'min' => 1,
                // 'max' => 4,
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_item_image',
                        'label' => 'Image',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                    ),
                    array(
                        'key' => 'field_item_title',
                        'label' => 'Title',
                        'name' => 'title',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_item_description',
                        'label' => 'Description',
                        'name' => 'description',
                        'type' => 'text',
                    ),
                    array(
                        'key' => 'field_item_link',
                        'label' => 'Link',
                        'name' => 'link',
                        'type' => 'url',
                    ),
                ),
            ),

        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'why-us-settings',
                ),
            ),
        ),
    ));

});


add_action('wp_enqueue_scripts', function () {
    if (is_product()) {

        // font
        wp_enqueue_style(
            'whyus-font',
            'https://fonts.googleapis.com/css2?family=Baloo+2:wght@700;800&display=swap'
        );

        // cc
        wp_enqueue_style(
            'whyus-style',
            plugin_dir_url(__FILE__) . 'style.css'
        );

        // swiper
        wp_enqueue_style(
            'swiper-css',
            'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css'
        );

        wp_enqueue_script(
            'swiper-js',
            'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js',
            [],
            null,
            true
        );

        wp_enqueue_script(
            'whyus-script',
            plugin_dir_url(__FILE__) . 'script.js',
            ['swiper-js'],
            null,
            true
        );
    }
});

// hook
add_action('woocommerce_after_single_product_summary', function () {
    if (!function_exists('get_field')) return;

    include plugin_dir_path(__FILE__) . 'why-us-template.php';
}, 15);