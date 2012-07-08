<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改图片信息</title>
{_include file="admin/include/css_js.tpl"_}

<script type="text/javascript" src='view/admin/js/navLinkSelect.js'></script>
<script type="text/javascript" src="view/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
jQuery(function ($){
	
});
</script>
</head>

<body class="mainbody">
	<div class="onthispage clearfix">
		您当前所在位置&nbsp;&gt;&nbsp;<span>修改图片信息</span><a href="?a=article" class="back_prev">返回文章列表</a>
	</div>
	<div class="input_content">
		<form action="?a=editImgs" method="post">
			<img src="{_$imgsInfo[0]->src_big_}" id="majorPic" />
			<!-- 富文本编辑框 -->
			<p style="margin-bottom: 10px;">内容：</p>
			<textarea name="content" id="TextArea1" class="ckeditor">{_$imgsInfo[0]->content_}</textarea>
			<input type="hidden" value="{_$imgsInfo[0]->id_}" name="id"/>
			<div style="text-align: center;">
				<input type="submit" value="添加" class="button" name="send"/>
			</div>
			
		</form>
	</div>
</body>
</html>