<?php

//开启session
session_start();

//提升错误级别，输出所有级别的错误，方便调试
// error_reporting(E_ALL);

//定义一个绝对路径,substr是因为当前文件在configs目录下，要把configs截取掉
define('ROOT_PATH', substr(dirname(__FILE__),0,-8).'/');

//设置默认字符编码
header('Content-Type:text/html;charset=utf-8');

//设置时区
date_default_timezone_set('Asia/Shanghai');

//引入系统配置文件
require ROOT_PATH.'configs/config.inc.php';

//引入smarty
require ROOT_PATH.'smarty/Smarty.class.php';

/*
 * 自动加载类，类的名字都是按照规则命名的
 * 如果后6个单词是Action，那么加载controller目录下的文件
 * 如果后5个单词是Model,那么加载Model目录下的文件
 * */
function __autoload($className){
	if(substr($className, -6)==='Action'){
		include ROOT_PATH.'controller/'.$className.'.class.php';
	}elseif (substr($className, -5)==='Model'){
		include ROOT_PATH.'model/'.$className.'.class.php';
	}elseif (substr($className, -5)==='check'){
		include ROOT_PATH.'check/'.$className.'.class.php';
	}else{
		include ROOT_PATH.'public/'.$className.'.class.php';
	}
}


/*
 * Factory类用来实现单入口，这样在主目录下只有index.php一个文件。
 * Factory类已经实例化了a对应的action，在这里，直接执行action类的run方法
 * */

Factory::setAction()->run();


?>