jQuery(document).ready(function($) {
    $('.linkout-btn').click(function(e) {
        // Define our necessary data variables
        var linkout_type = $(this).data('linkout-type');
        var partner_ID = $(this).data('partner-id');
        // Make the AJAX call to the PHP function that's going to update the linkout data for the featured partner post
        $.ajax({
            type : 'POST',
            url : ajax.url,
            dataType : 'JSON',
            data : {
                action : 'update_linkout',
                linkout_type : linkout_type,
                partner_ID : partner_ID,
            },
            success : function(response) {
                console.log("Successful update!");
            },
        });
    });
});