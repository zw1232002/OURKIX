<?php

class EditImgsModel extends Model{
	
	public function __construct(){
		parent::__construct();
		$this->_tables=array(DB_PREFEX.'content_imgs');
		$this->_fields=array('id','src_big','src_small','content','pid');
		$this->_R['id']=isset($_GET['id']) ? $_GET['id'] : null;
	}
	
	//添加图片的内容
	public function addContent(){
		return parent::update($this->_tables, Request::getInstance()->filter(array('content')), array('id='.$_POST['id']));
	}
	
	
	public function showImgsInfo(){
		return parent::select(array('id','src_big','content'),array('where'=>array('id='.$this->_R['id'])));
	}
	
}

?>