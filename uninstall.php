<?php
if(!defined('WP_UNINSTALL_PLUGIN') ){
    exit();
}

    /*delete options*/
	if ( is_multisite() ) {
		global $wpdb;
 	   	$blogs = $wpdb->get_results("SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A);
 	   		if ($blogs) {
        	foreach($blogs as $blog) {
           		switch_to_blog($blog['blog_id']);
           		delete_option('ilw_options');
           		delete_option( 'widget_itunes_lookup_widget');
			}
			restore_current_blog();
		}
	}else{
		delete_option( 'ilw_options');
		delete_option( 'widget_itunes_lookup_widget');
	}
?>