<?php
/**
 * Plugin Name:       Mulhouse lieux
 * Plugin URI:        https://mouafakalali.com
 * Description:       A plugin that allows you to show off your post type Mulhouse lieux...
 * Version:           1.0.0
 * Requires at least: 5.8
 * Requires PHP:      7.2
 * Author:            ALALI Mouafak
 * Author URI:        https://mouafakalali.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       mouafakalali.com
 */

 defined("ABSPATH") or die;

 require_once plugin_dir_path(__FILE__)."core/MulhouseLieuxClass.php";
 require_once plugin_dir_path(__FILE__)."core/MulhouseLieuxMetaBox.php";

 if(class_exists("MulhouseLieuxClass")){

    $mulhouseLieux = new MulhouseLieuxClass();
    $mulhouseLieux->register();
}

if(class_exists("MulhouseLieuxMetaBox")){
    $metaBox = new MulhouseLieuxMetaBox("mulhouse_lieux_address_meta_box" ,"Mulhouse lieux paramètres" , "mulhouse-lieux" , "normal" , "default");
    $metaBox->add_field("adresse_postal" , "L'adresse postal : " , "text")
    ->add_field("access_token" , "Access token : " , "textarea");
}

register_activation_hook(__FILE__ , [$mulhouseLieux , "activate"]);
register_deactivation_hook(__FILE__ , [$mulhouseLieux , "deactivate"]);
register_uninstall_hook(__FILE__ ,plugin_dir_path(__FILE__)."core/uninstall.php");