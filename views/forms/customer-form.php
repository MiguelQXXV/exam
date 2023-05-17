<?php

/*
Form Name: Customer Form
Description: Form for Customer
*/
?>

<form id="exam-form" class="exam_form-container form-container">
    <div class="form_field-group">
        <label for="name" class="form-label"><?php echo esc_html($atts['name_label']); ?>:</label>
        <input type="text" name="name" id="exam-name" class="form-field form-field_input" 
            <?php echo esc_attr($atts['name_length'] ? 'maxlength=' . $atts['name_length'] . '' : ''); ?>  required>
    </div>

    <div class="form_field-group">
        <label for="phone" class="form-label"><?php echo esc_html($atts['phone_label']); ?>:</label>
        <input type="text" name="phone" id="exam-phone" class="form-field form-field_input" 
            <?php echo esc_attr($atts['phone_length'] ? 'maxlength=' . $atts['phone_length'] . '' : ''); ?> required>
    </div>

    <div class="form_field-group">
        <label for="email" class="form-label"><?php echo esc_html($atts['email_label']); ?>:</label>
        <input type="email" name="email" id="exam-email" class="form-field form-field_input" 
            <?php echo esc_attr($atts['email_length'] ? 'maxlength=' . $atts['email_length'] . '' : ''); ?> required>
    </div>

    <div class="form_field-group">
        <label for="budget" class="form-label"><?php echo esc_html($atts['budget_label']); ?>:</label>
        <input type="text" name="budget" id="exam-budget" class="form-field form-field_input" 
            <?php echo esc_attr($atts['budget_length'] ? 'maxlength=' . $atts['budget_length'] . '' : ''); ?> required>
    </div>
    
    <div class="form_field-group">
        <label for="message" class="form-label"><?php echo esc_html($atts['message_label']); ?>:</label>
        <textarea name="message" id="exam-message" class="form-field form-field_textarea" 
            <?php echo esc_attr($atts['message_length'] ? 'maxlength=' . $atts['message_length'] . '' : ''); ?> 
            <?php echo esc_attr($atts['message_rows'] ? 'cols=' . $atts['message_rows'] . '' : ''); ?> 
            <?php echo esc_attr($atts['message_cols'] ? 'rows=' . $atts['message_cols'] . '' : ''); ?> 
        required></textarea>
    </div>

    <div class="form-submit_container">
        <input type="submit" value="Submit" class="form-button">
    </div>
</form>