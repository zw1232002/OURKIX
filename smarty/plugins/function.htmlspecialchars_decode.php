<?php

/*
 * smarty_function_htmlspecialchars_decode
 * 自定义的smarty插件，用来将html转义过的字符串进行反转义
 * 字符串的内容存在val属性里
 * */

function smarty_function_htmlspecialchars_decode($array){
	if(count($array)!=0 && isset($array['val'])){
		
		$content=htmlspecialchars_decode($array['val']);
		
		if($array['truncate'] && mb_strlen($content)>$array['truncate']){
			$content=mb_substr($content, 0,$array['truncate'],'utf-8').'.......';
			
		}
		
		return $content;
	}
	
	
}

?>