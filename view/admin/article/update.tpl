<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改导航</title>
{_include file="admin/include/css_js.tpl"_}
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
					<select name="pid" pid='{_$nav_info[0]->pid_}' id='nav_select'>
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
			<div style="text-align: center;">
				<input type="submit" value="更新" class="button" name="send"/>
			</div>
		</form>
	</div>
</body>
</html>