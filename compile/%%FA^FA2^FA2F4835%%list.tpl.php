<?php /* Smarty version 2.6.26, created on 2012-07-06 01:29:40
         compiled from admin/article/list.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
  	<?php $_from = $this->_tpl_vars['allArtice']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
  	  <tr>
        <td><a href="?a=article&m=update&id=<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->title; ?>
</a></td>
        <td><?php echo $this->_tpl_vars['value']->nav; ?>
</td>
        <td><a href="?a=article&m=top&id=<?php echo $this->_tpl_vars['value']->id; ?>
">置顶</a></td>
        <td><?php echo $this->_tpl_vars['value']->date; ?>
</td>
        <td><a href="?a=article&m=update&id=<?php echo $this->_tpl_vars['value']->id; ?>
">编辑</a> | <a href="?a=article&m=delete&id=<?php echo $this->_tpl_vars['value']->id; ?>
"">删除</a></td>
      </tr>
  	<?php endforeach; endif; unset($_from); ?>
      
  </tbody>
</table>
</div>
</body>
</html>