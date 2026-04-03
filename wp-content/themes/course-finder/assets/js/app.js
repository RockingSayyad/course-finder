jQuery('#filterForm').submit(function(e){
    e.preventDefault();

    var formData = jQuery(this).serialize();

    jQuery.post(ajaxurl, {
        action: 'filter_courses',
        data: formData
    }, function(response){
        jQuery('#results').html(response);
    });

});