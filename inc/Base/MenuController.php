<?php

/**
 * @package ChoudharyPlugin
 * 
 */

namespace Inc\Base;


use \Inc\Base\BaseController;

class MenuController extends BaseController{

    public function register(){
        
        add_filter( 'wp_nav_menu_items', array($this, 'add_nav_item'), 10, 2 );
        
    }

    function add_nav_item($items, $args) {

        $name = 'extra_menu_manager';
        $option_name = 'extramenu_plugin';
        $option = get_option($option_name);
        $menu_text = $option['extra_menu_text'];
        $menu = $option[$name];
        
      
        if ($args->menu->slug == $menu ) { // change your menu slug name
    
            // Add your html
            $categories = get_categories();
            $item = '';
            $item .='<li  class="menu-item "><a href="#">'.$menu_text.'<svg class="icon icon-angle-down" aria-hidden="true" role="img"> <use href="#icon-angle-down" xlink:href="#icon-angle-down"></use> </svg></a><button class="dropdown-toggle" aria-expanded="false"><svg class="icon icon-angle-down" aria-hidden="true" role="img"> <use href="#icon-angle-down" xlink:href="#icon-angle-down"></use> <span class="svg-fallback icon-angle-down"></span></svg></button>';
            $item .= '<ul class="sub-menu">';
            
            foreach($categories as $category) {
            $item .=  '<li  class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children"><a href="#">' . $category->name . '<svg class="icon icon-angle-down" aria-hidden="true" role="img"> <use href="#icon-angle-down" xlink:href="#icon-angle-down"></use> </svg></a><button class="dropdown-toggle" aria-expanded="false"><svg class="icon icon-angle-down" aria-hidden="true" role="img"> <use href="#icon-angle-down" xlink:href="#icon-angle-down"></use> <span class="svg-fallback icon-angle-down"></span></svg></button>';
            $args = array(
                'post_type' => 'post',
                'post_status' => 'publish',
                'category_name' => $category->name,
                //'posts_per_page' => 5,
                'orderby' => 'date',                
            );

            $posts = new \WP_Query( $args );
            
            $item .= '<ul class="sub-menu">';
            if( $posts->have_posts() ){

                while( $posts->have_posts() ) : $posts->the_post();
                    $post_title = get_the_title();
                    $item .= '<li class="menu-item menu-item-type-post_type menu-item-object-page"><a href="'.get_post_permalink().'">';

                    $item .= $post_title;
                    $item .= '</a></li>';
                endwhile;

            }

            $item .= '</ul>';
                }
            $item .= '</li>';
            $item .= '</ul>';
            $item .= '</li>';

            $items = $item.$items;
        }
      return $items;
    }
}