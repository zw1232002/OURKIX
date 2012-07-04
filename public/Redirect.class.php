<?php
//跳转类，新增或删除操作时使用
class Redirect {
	//用于存放实例化的对象
	static private $_instance = null;
	
	//公共静态方法获取实例化的对象
	static public function getInstance(TPL &$_tpl = null) {
		if (!(self::$_instance instanceof self)) {
			self::$_instance = new self();
			self::$_instance->_tpl = $_tpl;
		}
		return self::$_instance;
	}
	
	//私有克隆
	private function __clone() {}
	
	//私有构造
	private function __construct() {}
	
	
}
?>