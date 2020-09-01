<?php

// For looping through the post vars.
function site_info_loopThroughFields($type, $count = 1) {
    // Just in case we manage to get a negative count
    if($count < 1) { $count = 1; }
    $i = 1;
    $realCount = $count;
    // Loop though the count for each value
    while ($i <= $count) {
        if(isset($_POST[ 'ut-site-info-'.$type.'label-'.$i ]) && $_POST[ 'ut-site-info-'.$type.'label-'.$i ] != "" && isset($_POST[ 'ut-site-info-'.$type.'-'.$i ]) && $_POST[ 'ut-site-info-'.$type.'-'.$i ] != "") {
            update_option( 'ut-site-info-'.$type.'label-'.$i, $_POST[ 'ut-site-info-'.$type.'label-'.$i ] );
            update_option( 'ut-site-info-'.$type.'-'.$i, $_POST[ 'ut-site-info-'.$type.'-'.$i ] );
        } elseif($count == 1) {
            update_option( 'ut-site-info-'.$type.'label-1', $_POST[ 'ut-site-info-'.$type.'label-1' ] );
            update_option( 'ut-site-info-'.$type.'-1', $_POST[ 'ut-site-info-'.$type.'-1' ] );
        } else {
            $realCount = $realCount;
        }
        $i++;
    }
    // Update the count in the db
    if($realCount < 1) { $realCount = 1; }
    update_option( $type.'-count', $realCount );
}

// Create admin menu
function site_info_site_info_menu() {
    add_theme_page( 'Site Information', 'Site Info', 'edit_theme_options', 'ut_site_info', 'site_info_site_info_fields' );
}

