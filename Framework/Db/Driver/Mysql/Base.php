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
    public function _parseWhere($data){
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
    public function _parseUpdate($data){
        return $this->_parseData($data, ',');
    }
    
    /**
     * 
     */
    public function _parseInsert($data){
        return $this->_parseData($data, ',');
    }
    
    protected function _parseInsertSet($data){
        $result = array();
        $gas = '';
        $result['field'] = '';
        $result['value'] = '';
        foreach ($data as $key => $val){
            $result['field'] .= $gas . $this->_parseField($key);
            $result['value'] .= $gas ."'".$this->_parseValue($val)."'";
            $gas = ',';
        }
        return $result;
    }


    /**
     * 解析数据
     */
    protected function _parseData($data, $gas=','){
        $temp = '';
        foreach ($data as $k => $v){
            if(is_numeric($v)){
                $temp .= $this->_parseField( $k ) . " = ".$this->_parseValue( $v ) . " " . $gas.' ';
            }else{
                $temp .= $this->_parseField( $k ) . " = '".$this->_parseValue( $v ) . "' " . $gas.' ';
            }
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
