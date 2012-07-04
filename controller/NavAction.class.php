<?php

class NavAction extends Action{
	
	public function __construct(){
		parent::__construct();
	}
	
	//默认的方法，显示导航列表
	public function index(){
		$this->_tpl->assign('allNav',$this->_model->getAllNav());
		$this->_tpl->display(SMARTY_ADMIN.'/nav/list.tpl');
	}
	
	//新增导航方法
	public function add(){
		//如果是post出来的，那么就执行新增导航的方法
		if(isset($_POST['send'])){
			$va=$this->_model->addNav();
// 			Tool::alertLocation(Tool::getPrevPage(), $va);
		}
		//获取所有的主导航，新增时的下拉列表
		$this->_tpl->assign('mainNav',$this->_model->getMainNav());
		$this->_tpl->display(SMARTY_ADMIN.'/nav/add.tpl');
	}
	
	
	//修改导航方法
	public function update(){
		
		if($_POST['send']){
			$this->_model->updateNav();			
		}
		//获取所有的主导航，新增时的下拉列表
		$this->_tpl->assign('mainNav',$this->_model->getMainNav());
		
		//获取导航的信息
		$this->_tpl->assign('nav_info',$this->_model->getOneNav());
		$this->_tpl->display(SMARTY_ADMIN.'/nav/update.tpl');
// 		Tool::alertLocation(Tool::getPrevPage(), '删除成功！');
	}
	
	
	//删除导航方法
	public function delete(){
		$this->_model->delNav();
// 		$this->_tpl->display(SMARTY_ADMIN.'error.tpl');
// 		echo $va;
// 		$this->_model->delNav() ? Tool::alertLocation(Tool::getPrevPage(), '删除成功！') : null;
	}
}

?>