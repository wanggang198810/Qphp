<?php
/**
 * 
 * Q PHP FRAMEWORK, A Newcomer's Framework.
 * 
 * @author Air
 */
interface Db_Interface {
    //put your code here
    
    public function query($sql);
    
    /**
     * 获取单条数据
     */	
    public function fetch($sql,$bind=array());
	/**
	 * 执行SQL并返回所有结果集
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
	 */
	public function affectedRows();

	/**
	 * 返回当前查询结果集中的记录数
	 */
	public function rowCount();

	/**
	 * 开始事务
	 */
	public function beginTransaction();

	/**
	 * 提交事务
	 */
	public function commit();

	/**
	 * 事务回滚
	 */
	public function rollBack();

	/**
	 * 关闭连接
	 */
	public function close();
	
	/**
	 * 返回当前的错误信息
	 */
	public function errorMsg();

	/**
	 * 返回当前的错误号
	 */
	public function errorNo();
	
	/**
	 * 格式化用于数据库的字符串
	 */
	public function escape($str);
    
}
?>
