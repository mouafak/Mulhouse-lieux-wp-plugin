<?php

// add_action("call_map_box_api" , "map_box_init_api");

// function map_box_init_api(){
    $f = PFLDIR.'core/MapBoxAPI.php';

			if(file_exists($f)){
				require $f;
			}
			if(class_exists("MapBoxAPI")){

				$adresse = get_post_meta($post->ID , "adresse_postal_value_key" , true);

				$mabboxapi = new MapBoxAPI($adresse);

				$map_points = $mabboxapi->getResult();
			}

			$lng = $map_points[0][0] ?? "7.33917";
			$lat = $map_points[0][1] ?? "47.74861";
			$center0  = $map_points[1][0] ?? "7.33917";
			$center1  = $map_points[1][1] ?? "47.74861";

// }