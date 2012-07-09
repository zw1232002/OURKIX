<?php

/*
 * smarty_function_explodeString
 * 和phpexplode函数功能一样，对字符串按照某个字符串分隔成数组
 * */

function smarty_function_explodeString($array){
	
	if(count($array)>0 && isset($array['string']) && isset($array['split'])){
		
		$explodeArray=explode($array['split'], $array['string']);
		
		if($array['joinLeft'] && $array['joinRight']){
			foreach ($explodeArray as $key=>$value){
				$explodeArray[$key]=$array['joinLeft'].$value.$array['joinRight'];
			}
			return implode(',', $explodeArray);
		}
		return $explodeArray;
	}
	
}

?>