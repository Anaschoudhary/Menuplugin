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

    public function adminCategorySection(){
        echo 'Select the categories here which you want to show in menu';
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

    public function menu_text($args){
        
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name = $args['option_name'];
        $value = get_option( $option_name );
        $textfieldvalue = $value[$name];
        echo'<input type="text" id = "'.$name.'" name="'.$option_name.'['.$name.']" class="' . $classes . '"
        value="'.$textfieldvalue.'">';

    }

    public function allcategories($args){
        
        $name = $args['label_for'];
        $classes = $args['class'];
        $option_name =$args['option_name'];
        $checkbox = get_option( $option_name );
        $checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;
        echo'<input type="checkbox" id = "'.$name.'" name="'.$option_name.'['.$name.']" value="1" class="' . $classes . '" ' . ($checked ? 'checked' : '') . '>';
    }
}
 