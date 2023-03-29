<?php
/*
Plugin Name:  Enable ACF Local JSON
Plugin URI:   https://8bitstudio.ch
Description:  Saves field group and field settings as .json files in /app/acf-json folder
Version:      1.2.0
Author:       Mathieu Zwygart
Author URI:   https://zwygart.net
License:      MIT License
*/

class EnableACFJSON {
	public function __construct() {
		$this->json_directory_path = dirname(__DIR__, 2) . '/acf-json';
	}

	public function run() {
		if (!file_exists($this->json_directory_path)) {
			mkdir($this->json_directory_path, 0777, true);
		}

		add_filter('acf/settings/save_json', $this->json_directory_path);
		add_filter('acf/settings/load_json', function ($paths) {
			unset($paths[0]);
	
			$paths[] = $this->json_directory_path;
	
			return $paths;
		});
	}
}

function run_enable_acf_json() {
	$plugin = new EnableACFJSON();
	$plugin->run();
}

run_enable_acf_json();