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


// Show complete custom post type fields when viewing customer data
function custom_form_show_custom_fields() {
    global $post;
    if ($post->post_type === 'customer') {
        $name = get_the_title($post->ID);
        $email = get_post_meta($post->ID, 'email', true);
        $phone = get_post_meta($post->ID, 'phone', true);
        $budget = get_post_meta($post->ID, 'budget', true);
        $message = get_post_meta($post->ID, 'message', true);

        echo '<table class="customer-table_details">';
        echo '<tr><td><strong>Name:</strong></td><td>' . esc_html($name) . '</td></tr>';
        echo '<tr><td><strong>Email:</strong></td><td>' . esc_html($email) . '</td></tr>';
        echo '<tr><td><strong>Phone Number:</strong></td><td>' . esc_html($phone) . '</td></tr>';
        echo '<tr><td><strong>Desired Budget:</strong></td><td>' . esc_html($budget) . '</td></tr>';
        echo '<tr><td><strong>Message:</strong></td><td>' . esc_html($message) . '</td></tr>';
        echo '</table>';

    }
}
add_action('edit_form_after_title', 'custom_form_show_custom_fields');