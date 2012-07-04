<?php

/*
 * Action 基类
 * 为了使基类不能被直接实例化，让__construct设置成protected,在子类中执行父类的__construct方法
 * */
class Action{
	
	protected $_tpl=null;
	protected $_model=null;
	protected $_redirect=null;
	
	protected  function __construct(){
		$this->_tpl=TPL::getInstance();
		$this->_model=Factory::setModel();
	}
	
	
	//run方法，接收m传过来的值，进而执行每个action类中对应的方法，
	public  function run(){
		
		//初始化m的值，如果有值就返回，不然就返回index
		$m=isset($_GET['m']) && !empty($_GET['m'])? $_GET['m'] : 'index';
		
		//如果对应的方法存在，就执行对应的方法，否则执行index方法。
		method_exists($this, $m) ? eval('$this->'.$m.'();') :$this->index();
	}
	
}




?>