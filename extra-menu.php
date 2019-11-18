<?php

/**
 * @package ExtraMenu
 */

//use Inc\Base\Activate;

/*
   Plugin Name: Extra Menu Plugin
   Plugin URI: https://deobandlive.com
   Description: This is my plugin description
   Version: 1.0.0
   Author: Anas Choudhary
   Author URI: https://deobandlive.com
   License: GPLv2 or later
   Text Domain: extra-menu
  */


defined('ABSPATH') or die('Hey,  you cant access this file, you silly human!');

if( file_exists(dirname(__FILE__). '/vendor/autoload.php')){
    require_once dirname(__FILE__). '/vendor/autoload.php';
}


function activate_extramenu(){
  Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_extramenu');


function deactivate_extramenu(){
  Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook(__FILE__, 'deactivate_extramenu');



if( class_exists('Inc\\Init')){ 
  
    Inc\Init::register_services(); 
}

