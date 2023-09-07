const { __, _x, _n, _nx } = wp.i18n;


jQuery(document).ready(function($){
 console.log('public ready');
 console.log(senpai_wp_test_public_params);
})


jQuery(document).ready(function($) {
    $('#contact-form').submit(function(e) {
        e.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            type: 'POST',
            url: ajax_object.ajax_url,
            data: {
                action: 'insert_data',
                data: formData
            },
            success: function(response) {
                alert('Data submitted successfully!');
                // Handle the response as needed
            }
        });
    });
});