function site_info_site_info_fields() {
    if ( !current_user_can( 'edit_theme_options' ) )  {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    $hidden_field_name = 'ut_submit_hidden';

    if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ): ?>
    <?php
        
        // Get some single entry data    
        update_option( 'ut-site-info-parentunit', stripslashes_deep($_POST[ 'ut-site-info-parentunit' ]) );
        update_option( 'ut-site-info-parentunitlink', $_POST[ 'ut-site-info-parentunitlink' ] );
        update_option( 'ut-site-info-parentunitincludeinheader_checkbox', $_POST[ 'ut-site-info-parentunitincludeinheader_checkbox' ] );
        update_option( 'ut-site-info-address', nl2br(stripslashes_deep($_POST[ 'ut-site-info-address' ])) );
        update_option( 'ut-site-info-gmap-lat', $_POST[ 'ut-site-info-gmap-lat' ] );
        update_option( 'ut-site-info-gmap-lng', $_POST[ 'ut-site-info-gmap-lng' ] );
        update_option( 'ut-site-info-general-info', nl2br(stripslashes_deep($_POST[ 'ut-site-info-general-info' ])) );

        
        //Ok, we now have to loop through count fields to get the post vars. First...get the count
        $pCount = $_POST[ 'phone-count' ];
        site_info_loopThroughFields('phone',$pCount);

        $emailCount = $_POST[ 'email-count' ];
        site_info_loopThroughFields('email',$emailCount);
    ?>
    <?php endif ?>
    <div class="wrap">
        <h2>Site Information</h2>
        <p>Enter common site information, such as contact, address, phone number, etc.</p>
        <?php if( isset($_POST[ $hidden_field_name ]) && $_POST[ $hidden_field_name ] == 'Y' ): ?>
            <div id="message" class="updated below-h2">
            <p>Site Information has been updated.</p></div>
        <?php endif ?>
        <form class="site_info_form" name="form1" method="post" action="">
            <input type="hidden" name="<?php echo $hidden_field_name; ?>" value="Y">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="parentunit_text">Parent Unit:</label></th>
                    <td><input id="parentunit_text" name="ut-site-info-parentunit" type="text" value="<?php echo get_option('ut-site-info-parentunit'); ?>" /></td>
                </tr>


                <tr valign="top">
                    <th scope="row"><label for="parentunitlink_text">Parent Unit Link:</label></th>
                    <td><input id="parentunitlink_text" name="ut-site-info-parentunitlink" type="text" value="<?php echo get_option('ut-site-info-parentunitlink'); ?>" /></td>
                </tr>
                
                <tr valign="top">
                    <th scope="row"><label for="ut-site-info-parentunitincludeinheader_checkbox">Include Parent Unit in Header:</label></th>
                    <td><input type="checkbox" id="parentunitincludeinheader_checkbox" name="ut-site-info-parentunitincludeinheader_checkbox" <?php if(get_option('ut-site-info-parentunitincludeinheader_checkbox')): ?> value="<?php echo get_option('ut-site-info-parentunitincludeinheader_checkbox'); ?>" checked="checked" <?php endif ?>> </td>

                </tr>
                
                <tr>
                    <th scope="row">Address:</th>
                    <td><textarea id="address_1" rows="3" cols="50" name="ut-site-info-address"><?php echo str_replace("<br />", "", get_option('ut-site-info-address')); ?></textarea></td>
                </tr>
                <tr>
                    <th scope="row">Google Map Latitude:</th>
                    <td><input id="google_map_latitude" type="text" name="ut-site-info-gmap-lat" value="<?php echo get_option('ut-site-info-gmap-lat'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">Google Map Longitude:</th>
                    <td><input id="google_map_longitude" type="text" name="ut-site-info-gmap-lng" value="<?php echo get_option('ut-site-info-gmap-lng'); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">General Information:</th>
                    <td><textarea id="general_info" rows="3" cols="50" name="ut-site-info-general-info"><?php echo str_replace("<br />", "", get_option('ut-site-info-general-info')); ?></textarea></td>
                </tr>
                <tr>
                    <th class="multipleFieldDescription"><div class="sectionHeader">Phone Number(s):</div></th>
                </tr>
                <tr>
                    <td class="multipleFieldDescription" colspan="2"><div class="sectionDetails">Use the label field to identify the type of phone number (i.e. Phone 1, Fax, TTL, etc).</div></td>
                </tr>
               
                    <?php $r = 1; $rowCount = get_option('phone-count');  ?>
                    <?php if($rowCount && $rowCount > 1): ?>
                        <?php while($r <= $rowCount): ?>
                             <tr class="phoneRow">
                                <td>
                                    <input id="phonelabel-<?php echo $r ?>" class="label" type="text" name="ut-site-info-phonelabel-<?php echo $r ?>" placeholder="Label" value="<?php echo get_option('ut-site-info-phonelabel-'.$r); ?>" />
                                    <input id="phone-<?php echo $r ?>" class="data" type="tel" name="ut-site-info-phone-<?php echo $r ?>" value="<?php echo get_option('ut-site-info-phone-'.$r); ?>" />
                                    <div class="addOneButton button-primary">+</div>
                                    <div class="<?php if($rowCount == 1): ?>hiddenButton<?php endif ?> removeButton button-primary">Remove</div>
                                </td>
                                
                            </tr>
                            <?php $r++; ?>
                        <?php endwhile ?>
                    <?php else: ?>
                        <tr class="phoneRow">
                            <td>
                                <input id="phonelabel-1" class="label" type="text" name="ut-site-info-phonelabel-1" placeholder="Label" value="<?php echo get_option('ut-site-info-phonelabel-1'); ?>" />
                                <input id="phone-1" class="data" type="tel" name="ut-site-info-phone-1" value="<?php echo get_option('ut-site-info-phone-1'); ?>" />
                                <div class="addOneButton button-primary">+</div>
                                <div class="hiddenButton removeButton button-primary">Remove</div>
                            </td>
                        </tr>
                    <?php endif ?>
                <tr>
                    <td><input id="phone" class="count" name="phone-count" type="hidden" /></td>    
                </tr>
                <tr>
                    <th class="multipleFieldDescription"><div class="sectionHeader">Email(s):</div></th>
               </tr>
                <tr>
                    <td class="multipleFieldDescription" colspan="2"><div class="sectionDetails">Use the label field to identify the type of email address (i.e. Customer Service, Questions, etc).</div></td>
                </tr>
               <?php $e = 1; $emailRowCount = get_option('email-count');  ?>
                    <?php if($emailRowCount && $emailRowCount > 1): ?>
                        <?php while($e <= $emailRowCount): ?>
                             <tr class="emailRow">
                                <td><input id="emaillabel-<?php echo $e ?>" class="label" type="text" name="ut-site-info-emaillabel-<?php echo $e ?>" placeholder="Label" value="<?php echo get_option('ut-site-info-emaillabel-'.$e); ?>" /></td>
                                <td><input id="email-<?php echo $e ?>" class="data" type="email" name="ut-site-info-email-<?php echo $e ?>" placeholder="Value" value="<?php echo get_option('ut-site-info-email-'.$e); ?>" /></td>
                                <td><div class="addOneButton button-primary">+</div></td>
                                <td><div class="<?php if($emailRowCount <= 1): ?>hiddenButton<?php endif ?> removeButton button-primary">Remove</div></td>
                                
                            </tr>
                            <?php $e++; ?>
                        <?php endwhile ?>
                    <?php else: ?>
                        <tr class="emailRow">
                            <td><input id="emaillabel-1" class="label" type="text" name="ut-site-info-emaillabel-1" placeholder="Label" value="<?php echo get_option('ut-site-info-emaillabel-1'); ?>" /></td>
                            <td><input id="email-1" class="data" type="email" name="ut-site-info-email-1" placeholder="Value" value="<?php echo get_option('ut-site-info-email-1'); ?>" /></td>
                            <td><div class="addOneButton button-primary">+</div></td>
                            <td><div class="hiddenButton removeButton button-primary">Remove</div></td>
                        </tr>
                    <?php endif ?>
                <tr>
                    <td><input id="email" class="count" name="email-count" type="hidden" /></td>    
                </tr>
            </table>
    
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />

        </form>
        <script>
            function getRow(element) {
                var row = jQuery(element).parent().parent();
                return row;
            }

            function countRows() {
                jQuery('.count').each(function() {
                    var rowType = jQuery(this).attr('id');
                    var rowClass = rowType + "Row";
                    var num = jQuery("."+rowClass).length;
                    var num = parseInt(num);
                    jQuery('#'+rowType).val(num);
                });
            }

            function updateRows(rowClass) {
                var type = extractType(rowClass);
                jQuery('.'+rowClass).each(function(i) {
                    i = i+1;
                    jQuery(this).find('.label').attr('id', type+'label-'+i);
                    jQuery(this).find('.label').attr('name', 'ut-site-info-'+type+'label-'+i);
                    jQuery(this).find('.data').attr('id', type+'-'+i);
                    jQuery(this).find('.data').attr('name', 'ut-site-info-'+type+'-'+i);
                });
            }

            function contructRow(thisClass) {
                var row = "<tr class='"+thisClass+"'><td><input id='' class='label' type='text' name='' placeholder='Label' value='' /><input id='' class='data' type='tel' name='' placeholder='Value' value='' /><div class='addOneButton button-primary'>+</div><div class='removeButton button-primary'>Remove</div></td></tr>";
                return row;
            }

            function extractType(thisClass) {
                type = thisClass.replace("Row", "");
                return type;
            }

            jQuery(document).ready(function($) {
                // Get an initial count
                countRows();
            });

            // Since these buttons are dynamically generated they are outside the DOM. This function listens for the button click
            jQuery(document).on('click', '.addOneButton', function(){
                var element  = jQuery(this);
                var thisRow  = getRow(element);
                var rowClass = thisRow.attr('class');
                
                
                var newRow   =  contructRow(rowClass);
                thisRow.after(newRow);
                
                
                updateRows(rowClass);
                
                thisRow.find('.hiddenButton').removeClass('hiddenButton');

                countRows();
            });

            // Remove a field
            jQuery(document).on('click', '.removeButton', function(){
                element      = jQuery(this);
                var thisRow  = getRow(element);
                thisRow.remove();
                
                var rowClass = thisRow.attr('class');
                updateRows(rowClass);
                
                var rowCount = jQuery('.'+rowClass).length;
                if(rowCount == 1) {
                    jQuery('.'+rowClass).find('.removeButton').addClass('hiddenButton');
                }

                countRows();
            });
        </script>
        <?php }

