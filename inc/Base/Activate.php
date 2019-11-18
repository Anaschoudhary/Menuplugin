<?php

/**
 * @package ExtraMenu
 */

namespace Inc\Base;

class Activate{

    public static function activate(){
        
        flush_rewrite_rules();

        $default = array();

                if(!get_option('extramenu_plugin')){
                    update_option('extramenu_plugin', $default);
                }                                                  //there just update a empty($default) array     

            }

}