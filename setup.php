<?php


// Register custom taxonomies for categories and tags
function custom_form_register_taxonomies() {
    // Category taxonomy
    register_taxonomy(
        'customer_category',
        'customer',
        array(
            'label' => 'Categories',
            'hierarchical' => true,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'customer-category'),
        )
    );

    // Tag taxonomy
    register_taxonomy(
        'customer_tag',
        'customer',
        array(
            'label' => 'Tags',
            'hierarchical' => false,
            'public' => true,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'customer-tag'),
        )
    );
}
add_action('init', 'custom_form_register_taxonomies');