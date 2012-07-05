<?php

/*
 * class Factory
 * 用来实现单入口类，通过里面的setAction等方法，来接受get值(因为get是超级全局变量)，进而判断实例化哪一个action，model也是一样
 * 其中a代表那个action，即a=list，表示listAction
 * */
class Factory{
	static private $_obj=null;
	
	
	//获取a的值，并进行判断
	static public function getA(){
		if(isset($_GET['a']) && !empty($_GET['a'])){
			return $_GET['a'];
		}
		return "Index";
	}
	
	//判断action的方法
	static public function setAction(){
		$a=self::getA();
		if(!file_exists(ROOT_PATH.'controller/'.ucfirst($a).'Action.class.php')){
			$a='Index';
		}
		eval('self::$_obj= new '.ucfirst($a).'Action();');//用eval方法进行实例化，同时用ucfirst函数，讲第一个字母转换成大写
		return self::$_obj;
	}
	
	
	//判断model的方法
	static public function setModel(){
		$a=self::getA();
		if(!file_exists(ROOT_PATH.'model/'.ucfirst($a).'Model.class.php')){
			$a='Index';
		}
		eval('self::$_obj= new '.ucfirst($a).'Model();');//用eval方法进行实例化，同时用ucfirst函数，讲第一个字母转换成大写
		return self::$_obj;
		
	}
}

?>