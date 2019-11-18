<?php

/**
 * @package ExtraMenu
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController{

 
    public function checkboxSanitize( $input ){

        $output = array();

        foreach($this->managers as $key => $value ){
            $output[$key] = isset($input[$key]) ?  $input[$key] : '' ;
        }
        return $output;
    }

    public function adminSectionManager(){

        echo 'Manage the Setting in which menu you want show the html';
    }

    public function checkboxField($args){
        
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value = get_option( $option_name );
        $textfieldvalue = $value[$name];
        echo'<input type="text" id = "'.$name.'" name="'.$option_name.'['.$name.']" class="' . $classes . '"
        value="'.$textfieldvalue.'">';

    }
}
 