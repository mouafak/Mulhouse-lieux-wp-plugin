<?php

/**
 * The template for displaying all single post type mulhouse lieux
 */

get_header();
?>

<div class="page-content">
	<?php
	while (have_posts()) : the_post(); ?>
		<?php 
			include plugin_dir_path(__FILE__)."content-single-mulhouse-lieux.php"; 
		?>

		<?php
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
		?>

	<?php endwhile;
	?>
</div>
<?php


echo
"
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoibW91YWZhayIsImEiOiJja3MxbnN6dXUxdm55MnZuOHFpMjU1eTVnIn0.7Mx_gCUL5fUWYZFPt5KQqQ';
const map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [".$center0.", ".$center1."],
zoom: 10,
marker : true
});
map.addControl(new mapboxgl.NavigationControl());
const marker = new mapboxgl.Marker() // Initialize a new marker
.setLngLat([".$lng.", ".$lat."]) // Marker [lng, lat] coordinates
.addTo(map); // Add the marker to the map
</script>
";

get_footer(); ?>


