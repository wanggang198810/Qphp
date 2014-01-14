<?php
/**
 * Description of Form
 *
 * @author Administrator
 */
class Q_Form {
    
    
    /**
     * 创建一完整表单,
     * $field = array(
     *      array('name'=>'', 'class'=> '', 'type'=>''),
     *      array('name'=>'', 'class'=> '', 'type'=>''),
     * );
     */
    public static function create($field, $url='', $method='' , $upload=0, $formname=''){
        if(empty($field)){return ;}
        $upload = $upload ? ' enctype="multipart/form-data"' :  '';
        $formname = !empty($formname) ? ' name="'.$formname.'"' : '';
        $html = '<form action="' . $url . '" method="'. trim($method) .'"'. $upload . $formname .'>';
        foreach($field as $k => $v){
            
        }
        
        $html .= '</form>';
        return '';
    }
    
    
    public static function button(){
        
    }
    
    public static function input($name, $class='', $hidden=0, $placeholder= '', $default=''){
        $class = !empty($class) ? ' class = "'.$class.'" ' : '';
        $placeholder = !empty($placeholder) ? ' placeholder = "'.$placeholder.'" ' : ''; 
        $type = $hidden ? ' type="hidden"' : ' type="text"';
        $html = '<input name="'. $name .' id="'.$name.'" '.$class . $placeholder . $type .' />';
        return $html;
    }
    
    
    public static function textarea($name, $class='', $default=''){
        $class = !empty($class) ? ' class = "'.$class.'" ' : ''; 
        $html = '<textarea name="'. $name .' id="'.$name.'" '.$class .'>'.$default.'</textarea>';
        return $html;
    }
    
    public static function file($name, $class='', $accept=array()){
        $accept = !empty($accept) ? ' accept="' . implode(',', $accept). '"' : '';
        $class = !empty($class) ? ' class = "'.$class.'" ' : ''; 
        $html = '<input type="file" name="'. $name .' id="'.$name.'" '.$class . $accept . ' />';
        return $html;
    }
    
    public static function radio($name, $class= '', $checked = 0){
        $checked = !empty($checked) ? ' checked="checked"' : '';
        $class = !empty($class) ? ' class = "'.$class.'" ' : ''; 
        $html = '<input type="radio" name="'. $name .' id="'.$name.'" '.$class . $checked . ' />';
        return $html;
    }
    
    public static function checkbox($name, $class= '', $checked = 0){
        $checked = !empty($checked) ? ' checked="checked"' : '';
        $class = !empty($class) ? ' class = "'.$class.'" ' : ''; 
        $html = '<input type="checkbox" name="'. $name .' id="'.$name.'" '.$class . $checked . ' />';
        return $html;
    }
    
    /**
     * $field = array(
     *      array('value'=>'', 'text'=>'', 'selected' =>0),
     *      array('value'=>'', 'text'=>'', 'selected' =>0),
     * )
     */
    public static function select($name, $field , $class='', $default=''){
        if(empty($field)){ return false;}
        $class = !empty($class) ? ' class = "'.$class.'" ' : ''; 
        $html= '<select name="'.$name.'" id="'.$name.'" '.$class.'>';
        foreach($field as $k => $v){
            if(!empty($default) && $v['value'] == $default){
                $selected = ' selected="selected"';
            }else{
                $selected = '';
            }
            $html .= '<option value="'.$v['value'].'" '.$selected.'>'.$v['text'].'</option>';
        }
        $html .= '</select>';
    }
    
}
