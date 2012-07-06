<?php /* Smarty version 2.6.26, created on 2012-07-06 22:47:15
         compiled from admin/article/add.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增文章</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src='view/admin/js/navLinkSelect.js'></script>
<script type="text/javascript" src="view/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
jQuery(function ($){
	$("#major_pic_upload").uploadify({
		'auto'          :false,
		'width'         : 120,
		'height'        : 30,
		'script'        : '?a=article&m=add',
		'uploader'      : 'view/admin/uploadify/uploadify.swf',
		'cancelImg'     : 'view/admin/uploadify/uploadify-cancel.png',
        'folder'        : 'uploads',
        'auto'          : false,
        'multi'         : false,
        onComplete : function(event, queueID, fileObj, response, data) {//成功的话把图片路径返回,以便在页面上显示
            //alert(response);
            //$('#majorPic').attr("src", response);
            //$('#picUrl').val(response);
        }
	});
});
</script>
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
					<select name="parent_nav" id="main_select">
						<?php $_from = $this->_tpl_vars['mainNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
					<select name="nav" class="nav_list2" id="child_select">
						<?php $_from = $this->_tpl_vars['mainNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
				</li>
				<li class="clearfix"><span> 摘要：</span>
				<textarea name="info"></textarea></li>
			</ul>
			<!-- 富文本编辑框 -->
			<p style="margin-bottom: 10px;">内容：</p>
			<textarea name="content" id="TextArea1" class="ckeditor"></textarea>
			<div class="upload_imgs clearfix">
				<h6>封面图片上传</h6>
				<div class="upload_left">
					<input id="major_pic_upload" name="thumb" type="file" /> 
					<a href="javascript:$('#major_pic_upload').uploadifyUpload();" class="click_btn">点击确认上传</a>
				</div>
				<div class="upload_right">
					<img src="<?php echo $this->_tpl_vars['path']; ?>
" id="majorPic" width="100px" height="100px" />
				</div>
	
			</div>
			<div style="text-align: center;">
				<input type="submit" value="添加" class="button" name="send"/>
			</div>
		</form>
	</div>
</body>
</html>