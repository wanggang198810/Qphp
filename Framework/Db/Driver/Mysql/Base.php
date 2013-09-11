<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
class Db_Base {
    //put your code here
    
    /**
     * 解析where条件，允许直接传入字符串格式和数据格式
     * 
     */
    public function parseWhere($data){
        if(is_array($data)){
            return $this->_parseData($data, 'and');
        }else{
            return $data;
        }
    }
    
    /**
     * 解析要更新的字段
     * @param Array $data
     */
    public function parseUpdate($data){
        return $this->_parseData($data, ',');
    }
    
    /**
     * 
     */
    public function parseInsert($data){
        return $this->_parseData($data, ',');
    }
    
    /**
     * 解析数据
     */
    protected function _parseData($data, $gas=','){
        $temp = '';
        foreach ($data as $k => $v){
            $temp .= $this->_parseField( $k ) . " = '".$this->_parseValue( $v ) . "' " . $gas.' ';
        }
        return trim($temp, $gas.' ');
    }
    
    /**
     * 给数据库字段两边加上 ` 符号
     */
    protected function _parseField($field){
		$field = trim($field);
		if (strstr($field,' ')===false){
			$field = '`'.$field.'`';
		}
		return $field;
	}
    
    /**
     * 过滤值
     */
    protected function _parseValue($value){
        return addslashes($value);
    }
    
    
}

?>
