<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
{_include file="admin/include/css_js.tpl"_}
</head>

<body class="mainbody">
<div class="onthispage">您当前所在位置&nbsp;&gt;&nbsp;<span>导航管理</span></div>
<div class="tablebox">
<p class='alr'><a href='?a=nav&m=add'>添加导航</a></p>
<h6>导航列表</h6>
<table class="dxtable" width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
      <tr>
        <td>导航名称</td>
        <td>导航标题</td>
        <td>排序</td>
        <td>所属分类</td>
        <td>操作</td>
      </tr>
  </thead>
  <tbody>
  	{_foreach from=$allNav key=key item=value_}
  	  <tr>
        <td><a href="?a=nav&m=update&id={_$value->id_}">{_$value->nav_name_}</a></td>
        <td>{_$value->nav_title_}</td>
        <td>{_$value->sort_}</td>
        <td>{_if $value->pidName[0]->nav_name_}{_$value->pidName[0]->nav_name_}{_else_}主导航{_/if_}</td>
        <td><a href="?a=nav&m=update&id={_$value->id_}"#">编辑</a> | <a href="?a=nav&m=delete&id={_$value->id_}"">删除</a></td>
      </tr>
  	{_/foreach_}
      
  </tbody>
</table>
</div>
</body>
</html>
