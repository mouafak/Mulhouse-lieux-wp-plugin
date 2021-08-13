<?php

class MulhouseLieuxOptions
{

    function __construct()
    {
        $this->register();
    }

    public function register(){
        add_action("admin_init" , [$this , "mulhouse_lieux_options_register_custom_fields"]);
    }

    function mulhouse_lieux_options_register_custom_fields(){

        //register settings

        $option_group = "mulhouse_lieux_settings_groupe";
        $option_name = "setting_api_key";
        $args = [$this , "mulhouse_lieux_settings_groupe_callback"];

        register_setting( $option_group, $option_name, $args );

        $id ="mulhouse_lieux_section";
        $title ="Settings map box api";
        $callback = [$this , "mulhouse_lieux_section_callback"];
        $page="mulhouse-lieux-settings"; //menu slug of setting page of custom type post mulhouse lieux

        add_settings_section( $id, $title, $callback, $page );

        $field_id = $option_name;
        $field_title = "Api map box key";
        $field_callback = [$this , "api_key_field_callback"];
        $field_page = "mulhouse-lieux-settings";
        $field_section ="mulhouse_lieux_section";
        $field_args = ["label_for" => "setting_api_key"];

        add_settings_field( $field_id, $field_title, $field_callback, $field_page, $field_section, $field_args );

    }

    function mulhouse_lieux_settings_groupe_callback($setting_api_key){
        return $setting_api_key;
    }

    function mulhouse_lieux_section_callback (){

        echo "Insert the API key of map box api reference <a href='https://www.mapbox.com/' target='_blank' >here</a>";

    }

    function api_key_field_callback(){

        $value = esc_attr(get_option("setting_api_key"));

        echo '
        
        <input type="text" class="regular-text" name="setting_api_key" value="'.$value.'" placeholder="insert the api key here ..."

        ';

    }
    
}