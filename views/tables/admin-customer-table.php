<?php

// Add custom columns to the Customer table
function custom_form_custom_columns($columns) {
    $new_columns = array(
        'name' => 'Name',
        'email' => 'Email',
        'phone' => 'Phone Number',
        'budget' => 'Desired Budget',
        'message' => 'Message',
    );

    // Move the 'date' column to the last position
    $date_column = $columns['date'];
    unset($columns['date']);

    $columns = array_merge($columns, $new_columns);

    // Add the 'date' column to the last position
    $columns['date'] = $date_column;

    return $columns;
}
add_filter('manage_customer_posts_columns', 'custom_form_custom_columns');

// Populate custom columns with data
function custom_form_custom_column_data($column, $post_id) {
    switch ($column) {
        case 'email':
            $email = get_post_meta($post_id, 'email', true);
            echo esc_html($email);
            break;
        case 'phone':
            $phone = get_post_meta($post_id, 'phone', true);
            echo esc_html($phone);
            break;
        case 'budget':
            $budget = get_post_meta($post_id, 'budget', true);
            echo esc_html($budget);
            break;
        case 'message':
            $message = get_post_meta($post_id, 'message', true);
            echo esc_html($message);
            break;
    }
}
add_action('manage_customer_posts_custom_column', 'custom_form_custom_column_data', 10, 2);
