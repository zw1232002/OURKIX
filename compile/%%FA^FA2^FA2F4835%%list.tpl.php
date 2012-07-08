<?php /* Smarty version 2.6.26, created on 2012-07-08 11:31:33
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
<script type="text/javascript">
jQuery(function ($){
	//当下拉选框变化时，筛选出对应的文章
	$("#nav_select").bind("change",function (){
		location.href="?a=article&m=index&id="+$(this).find("option:selected").val();
	});
	
	//ajax设置置顶
	$("#article_table .set_top").each(function (){
		var _this=$(this);
		_this.click(function (){
			var _top=$(this).attr("val")==0 ? "1" : "0";
			$.get('?a=article&m=ajaxTop',{top:_top,id:$(this).attr("articleid")},function (m){
				//如果操作成功，将文章列表的文字和对应的属性更改
				if(m){
					_this.attr("val")==0 ? _this.attr("val","1").html("取消置顶") : _this.attr("val","0").html("置顶");
				}
			});
		});
	});
});
</script>
</head>

<body class="mainbody">
<div class="onthispage">您当前所在位置&nbsp;&gt;&nbsp;<span>文章管理</span></div>
<div class="tablebox">
<p class='alr'><a href='?a=article&m=add'>添加文章</a></p>
<h6>请选择文章类型：<select name="nav_main" id="nav_select" pid='<?php echo $this->_tpl_vars['parentId']; ?>
' class="nav_select">
						<?php $_from = $this->_tpl_vars['mainNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
文章</option>
						<?php endforeach; endif; unset($_from); ?>
					</select></h6>
<table class="dxtable" width="100%" border="0" cellspacing="0" cellpadding="0" id="article_table">
  <thead>
      <tr>
        <td width="506">文章标题</td>
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
        <td><?php echo $this->_tpl_vars['value']->nav_name; ?>
</td>
        <td><a href="#" articleId="<?php echo $this->_tpl_vars['value']->id; ?>
" class="set_top" val="<?php echo $this->_tpl_vars['value']->top; ?>
"><?php if ($this->_tpl_vars['value']->top == 0): ?>置顶<?php else: ?>取消置顶<?php endif; ?></a></td>
        <td><?php echo $this->_tpl_vars['value']->date; ?>
</td>
        <td><a href="?a=article&m=update&id=<?php echo $this->_tpl_vars['value']->id; ?>
">编辑</a> | <a href="?a=article&m=delete&id=<?php echo $this->_tpl_vars['value']->id; ?>
"">删除</a></td>
      </tr>
      <?php endforeach; else: ?>
      <tr>
        <td colspan="5">该分类下没有文章！</td>
      </tr>
  	<?php endif; unset($_from); ?>
      
  </tbody>
</table>
</div>
</body>
</html>