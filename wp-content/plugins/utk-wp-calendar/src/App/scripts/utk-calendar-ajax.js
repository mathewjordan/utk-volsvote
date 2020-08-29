/*
 * on initial load... get first page of departments listing
 */

jQuery(document).on('click', "#utk-calendar-lookup-init", function(){

    jQuery.ajax({

        method: "POST",
        url: ajaxurl,
        data: {
            'action': 'utk_calendar_department_id_action',
            'page': 1
        },

        beforeSend: function () {
            // console.log("Retrieve listing...");
        },

        success: function (result) {
            jQuery('#utk-calendar-lookup').html(result);
        }

    });

});


/*
 * on page loads, get clicked page value
 */

jQuery(document).on('click', ".utk-calendar-page-lookup", function(){

    var pageNumber = jQuery(this).attr('data-page');

    jQuery.ajax({

        method: "POST",
        url: ajaxurl,
        data: {
            'action': 'utk_calendar_department_id_action',
            'page': pageNumber
        },

        beforeSend: function () {
            // console.log("Refresh listing...");
        },

        success: function ( result ) {
            jQuery('#utk-calendar-lookup').html( result );
        }

    });

});


/*
 * on click, update input for department ID
 */

jQuery(document).on('click', ".utk-calendar-id-set", function(){

    event.preventDefault();

    var departmentID = jQuery(this).attr('data-department-id');
    jQuery('#utk_calendar_department_id').val(departmentID);

    jQuery('.utk-calendar-id-set').text('Select');
    jQuery('.utk-calendar-id-set').css('font-weight', '400');

    jQuery(this).text('Current');
    jQuery(this).css('font-weight', '700');

    jQuery.ajax({

        method: "POST",
        url: ajaxurl,
        data: {
            'action': 'utk_calendar_department_id_update_action',
            'id': departmentID
        },

        beforeSend: function () {
            // console.log("Submitting Department ID...");
        },

        success: function (result) {
            jQuery('#utk_calendar_department_id_feedback').show().html( result ).delay( 1000 ).fadeOut( 290 );
        }

    });

});