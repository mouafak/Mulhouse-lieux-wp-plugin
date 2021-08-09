<?php

/**
 * Undocumented class
 */
class MulhouseLieuxClass
{
    public function __construct()
    {
    }

    /**
     * activate plugin
     *
     * @return void
     */
    public function activate()
    {

        flush_rewrite_rules();
    }

    /**
     * deactivate plugin
     *
     * @return void
     */
    public function deactivate()
    {

        flush_rewrite_rules();
    }


    /**
     * register all hooks
     *
     * @return void
     */
    public function register()
    {

        add_action("init", [$this, "mulhouseLieuxPostType"], 0);
        add_filter("template_include", [$this, "customTemplates"]);
        add_action("wp_enqueue_scripts", [$this, "mulhouse_Lieux_enqueue_style"]);
        add_action("wp_enqueue_scripts", [$this, "mulhouse_lieux_enqueue_script"]);
    }


    function mulhouse_Lieux_enqueue_style()
    {
        $handle = "mulhouse-lieux";
        $src = plugins_url() . "/mulhouse-lieux/assets/css/mulhouse-lieux.css";
        $deps = [];
        $ver = "1.0.0";
        $media = "";
        wp_enqueue_style($handle, $src, $deps, $ver, $media);

        $handleM = "mapbox-gl";
        $srcM = plugins_url() . "/mulhouse-lieux/assets/css/2.4.0/mapbox-gl.css";
        $depsM = [];
        $verM = "";
        $mediaM = "";
        wp_enqueue_style( $handleM, $srcM, $depsM, $verM, $mediaM );
    }

    function mulhouse_lieux_enqueue_script()
    {
        $handle = "mapbox-gl";
        $src = plugins_url() . "/mulhouse-lieux/assets/js/2.4.0/mapbox-gl.js";
        $deps = [];
        $ver = "";
        $in_footer = false;
        wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );

        $handleM = "mulhouse-lieux";
        $srcM = plugins_url() . "/mulhouse-lieux/assets/js/mulhouse-lieux.js";
        $depsM = [];
        $verM = "1.0.0";
        $in_footerM = true;
        wp_enqueue_script( $handleM, $srcM, $depsM, $verM, $in_footerM );
    }    

    // Register Custom Post Type Mulhouse Lieux

    /**
     * Register Custom Post Type Mulhouse Lieux
     *
     * @return void
     */
    public function mulhouseLieuxPostType()
    {

        /**
         * @var array $labels 
         */
        $labels = array(
            'name' => _x('Mulhouse lieux', 'Post Type General Name', 'flelearning.net'),
            'singular_name' => _x('Mulhouse lieux', 'Post Type Singular Name', 'flelearning.net'),
            'menu_name' => _x('Lieux', 'Admin Menu text', 'flelearning.net'),
            'name_admin_bar' => _x('Mulhouse lieu', 'Add New on Toolbar', 'flelearning.net'),
            'archives' => __('Archives Mulhouse lieu', 'flelearning.net'),
            'attributes' => __('Attributs Mulhouse lieu', 'flelearning.net'),
            'parent_item_colon' => __('Parents Mulhouse lieu:', 'flelearning.net'),
            'all_items' => __('Tous Mulhouse lieux', 'flelearning.net'),
            'add_new_item' => __('Ajouter nouvel Mulhouse lieu', 'flelearning.net'),
            'add_new' => __('Ajouter', 'flelearning.net'),
            'new_item' => __('Nouvel Mulhouse lieu', 'flelearning.net'),
            'edit_item' => __('Modifier Mulhouse lieu', 'flelearning.net'),
            'update_item' => __('Mettre à jour Mulhouse lieu', 'flelearning.net'),
            'view_item' => __('Voir Mulhouse lieu', 'flelearning.net'),
            'view_items' => __('Voir Mulhouse lieux', 'flelearning.net'),
            'search_items' => __('Rechercher dans les Mulhouse lieu', 'flelearning.net'),
            'not_found' => __('Aucun Mulhouse lieu trouvé.', 'flelearning.net'),
            'not_found_in_trash' => __('Aucun Mulhouse lieu trouvé dans la corbeille.', 'flelearning.net'),
            'featured_image' => __('Image mise en avant', 'flelearning.net'),
            'set_featured_image' => __('Définir l’image mise en avant', 'flelearning.net'),
            'remove_featured_image' => __('Supprimer l’image mise en avant', 'flelearning.net'),
            'use_featured_image' => __('Utiliser comme image mise en avant', 'flelearning.net'),
            'insert_into_item' => __('Insérer dans Mulhouse lieu', 'flelearning.net'),
            'uploaded_to_this_item' => __('Téléversé sur cet Mulhouse lieu', 'flelearning.net'),
            'items_list' => __('Liste Mulhouse lieux', 'flelearning.net'),
            'items_list_navigation' => __('Navigation de la liste Mulhouse lieux', 'flelearning.net'),
            'filter_items_list' => __('Filtrer la liste Mulhouse lieux', 'flelearning.net'),
        );

        /**
         * @var array $args
         */
        $args = array(
            'label' => __('Mulhouse lieux', 'flelearning.net'),
            'description' => __('Ajouter des lieux ', 'flelearning.net'),
            'labels' => $labels,
            'menu_icon' => 'dashicons-palmtree',
            'supports' => array('title', 'editor', 'thumbnail', 'revisions', 'author', 'comments', 'trackbacks', 'custom-fields'),
            'taxonomies' => array(),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 5,
            'show_in_admin_bar' => true,
            'show_in_nav_menus' => true,
            'can_export' => true,
            'has_archive' => true,
            'hierarchical' => false,
            'exclude_from_search' => false,
            'show_in_rest' => true,
            'publicly_queryable' => true,
            'capability_type' => 'post',
        );

        register_post_type('mulhouse-lieux', $args);
    }


    function customTemplates($default_templates)
    {

        // Check Theme Template or Plugin Template for archive-links.php

        $file = trailingslashit(get_template_directory()) . 'archive-mulhouse-lieux.php';

        if (is_post_type_archive('mulhouse-lieux')) {
            if (file_exists($file)) {
                return trailingslashit(get_template_directory()) . 'archive-mulhouse-lieux.php';
            } else {
                return plugin_dir_path(__DIR__) . 'templates/archive-mulhouse-lieux.php';
            }
        } elseif (is_singular('mulhouse-lieux')) {
            if (file_exists(get_template_directory_uri() . '/single-mulhouse-lieux.php')) {
                return get_template_directory_uri() . '/single-mulhouse-lieux.php';
            } else {
                return plugin_dir_path(__DIR__) . 'templates/single-mulhouse-lieux.php';
            }
        }

        return $default_templates;
    }
}