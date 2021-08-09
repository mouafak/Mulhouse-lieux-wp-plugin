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
center: [-74.5, 40],
zoom: 9,
marker : true
});
map.addControl(new mapboxgl.NavigationControl());
const marker = new mapboxgl.Marker() // Initialize a new marker
.setLngLat([-74.5, 40]) // Marker [lng, lat] coordinates
.addTo(map); // Add the marker to the map
</script>
";

get_footer(); ?>


