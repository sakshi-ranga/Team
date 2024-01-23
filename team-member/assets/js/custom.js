// JavaScript/jQuery code
loadTeamsMember = (departmentName = '') => { 
    jQuery.ajax({
        url:  customAjax.ajaxurl, // WordPress AJAX URL
        type: 'POST',
        data: {
            action: 'display_team_members', // Action for WordPress to handle
            department:departmentName
        },
        beforeSend: function() {
            jQuery('#teams').html('Please wait... Loading');
        },
        success: function(response) {
            console.log(response);
            // Display the retrieved posts in the page
            jQuery('#teams').html(response.data);
        },
        error: function(xhr, status, error) {
            console.log(error); // Log any errors to console
        }
    });
}

jQuery(document).ready(function($) {
    loadTeamsMember();
    $('#taxonomySelect').change(function() {
        loadTeamsMember($(this).val());
    });
    
});
