<?php /* Smarty version 2.6.26, created on 2012-07-05 17:04:42
         compiled from admin//nav/add.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增导航</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</head>

<body class="mainbody">
	<div class="onthispage clearfix">
		您当前所在位置&nbsp;&gt;&nbsp;<span>添加导航</span><a href="?a=nav&m=index" class="back_prev">返回导航列表</a>
	</div>
	<div class="input_content">
		<form action="?a=nav&m=add" method="post">
			<ul>
				<li class="clearfix"><span>导航名称：</span><input type="text" name="nav_name" /></li>
				<li class="clearfix"><span>导航标题：</span><input type="text" name="nav_title" /></li>
				<li class="clearfix"><span>导航顺序：</span><input type="text" name="sort" /></li>
				<li class="clearfix"><span>导航类型：</span> 
					<select name="pid">
							<option value="0">主导航</option>
						<?php $_from = $this->_tpl_vars['mainNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</li>
				<li class="clearfix"><span> 介绍：</span>
				<textarea name="nav_info"></textarea></li>
			</ul>
			<div style="text-align: center;">
				<input type="submit" value="添加" class="button" name="send"/>
			</div>
		</form>
	</div>
</body>
</html>