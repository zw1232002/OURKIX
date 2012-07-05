<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
{_include file="admin/include/css_js.tpl"_}
</head>

<body class="mainbody">
<div class="onthispage">您当前所在位置&nbsp;&gt;&nbsp;<span>文章管理</span></div>
<div class="tablebox">
<p class='alr'><a href='?a=article&m=add'>添加文章</a></p>
<h6>文章列表</h6>
<table class="dxtable" width="100%" border="0" cellspacing="0" cellpadding="0">
  <thead>
      <tr>
        <td>文章标题</td>
        <td>所属分类</td>
        <td>是否置顶</td>
        <td>发布时间</td>
        <td>操作</td>
      </tr>
  </thead>
  <tbody>
  	{_foreach from=$allArtice key=key item=value_}
  	  <tr>
        <td><a href="?a=article&m=update&id={_$value->id_}">{_$value->title_}</a></td>
        <td>{_$value->nav_}</td>
        <td><a href="?a=article&m=top&id={_$value->id_}">置顶</a></td>
        <td>{_$value->date_}</td>
        <td><a href="?a=article&m=update&id={_$value->id_}">编辑</a> | <a href="?a=article&m=delete&id={_$value->id_}"">删除</a></td>
      </tr>
  	{_/foreach_}
      
  </tbody>
</table>
</div>
</body>
</html>
