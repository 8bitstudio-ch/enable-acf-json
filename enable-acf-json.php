<?php
/*
Plugin Name:  Enable ACF Local JSON
Plugin URI:   https://8bitstudio.ch
Description:  Saves field group and field settings as .json files in /app/json folder
Version:      1.0.0
Author:       Mathieu Zwygart
Author URI:   https://zwygart.net
License:      MIT License
*/

use function Env\env;

$path = dirname(__DIR__, 2) . '/acf-json';
if ( wp_mkdir_p( $path ) ) {
	
	if(env('WP_ENV') == 'production') {
		add_filter('acf/settings/show_admin', '__return_false');
	}

   add_filter('acf/settings/save_json', 'my_acf_json_save_point');
 
		function my_acf_json_save_point( $path ) {  
			// update path
			$path = dirname(__DIR__, 2) . '/acf-json';


			// return
			return $path;
		}

		add_filter('acf/settings/load_json', 'my_acf_json_load_point');

		function my_acf_json_load_point( $paths ) {
			// remove original path (optional)
			unset($paths[0]);

			// append path
			$paths[] = dirname(__DIR__, 2) . '/acf-json';

			// return
			return $paths;
		}
}