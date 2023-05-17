jQuery(document).ready(function($) {
    $('#exam-form').submit(function(e) {
        e.preventDefault();

        var form = $(this);

        $.ajax({
            type: 'POST',
            url: customFormAjax.ajaxUrl,
            data: form.serialize() + '&action=exam_form_submit',
            dataType: 'json',
            success: function(response) {
                if (response.success){ 
                    form.trigger('reset')
                    return alert(response.data)
                };
                alert(response.data);
            },
            error: function() {
                console.log('Error submitting form.');
            },
            complete: function() {
            }
        });
    });
});
