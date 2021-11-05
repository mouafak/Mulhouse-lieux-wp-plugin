<?php

global $ml_map_points;

add_action("call_map_box_api", "map_box_init_api", 10, 1);

function map_box_init_api($post_id)
{
	global $ml_map_points;

	$f = plugin_dir_path(__FILE__) . 'MapBoxAPI.php';
	if (file_exists($f)) {
		require $f;
	}
	if (class_exists("MapBoxAPI")) {

		$adresse = get_post_meta($post_id, "adresse_postal_value_key", true);

		$mabboxapi = new MapBoxAPI($adresse);

		$ml_map_points = $mabboxapi->getResult();
	}
}

add_filter("map_box_points_filters", "map_box_points");

function map_box_points($value)
{
	global $ml_map_points;

	if (!empty($ml_map_points)) {

		$value = [
			"geometry" => [

				"lng" => $ml_map_points[0][0],

				"lat" => $ml_map_points[0][1]
			],

			"center" => [

				"x" => $ml_map_points[1][0],

				"y" => $ml_map_points[1][1]
			],

			"at" => get_option("setting_api_key")
		];
		return $value;
	}

	$value = [

		"geometry" => [

			"lng" => 7.33917,

			"lat" => 47.74861
		],

		"center" => [

			"x" => 7.33917,

			"y" => 47.74861
		],
		
		"at" => get_option("setting_api_key")
	];

	return $value;
}
