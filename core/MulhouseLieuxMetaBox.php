<?php

class MulhouseLieuxMetaBox
{


    function __construct()
    {
        add_action('add_meta_boxes' , [ $this , "mulhouse_lieux_add_meta_box" ] );
        add_action('save_post' , [$this , 'mulhouse_lieux_save_update_address_meta_box_data'] );
    }

    function mulhouse_lieux_add_meta_box()
    {

        $id = "mulhouse_lieux_meta_box";
        $title = "Paramètres pour Mulhouse lieux ";
        $callback = [$this , "mulhouse_lieux_meta_box_callback"];
        $screen = "mulhouse-lieux";
        $context ="side";   
        $priority = "high";
        add_meta_box($id, $title, $callback, $screen , $context, $priority);
    }

    function mulhouse_lieux_meta_box_callback($post)
    {

        //mange - update - save and a lot of code for our meta box

        $action = "mulhouse_lieux_save_update_address_meta_box_data";
        $name = "mulhouse_lieux_address_meta_box_nonce";
        wp_nonce_field($action, $name);

        $post_id = $post->ID;
        $key = "_address_meta_box_value_key";
        $single = true;
        $value = get_post_meta($post_id, $key, $single);
   
        echo
        '
        <label for="mulhouse_lieux_address_filed" > l\'adresse postale : </label>
        <input type="text" id="mulhouse_lieux_address_filed" name ="mulhouse_lieux_address_filed" value="' . esc_attr($value) . '" size="25" />
        ';
    }

    function mulhouse_lieux_save_update_address_meta_box_data($post_id)
    {

        $nonce = "mulhouse_lieux_address_meta_box_nonce";
        $action = "mulhouse_lieux_save_update_address_meta_box_data";

        if(! isset($_POST[$nonce]))
        {
            return;
        }

        if(! wp_verify_nonce( $_POST[$nonce], $action ))
        {
            return;
        }

        if( defined("DOING_AUTOSAVE") && DOING_AUTOSAVE )
        {
            return;
        }

        if(! current_user_can("edit_post" , $post_id))
        {
            return;
        }

        if(! isset($_POST['mulhouse_lieux_address_filed']))
        {
            return;
        }

        $str = $_POST['mulhouse_lieux_address_filed'];
        $meta_value = sanitize_text_field( $str );
        $meta_key = "_address_meta_box_value_key";
        update_post_meta( $post_id, $meta_key, $meta_value );

    }
}
