jQuery(document).ready(function($){

    // FORM CHANGE / SUBMIT
    $('#filterForm').on('keyup submit', function(e){
        e.preventDefault();

        loadCourses();
    });

    function loadCourses(){

        var formData = $('#filterForm').serialize();

        $.ajax({
            url: ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_courses',
                data: formData
            },
            beforeSend: function(){
                $('#results').html('<p>Loading...</p>');
            },
            success: function(response){
                $('#results').html(response);
            },
            error: function(){
                $('#results').html('<p>Error loading courses</p>');
            }
        });

    }

    // PAGE LOAD PE INITIAL DATA
    loadCourses();

});