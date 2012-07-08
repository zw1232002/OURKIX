<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改导航</title>
{_include file="admin/include/css_js.tpl"_}
<script type="text/javascript">
jQuery(function (){
	//上传封面图片
	$("#major_pic_upload").uploadify({
		'width'         : 120,
		'height'        : 30,
		'removeTimeout' : 0.1,
		'swf'           : 'view/admin/uploadify/uploadify.swf',
		'uploader'      : '?a=call&m=upload',
		'auto'          : false,
        'multi'         : false,
        'onUploadSuccess' : function(file, data, response) {
        	//返回的是json格式，先解析一下
        	var parseData=jQuery.parseJSON(data);
        	
           $("#majorPic").attr('src',parseData.small);//返回小图的地址
           $("#majorPic_input_s").val(parseData.small);
           
           //$("#majorPic_input_b").val(parseData.big);//大图地址
           
        }
		
	});
});
</script>
</head>

<body class="mainbody">
	<div class="onthispage clearfix">
		您当前所在位置&nbsp;&gt;&nbsp;<span>修改导航</span><a href="{_$prevPage_}" class="back_prev">返回</a>
	</div>
	<div class="input_content">
		<form action="?a=nav&m=update" method="post">
			<ul>
				<li class="clearfix"><span>导航名称：</span><input type="text" name="nav_name" value='{_$nav_info[0]->nav_name_}'/></li>
				<li class="clearfix"><span>导航标题：</span><input type="text" name="nav_title" value='{_$nav_info[0]->nav_title_}'/></li>
				<li class="clearfix"><span>导航顺序：</span><input type="text" name="sort" value='{_$nav_info[0]->sort_}'/></li>
				<li class="clearfix"><span>导航类型：</span> 
					<select name="pid" pid='{_$nav_info[0]->pid_}' id='nav_select' class="nav_select">
							<option value="0">主导航</option>
						{_foreach from=$mainNav key=key item=value_}
							<option value="{_$value->id_}">{_$value->nav_name_}</option>
						{_/foreach_}
					</select>
				</li>
				<li class="clearfix"><span> 介绍：</span>
				<textarea name="nav_info">{_$nav_info[0]->nav_info_}</textarea></li>
				<input type="hidden" value='{_$nav_info[0]->id_}' name='id'/>
			</ul>
			<div class="upload_imgs clearfix">
				<h6>封面图片上传</h6>
				<div class="upload_left">
					<input id="major_pic_upload" name="fiedata" type="file" /> 
					<a href="javascript:$('#major_pic_upload').uploadify('upload','*')" class="click_btn">点击确认上传</a>
				</div>
				<div class="upload_right">
					<img src="{_$nav_info[0]->thumb_}" id="majorPic" width="100px" height="100px" />
				</div>
				<input type="hidden" id="majorPic_input_s" name="thumb"/>
				
			</div>
			<div style="text-align: center;">
				<input type="submit" value="更新" class="button" name="send"/>
			</div>
		</form>
	</div>
</body>
</html>