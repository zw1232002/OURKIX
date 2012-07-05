<?php

class ArticleModel extends Model{
	
	
	public function __construct(){
		parent::__construct();
		$this->_tables=array(DB_PREFEX.'article');
		$this->_fields=array('id','nav','title','info','tags','author','count','content','comment','date','thumb','like','collect','share','src','pid');
	}
	
	//获取所有的文章
	public function getAllArticle(){
		return $this->select(array('id','nav','title','date'),array('order'=>'date DESC'));
	}
	
	
	
	//添加文章
	public function addArticle(){
		$addData=Request::getInstance()->filter($this->_fields);
		$addData['author']=isset($_SESSION['admin']) && !Validate::isNullArray($_SESSION['admin']) ? $_SESSION['admin'] : null;
		$addData['date']=Tool::getDate();
		return $this->add($this->_tables, $addData);
	}
}

?>