<?php

// if global variable WP_UNINSTALL_PLUGIN not defined then stop execution the file 

defined("WP_UNINSTALL_PLUGIN") or die;

//delete data from database
// first method

/**
 * @var array $events contains all posts of type mulhouseEvents
 */
$events = get_posts(
    [
        "post_type" => "mulhouse-events",
        "numberposts"=>-1
    ]
);

foreach($events as $event){
    wp_delete_post($event->ID , true);
}