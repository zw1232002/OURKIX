<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增文章</title>
{_include file="admin/include/css_js.tpl"_}
<script type="text/javascript" src='view/admin/js/navLinkSelect.js'></script>
</head>

<body class="mainbody">
	<div class="onthispage clearfix">
		您当前所在位置&nbsp;&gt;&nbsp;<span>新增文章</span><a href="?a=article" class="back_prev">返回文章列表</a>
	</div>
	<div class="input_content">
		<form action="?a=article&m=add" method="post">
			<ul>
				<li class="clearfix"><span>文章标题：</span><input type="text" name="title" /></li>
				<li class="clearfix"><span>标签（逗号分隔）：</span><input type="text" name="tags" /></li>
				<li class="clearfix"><span>所属分类：</span> 
					<select name="nav_main" id="main_select">
						{_foreach from=$mainNav key=key item=value_}
							<option value="{_$value->id_}">{_$value->nav_name_}</option>
						{_/foreach_}
					</select>
					<select name="nav" class="nav_list2" id="child_select">
						{_foreach from=$mainNav key=key item=value_}
							<option value="{_$value->id_}">{_$value->nav_name_}</option>
						{_/foreach_}
					</select>
				</li>
				<li class="clearfix"><span> 摘要：</span>
				<textarea name="info"></textarea></li>
				<li class="clearfix"><span> 内容：</span>
				<textarea name="content"></textarea></li>
			</ul>
			<div style="text-align: center;">
				<input type="submit" value="添加" class="button" name="send"/>
			</div>
		</form>
	</div>
</body>
</html>