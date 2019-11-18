<?php

/**
 * @package ExtraMenu
 */

 namespace Inc\Base;

 class BaseController{

    public $plugin_path;
    public $plugin_url;
    public $plugin;
    public $managers = array();

    public function __construct(){
        
        $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
        $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
        $this->plugin = plugin_basename(dirname(__FILE__, 3)). '/extra-menu.php';

        $this->managers = array(
            'extra_menu_manager' => 'Menu Slug'
        );
    }

    public function activated(string $key){
        $option = get_option('choudhary_plugin');
        return isset($option[$key]) ? $option[$key] : false;
    }
 }

