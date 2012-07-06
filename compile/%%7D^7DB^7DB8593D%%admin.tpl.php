<?php /* Smarty version 2.6.26, created on 2012-07-06 15:06:37
         compiled from admin/admin.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OURKIX后台管理</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>

<body>
<div class="top">
  <h1>Urbanlook网站后台管理系统</h1>
  <ul class="topMenu">
  	<li>欢迎回来：<strong>admin</strong></li>
    <li><a href="#">退出后台</a></li>
  </ul>
</div>
<div class="content">
  <div class="pageleft">
    <ul class="navList">
      <li>
        <a href="#">导航管理</a>
        <ul>
          <li><a href="?a=nav" target="maincontent">-&nbsp;&nbsp;导航列表</a></li>
          <li><a href="?a=nav&m=add" target="maincontent">-&nbsp;&nbsp;添加导航</a></li>
        </ul>
      </li>
      <li>
        <a href="#">文章管理</a>
        <ul>
          <li><a href="?a=article" target="maincontent">-&nbsp;&nbsp;文章列表</a></li>
          <li><a href="?a=article&m=add" target="maincontent">-&nbsp;&nbsp;添加文章</a></li>
        </ul>
      </li>
      <li><a href="#" target="maincontent">News栏目管理</a></li>
      <li><a href="#" target="maincontent">News栏目管理</a></li>
      <li><a href="#" target="maincontent">News栏目管理</a></li>
    </ul>
    <h2><a href="http://www.sinocontact.com">SinoContact</a></h2>
  </div>
  <div class="pageright">
    <div class="contentBox">
      <iframe id="iframeBox" src="" name="maincontent" scrolling="auto" frameborder="0"></iframe>
    </div>
  </div>
  <div class="clear"></div>
</div>
</body>

</html>