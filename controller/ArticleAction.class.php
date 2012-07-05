<?php

class ArticleAction extends Action {
	
	public function __construct(){
		parent::__construct();
	}
	
	//默认的index方法，显示所有的文章
	public function index(){
		$this->_tpl->assign('allArtice',$this->_model->getAllArticle());
		$this->_tpl->display(SMARTY_ADMIN.'article/list.tpl');
	}
	
	//添加文章
	public function add(){
		if($_POST['send']){
			$this->_model->addArticle() ? Redirect::getInstance($this->_tpl)->succ('?a=article&m=index', ADD_SUCCESS) : Redirect::getInstance($this->_tpl)->succ(Tool::getPrevPage(), ADD_FAILED);	
		}
		
		//
		$nav=new NavModel();
		$this->_tpl->assign('mainNav',$nav->getMainNav());
		
		$this->_tpl->display(SMARTY_ADMIN.'article/add.tpl');
	}
	
}

?>