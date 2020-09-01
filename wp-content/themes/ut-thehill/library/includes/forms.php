<?php


//===================================================================================================================
// This appends a message to the notifications in gravity forms
//===================================================================================================================


add_filter( 'gform_notification', 'my_gform_notification_signature', 10, 3 );
function my_gform_notification_signature( $notification, $form, $entry ) {
       // append a signature to the existing notification 
       // message with .=




    $notification['message'] .= "
    
    ***
    
    This form sent from " . get_bloginfo( 'url' ) . " on page: " . get_query_var('pagename') . ".";

    return $notification;
}

