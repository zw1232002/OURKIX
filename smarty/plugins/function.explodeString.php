<?php

/*
 * smarty_function_explodeString
 * 和phpexplode函数功能一样，对字符串按照某个字符串分隔成数组
 * */

function smarty_function_explodeString($array){
	return explode($array['split'], $array['string']);
}

?>