function site_info_register_site_info_settings() { 
      register_setting( 'site-info-group', 'ut-site-info-parentunit' );
      register_setting( 'site-info-group', 'ut-site-info-parentunitlink' );
      register_setting( 'site-info-group', 'ut-site-info-parentunitincludeinheader_checkbox' );
      register_setting( 'site-info-group', 'ut-site-info-address' );
      register_setting( 'site-info-group', 'ut-site-info-gmap-lat' );
      register_setting( 'site-info-group', 'ut-site-info-gmap-lng' );
      register_setting( 'site-info-group', 'ut-site-info-general-info' );
      register_setting( 'site-info-group', 'ut-site-info-phone' );
      register_setting( 'site-info-group', 'ut-site-info-fax' );
      register_setting( 'site-info-group', 'ut-site-info-email' );
}

// add_action( 'admin_menu', 'site_info_site_info_menu' );
add_action( 'admin_init', 'site_info_register_site_info_settings' );


/************************************************************************/

// Register widget
class site_info_contactUs_widget extends WP_Widget {

    function __construct() {
        parent::__construct(
        // Base ID of your widget
        'ut_site_info_contactUs_widget', 

        // Widget name will appear in UI
        __('UT Contact Us', 'wpb_widget_domain'), 

        // Widget description
        array( 'description' => __( 'Adds contact info from Site-Info', 'wpb_widget_domain' ), ) 
        );
    }

