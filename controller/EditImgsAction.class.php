<?php

class EditImgsAction extends Action{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function index(){
		if($_POST['send']){
			$this->_model->addContent()? Tool::close(UPDATE_SUCCESS) : Redirect::getInstance($this->_tpl)->succ(Tool::getPrevPage(), UPDATE_FAILED);
		}
		$this->_tpl->assign('imgsInfo',$this->_model->showImgsInfo());
		$this->_tpl->display(SMARTY_ADMIN.'article/updateImgs.tpl');
	}
	
	
// 	public function addAndEdit(){
		
// 	}
	
}

?>