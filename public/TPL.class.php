<?php

//TPL继承smarty,在TPL类中修改smarty的配置
class TPL extends Smarty{
	
	//创建一个静态属性，用于存放实例化的对象，为了保持只实例化一次
	static private $_instance=null;
	
	//
	private function __construct(){
		$this->setConfigs();
	}
	
	
	//一个静态方法，用来获得实例化后的对象
	static public function getInstance(){
		if (!self::$_instance instanceof self){
			self::$_instance=new self;
		}
		return self::$_instance;
	}
	
	//私有化克隆，也是为了保持单例模式
	private function __clone(){}
	
	
	//配置smarty的一些属性
	private function setConfigs(){
		$this->template_dir=SMARTY_TEMPLATE_DIR;
		$this->compile_dir=SMARTY_COMPILE_DIR;
		$this->config_dir=SMARTY_CONFIG_DIR;
		$this->cache_dir=SMARTY_CACHING;
		$this->caching=SMARTY_CACHING;
		$this->cache_lifetime=SMARTY_CACHE_LIFETIME;
		$this->left_delimiter=SMARTY_LEFT_DELIMITER;
		$this->right_delimiter=SMARTY_RIGHT_DELIMITER;
	}
	
	
}

?>