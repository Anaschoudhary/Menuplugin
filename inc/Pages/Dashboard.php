<?php

/**
 * @package ExtraMenu
 * 
 */

namespace Inc\Pages;

use \Inc\Api\SettingsApi;
use \Inc\Base\BaseController;
use \Inc\Api\Callbacks\AdminCallbacks;
use \Inc\Api\Callbacks\ManagerCallbacks;


class Dashboard extends BaseController{

    public $settings;
    public $callbacks;
    public $callbacks_mngr;
    public $pages = array();
    //public $subpages = array();
    

    public function register(){

        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();
        $this->callbacks_mngr = new ManagerCallbacks();
        $this->setPages();
        //$this->setSubPages();  
        $this->setSettings();
        $this->setSections();
        $this->setFields();
        $this->settings->addPages( $this->pages )->withSubPage('Dashboard')->register();
        
    }

    public function setPages(){

        $this->pages = array(
            array(
                'page_title'=>'Extra Menu Plugin',
                'menu_title'=>'Extra Menu',
                'capability'=>'manage_options',
                'menu_slug'=>'extramenu_plugin',
                'callback'=> array($this->callbacks, 'adminDashboard' ),
                'icon_url'=>'dashicons-store',
                'position'=>110
            )
            );
    }

    public function setSettings(){

        $args = array();

            $args[] =  array(
                    'option_group' => 'extramenu_plugin_settings',
                    'option_name' => 'extramenu_plugin'
                    //'callback' => array($this->callbacks_mngr, 'checkboxSanitize' )
            );
       
        $this->settings->setSettings( $args );
    }


    public function setSections(){

        $args = array(

            array(
                'id' => 'extramenu_plugin_index',
                'title' => 'Setting',
                'callback' => array($this->callbacks_mngr, 'adminSectionManager' ),
                'page' => 'extramenu_plugin'
            ),
            array(
                'id' => 'extramenu_plugin_select_category',
                'title' => 'Select Categories',
                'callback' => array($this->callbacks_mngr, 'adminCategorySection' ),
                'page' => 'extramenu_plugin'
            )       
        );

        $this->settings->setSections( $args );
    }

    public function setFields(){

        $args = array();

            $args[] =  array(
    
                'id' => 'extra_menu_manager',
                'title' => 'Menu Slug',
                'callback' => array($this->callbacks_mngr, 'checkboxField' ),
                'page' => 'extramenu_plugin',
                'section' => 'extramenu_plugin_index',
                'args' => array(
                    'option_name' => 'extramenu_plugin', // can give any name in place of 'option_name'
                    'label_for' => 'extra_menu_manager',
                    'class' => 'ui-toggle'
                )
            );

            $args[] =  array(
    
                'id' => 'extra_menu_text',
                'title' => 'Menu text',
                'callback' => array($this->callbacks_mngr, 'menu_text' ),
                'page' => 'extramenu_plugin',
                'section' => 'extramenu_plugin_index',
                'args' => array(
                    'option_name' => 'extramenu_plugin', // can give any name in place of 'option_name'
                    'label_for' => 'extra_menu_text',
                    'class' => 'ui-toggle'
                )
            );

                $categories = get_categories();

                foreach($categories as $category){

                $args[] = array(

                    'id' => $category->slug,
                    'title' => $category->name,
                    'callback' => array($this->callbacks_mngr, 'allcategories' ),
                    'page' => 'extramenu_plugin',
                    'section' => 'extramenu_plugin_select_category',
                    'args' => array(
                        'option_name' => 'extramenu_plugin', // can give any name in place of 'option_name'
                        'label_for' => $category->slug,
                        'class' => 'ui-toggle'
                        )
                    );
                }

        $this->settings->setFields( $args );
    }
}