    public function widget( $args, $instance ) { ?>
        <?php 
            $title          = get_bloginfo('name');
            $parentunit     = get_option( 'ut-site-info-parentunit');
            $parentunitlink = get_option( 'ut-site-info-parentunitlink');
            $address        = get_option( 'ut-site-info-address');
            $lat            = get_option( 'ut-site-info-gmap-lat');
            $long           = get_option( 'ut-site-info-gmap-lng');
            $generalInfo        = get_option( 'ut-site-info-general-info');
            
            extract($args, EXTR_SKIP);
            echo $before_widget;
            $contactHeader = "Contact Us";
            if (!empty($title)) { echo $before_title . $contactHeader . $after_title; };

            ?>
                <div class="site_info_widget textwidget"><ul>
                <?php 
                    if($parentunit && $parentunit != "" && $parentunitlink && $parentunitlink != "") {
                        echo "<li><a href='".$parentunitlink."'>".$parentunit."</a></li>";
                    }elseif($parentunit && $parentunit != "") {
                        echo "<li>".$parentunit."</li>";
                    }
                    if($address && $address != "") {
                        echo "<li>".$address."</li>";
                    }
                    if($lat && $lat != "" && $long && $long != "") {
                        echo "<li><a class='view_map' target='_blank' href='http://maps.google.com/?q=".$lat.",".$long."' >View Map</a></li>";
                    }
                    if($generalInfo && $generalInfo != "") {
                        echo "<li>".$generalInfo."</li>";
                    }
                    $pCount  = get_option('phone-count');
                    $iter = 1; 
                    while($iter <= $pCount): ?>
                        <?php $label = get_option('ut-site-info-phonelabel-'.$iter);
                          if($label): ?>
                            <?php echo "<li>".get_option( 'ut-site-info-phonelabel-'.$iter ); ?> : <?php echo get_option('ut-site-info-phone-'.$iter)."</li>"; ?>
                        <?php endif ?>
                        <?php $iter++; ?>
                    <?php endwhile ?>
                    <?php 
                      $eCount  = get_option('email-count');
                      $iter = 1; 
                      while($iter <= $eCount): ?>
                        <?php  $label = get_option( 'ut-site-info-emaillabel-'.$iter);
                          if($label): ?>
                            <li><?php echo get_option( 'ut-site-info-emaillabel-'.$iter ); ?> : <a href="mailto:<?php echo get_option('ut-site-info-email-'.$iter); ?>" ><?php echo get_option('ut-site-info-email-'.$iter); ?></a></li>
                        <?php endif ?>
                        <?php $iter++; ?>
                    <?php endwhile ?>
                    
                    </ul>
                </div>
                <?php echo $after_widget; ?>
        
    <?php }
            
    // Widget Backend 
    public function form( $instance ) {
        $title          = get_bloginfo('name');
        $parentunit     = get_option( 'ut-site-info-parentunit');
        $parentunitlink = get_option( 'ut-site-info-parentunitlink');
        $address        = get_option( 'ut-site-info-address');
        $generalInfo    = get_option( 'ut-site-info-general-info');
        // Widget admin form
        ?><p><?php 
            if($title && $title != "") {
                echo $title."<br>";
            }
            if(isset($parentunit) && $parentunit != "" && isset($parentunitlink) && $parentunitlink != "") {
                echo "<a href='".$parentunitlink."'>".$parentunit."</a><br>";
            }elseif($parentunit && $parentunit != "") {
                echo $parentunit."<br>";
            }
            if($address && $address != "") {
                echo $address."<br>";
            }
            if($generalInfo && $generalInfo != "") {
                echo $generalInfo."<br>";
            } 
            $pCount  = get_option('phone-count');
            if($pCount > 0) {
                $iter = 0; 
                while($iter <= $pCount) {
                    echo get_option( 'ut-site-info-phonelabel-'.$iter ).": ".get_option('ut-site-info-phone-'.$iter)."<br>";
                    $iter++;
                } 
            }
            $eCount  = get_option('email-count');
            if($eCount > 0) {
                while($iter <= $eCount) {
                    echo get_option( 'ut-site-info-emaillabel-'.$iter ).": <a href='mailto:".get_option('ut-site-info-email-'.$iter)."'>".get_option('ut-site-info-email-'.$iter)."</a><br>";
                    $iter++;
                }
            }
            $iter = 0; ?>
        </p>
    <?php 
    }
        
} 

// Register and load the widget
function site_info_contactUs_load_widget() {
    register_widget( 'site_info_contactUs_widget' );
}

add_action( 'widgets_init', 'site_info_contactUs_load_widget' );

// Load stylesheet
function site_info_loadSiteInfoStyles() {
    wp_register_style( 'site_info_site-info-styles', get_template_directory_uri().'/library/css/ut-site-info.css' );
    wp_enqueue_style('site_info_site-info-styles');   
}
add_action( 'admin_init', 'site_info_loadSiteInfoStyles');