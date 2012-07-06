<?php

class ArticleAction extends Action {
	
	public function __construct(){
		parent::__construct();
	}
	
	//默认的index方法，显示所有的文章
	public function index(){
		
		//所有的主导航
		$nav=new NavModel();
		
		$this->_tpl->assign('parentId',$this->_model->returnGetId());
		$this->_tpl->assign('mainNav',$nav->getMainNav());
		
		//根据get获得的id，显示对应主分类的所有的文章
		$this->_tpl->assign('allArtice',$this->_model->getAllArticle());
		$this->_tpl->display(SMARTY_ADMIN.'article/list.tpl');
	}
	
	//添加文章
	public function add(){
// 		$upload=new FileUpload('filedata');
// 		$path=$upload->getPath();
		echo $_FILES['Filedata']['tmp_name'];
		
		
		if($_POST['send']){
			$this->_model->addArticle() ? Redirect::getInstance($this->_tpl)->succ('?a=article&m=index', ADD_SUCCESS) : Redirect::getInstance($this->_tpl)->succ(Tool::getPrevPage(), ADD_FAILED);	
		}
		//
		$nav=new NavModel();
		$this->_tpl->assign('mainNav',$nav->getMainNav());
		$this->_tpl->display(SMARTY_ADMIN.'article/add.tpl');
	}
	
	
	//删除文章
	public function delete(){
		$this->_model->delArticle() ? Redirect::getInstance($this->_tpl)->succ('?a=article', DEL_SUCCESS) : Redirect::getInstance($this->_tpl)->succ(Tool::getPrevPage(), DEL_FAILED);
	}
	
	
	//ajax修改置顶
	public function ajaxTop(){
		echo $this->_model->ajaxSetTop();
	}
	
	
	public function uploadImgs(){
		
	}
	
}

?>