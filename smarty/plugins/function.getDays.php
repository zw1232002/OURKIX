<?php

/*
 * smarty_function_getDay
 * 返回当前时间距离给出时间的天数
 * 字符串的内容存在val属性里
 * */

function smarty_function_getDays($array){
	$gap=time()-strtotime($array['date']);
	return date('m',$gap)-1>=1 ? (date('m',$gap)-1)*30+date('d',$gap)-1 :date('d',$gap)-1 ; 
}

?>