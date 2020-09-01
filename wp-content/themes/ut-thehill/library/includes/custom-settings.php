<?php 


 function ut_custom_settings_init() {

 	add_settings_section(
		'ut_settings_section',
		'Special Typography',
		'ut_setting_section_callback',
		'general'
	);
 	
 	add_settings_field(
		'ut_use_gotham',
		'Use Gotham?',
		'ut_settings_callback',
		'general',
		'ut_settings_section'
	);
 	
 	register_setting( 'general', 'ut_use_gotham' );
 } 
 
 add_action( 'admin_init', 'ut_custom_settings_init' );
 
 
 function ut_setting_section_callback() {
 	echo 'Gotham is a licensed font from <a href="http://www.typography.com">Typography.com</a> and there is a cost associated with using it.<br> Please contact <a href="http://communications.utk.edu">Communications and Marketing</a> for information on activating it on your site.';
 }
 

 
 function ut_settings_callback() {
 	echo '<input name="ut_use_gotham" id="ut_use_gotham" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'ut_use_gotham' ), false ) . ' /> ';
 }