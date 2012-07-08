<?php

class UploadImgsAction extends Action{
	
	public function __construct(){
		parent::__construct();
	}
	
	
	//
	public function index(){
		
	}
	
	
	//处理文章内容图片，即轮播的图片和点击轮播出现的幻灯片的图片
	public function upload(){
		echo json_encode($this->_model->addUploadImgs());
	}
	
	//ajax删除已经上传的图片
	public function delImgs(){
		echo $this->_model->delImgs();
	}
	
}

?>