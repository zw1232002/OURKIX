<?php

class AdminAction extends Action{
	
	public function __construct(){
		parent::__construct();
	}
	
	//
	public  function index(){
		$this->_tpl->assign('name','起始页');
		$this->_tpl->display(SMARTY_ADMIN.'admin.tpl');
	}
	
}

?>