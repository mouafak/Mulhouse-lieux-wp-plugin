<?php

class MulhouseLieuxMetaBox
{
    /**
     * id of meta box
     *
     * @var string
     */
    private $mb_id;

    /**
     * title of meta box
     *
     * @var string
     */
    private $mb_title;

    /**
     * context of meta box
     *
     * @var string
     */
    private $mb_context;

    /**
     * priority of meta box
     *
     * @var string
     */
    private $mb_priority;

    /**
     * meta box screen
     *
     * @var string
     */
    private $mb_screen;

    /**
     * array de fields
     *
     * @var array
     */
    private $fields = [];


    function __construct($mb_id, $mb_title, $mb_screen, $mb_context, $mb_priority)
    {

        $this->mb_id = $mb_id;
        $this->mb_title = $mb_title;
        $this->mb_screen = $mb_screen;
        $this->mb_context = $mb_context;
        $this->mb_priority = $mb_priority;

        add_action('add_meta_boxes', [$this, "create_meta_box"]);
        add_action('save_post', [$this, 'save_update_delete_meta_box_data']);
    }

    /**
     * Create meta box
     *
     * @return void
     */
    function create_meta_box()
    {

        $id = $this->mb_id;
        $title = $this->mb_title;
        $callback = [$this, "meta_box_callback"];
        $screen = $this->mb_screen;
        $context = $this->mb_context;
        $priority = $this->mb_priority;

        add_meta_box($id, $title, $callback, $screen, $context, $priority);
    }

    /**
     * Callback for meta box
     *
     * @param [type] $post
     * @return void
     */
    function meta_box_callback($post)
    {


        if (!empty($this->fields)) {

            $action = $this->mb_id . "_action";
            $name = $this->mb_id . "_nonce";
            wp_nonce_field($action, $name);

            foreach ($this->fields as $field) {

                extract($field);
                $post_id = $post->ID;
                $key = $field_id . "_value_key";
                $single = true;
                $value = get_post_meta($post_id, $key, $single);

                switch ($field_type) {
                    case 'textarea':
                        require plugin_dir_path(__FILE__) . "fields/textarea_field.php";
                        break;

                    default:
                        require plugin_dir_path(__FILE__) . "fields/text_field.php";
                        break;
                }
            }
        }
    }

    /**
     * Add params for every meta box
     *
     * @param [type] $field_id
     * @param [type] $field_label
     * @param [type] $field_type
     * @return object
     */
    function add_field($field_id, $field_label, $field_type)
    {

        $this->fields[] =
            [
                "field_id" => $field_id,
                "field_label" => $field_label,
                "field_type" => $field_type,
            ];

        return $this;
    }

    /**
     * save,update meta box
     *
     * @param [type] $post_id
     * @return void
     */
    function save_update_delete_meta_box_data($post_id)
    {

        $nonce = $this->mb_id . "_nonce";
        $action = $this->mb_id . "_action";

        if (!wp_verify_nonce($_POST[$nonce], $action)) {
            return;
        }

        foreach ($this->fields as $field) {

            extract($field);

            if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
                return;
            }

            if (!current_user_can("edit_post", $post_id)) {
                return;
            }

            if (!isset($_POST[$field_id . '_filed_id'])) {
                return;
            }

            $str = $_POST[$field_id . '_filed_id'];

            $meta_value = sanitize_text_field($str);

            $meta_key = $field_id . "_value_key";

            update_post_meta($post_id, $meta_key, $meta_value);
        }
    }
}
