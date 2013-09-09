<?php

/**
 * Description of Iterface
 *
 * @author air
 */

interface Q_Db_Interface{
	/**
	 * 执行任何 SQL 语句
	 *
	 * @see QP_Db_Abstract()
	 * @return bool
	 */
	public function query($sql);
	
    public function fetch($sql,$bind=array());
	/**
	 * 执行SQL并返回所有结果集
	 *
	 * @see QP_Db_Abstract()
	 * @return array
	 */
	public function fetchAll($sql,$bind=array());
	
	/**
	 * 返回最后执行 Insert() 操作时表中有 auto_increment 类型主键的值
	 *
	 * @see QP_Db_Abstract()
	 * @return int
	 */
	public function lastInsertId();

	/**
	 * 最后 DELETE UPDATE 语句所影响的行数
	 *
	 * @see QP_Db_Abstract()
	 * @return int
	 */
	public function affectedRows();

	/**
	 * 返回当前查询结果集中的记录数
	 * 
	 * @see QP_Db_Abstract()
	 * @return int
	 */
	public function rowCount();

	/**
	 * 开始事务
	 * 
	 * @see QP_Db_Abstract()
	 * @return bool
	 */
	public function beginTransaction();

	/**
	 * 提交事务
	 * 
	 * @see QP_Db_Abstract()
	 * @return bool
	 */
	public function commit();

	/**
	 * 事务回滚
	 * 
	 * @see QP_Db_Abstract()
	 * @return bool
	 */
	public function rollBack();

	/**
	 * 关闭连接
	 */
	public function close();
	
	/**
	 * 返回当前的错误信息
	 *
	 * @return string
	 */
	public function errorMsg();

	/**
	 * 返回当前的错误号
	 *
	 * @return int
	 */
	public function errorNo();
	
	/**
	 * 格式化用于数据库的字符串
	 * 
	 * @return string
	 */
	public function escape($str);
	
}


?>
