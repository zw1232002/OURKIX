<?php

class Model extends DB{
	
	protected $_db=null;//数据库连接句柄
	protected $_tables=array();//要操作的表
	protected $_fields=array();//要操作的字段
	protected $_limit = '';//limit字段，用来实现分页
	protected $_R = array();//用来存放临时中转的数据
	
	//
	protected  function __construct(){
		$this->_db=parent::getInstance();
	}
	
	//查询的基类方法
	protected function select (Array $_fields,Array $_params=array()){
		return $this->_db->select($this->_tables, $_fields,$_params);
		
	}
	
	//通过某一个值，来获取
	protected function getOne(Array $_fields,$key,$value,$limit=null){
		$limit=isset($limit) ? $limit : null;
		return $this->_db->select($this->_tables,$_fields,array('where'=>array("$key=$value"),'order'=>'date DESC','limit'=>$limit));
	}
	
	//添加的基类方法
	protected function add(Array $_tables,Array $_fields){
		return $this->_db->add($_tables,$_fields);
	}
	
	//修改方法
	protected function update(Array $_tables,Array $_updateData,$_where){
		return $this->_db->update($_tables,$_updateData,$_where);
	}
	
	//删除方法
	protected function delete(Array $_tables, Array $_where){
		return $this->_db->delete($_tables,$_where);
	}
	
	//通过id删除数据
	protected function delFromId(Array $_tables,$_id){
		return $this->_db->delete($_tables,array('id='.$_id));
	}
	
	
	//获取下一个id
	protected function nextId(){
		return $this->_db->nextId($this->_tables);
	}
	
	
	//获取处理http请求的类
	protected function getRequest(){
		return Request::getInstance();
	}
	
}

?>