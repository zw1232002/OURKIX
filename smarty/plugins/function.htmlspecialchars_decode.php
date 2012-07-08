<?php

/*
 * smarty_function_htmlspecialchars_decode
 * 自定义的smarty插件，用来将html转义过的字符串进行反转义
 * 字符串的内容存在val属性里
 * */

function smarty_function_htmlspecialchars_decode($array){
	return htmlspecialchars_decode($array['val']);
}

?>