<?php
/*
Plugin Name: Exam Plugin
Description: Creates a custom form with shortcode and saves submissions as a custom post type using AJAX.
*/

// Register the custom post type
function exam_form_register_post_type() {
    $args = array(
        'labels' => array(
            'name' => 'Customers',
            'singular_name' => 'Customer',
        ),
        'public' => true,
        'has_archive' => true,
        'menu_position' => 20,
        'supports' => array('title'),
    );
    register_post_type('customer', $args);
}
add_action('init', 'exam_form_register_post_type');

// Enqueue scripts and localize data for AJAX handling
function exam_form_enqueue_scripts() {
    wp_enqueue_style('styles', plugin_dir_url(__FILE__) . 'styles/form.css');
    wp_enqueue_script('script', plugin_dir_url(__FILE__) . 'scripts/form.js', array('jquery'), '1.0', true);
    wp_localize_script('script', 'customFormAjax', array('ajaxUrl' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'exam_form_enqueue_scripts');

function custom_form_enqueue_styles() {
 wp_enqueue_style('custom-table-style', plugin_dir_url(__FILE__) . 'styles/admin.css');
}

add_action('admin_enqueue_scripts', 'custom_form_enqueue_styles');


// Create the shortcode
function exam_form_shortcode($atts) {

    // Shortcode attributes 
    $atts = shortcode_atts(array(
        'name_label' => 'Name',
        'phone_label' => 'Phone Number',
        'email_label' => 'Email Address',
        'budget_label' => 'Desired Budget',
        'message_label' => 'Message',
        'name_length' => '',
        'phone_length' => '',
        'email_length' => '',
        'budget_length' => '',
        'message_length' => '',
        'message_rows' => 5,
        'message_cols' => 5
    ), $atts);

    ob_start();
    require_once(plugin_dir_path(__FILE__) . '/views/forms/customer-form.php');
    return ob_get_clean();
}
add_shortcode('exam_form', 'exam_form_shortcode');

// AJAX callback for form submission
function exam_form_ajax_submit() {
    if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['budget']) && isset($_POST['message'])) {
        $post_data = array(
            'post_title' => sanitize_text_field($_POST['name']),
            'post_type' => 'customer',
            'post_status' => 'private', // publish | draft | private
        );

        $post_id = wp_insert_post($post_data);

        if ($post_id) {
            update_post_meta($post_id, 'phone', sanitize_text_field($_POST['phone']));
            update_post_meta($post_id, 'email', sanitize_text_field($_POST['email']));
            update_post_meta($post_id, 'budget', sanitize_text_field($_POST['budget']));
            update_post_meta($post_id, 'message', sanitize_text_field($_POST['message']));

            wp_send_json_success('Form submitted successfully!');
        } else {
            wp_send_json_error('Error saving form submission.');
        }
    } else {
        wp_send_json_error('Incomplete form data.');
    }
}
add_action('wp_ajax_exam_form_submit', 'exam_form_ajax_submit');
add_action('wp_ajax_nopriv_exam_form_submit', 'exam_form_ajax_submit');


// Include the custom form submissions page
require_once(plugin_dir_path(__FILE__) . '/views/tables/admin-customer-table.php');
require_once(plugin_dir_path(__FILE__) . '/setup.php');
