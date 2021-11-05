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
		include plugin_dir_path(__FILE__) . "content-single-mulhouse-lieux.php"; ?>
		<?php do_action("call_map_box_api", $post->ID); ?>
	<?php endwhile;
	?>
</div>

<?php
$map_points = [];
$map_points = apply_filters("map_box_points_filters", $map_points);
?>

<?php
echo
"
<script>
mapboxgl.accessToken = '".$map_points["at"]."';
const map = new mapboxgl.Map({
container: 'map',
style: 'mapbox://styles/mapbox/streets-v11',
center: [" . $map_points["center"]["x"] . ", " . $map_points["center"]["y"] . "],
zoom: 10,
marker : false
});
map.addControl(new mapboxgl.NavigationControl());
const marker = new mapboxgl.Marker() // Initialize a new marker
.setLngLat([" . $map_points["geometry"]["lng"] . ", " . $map_points["geometry"]["lat"] . "]) // Marker [lng, lat] coordinates
.addTo(map); // Add the marker to the map
</script>
";
?>

<?php get_footer(); ?>