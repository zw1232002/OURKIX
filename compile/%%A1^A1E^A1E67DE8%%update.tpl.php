<?php /* Smarty version 2.6.26, created on 2012-07-08 13:42:12
         compiled from admin/article/update.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>修改文章</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<script type="text/javascript" src='view/admin/js/navLinkSelect.js'></script>
<script type="text/javascript" src="view/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
jQuery(function ($){
	
	//var imgPid=new Date().getTime();//当前时间，作为img的pid
	//$("#img_id").val(imgPid);
	
	//上传图片时，右上角的删除按钮js
	function delImgs(){
		var allCloseBtns = $(".close_light");
		$.each(allCloseBtns,function() {
			$(this).bind("mouseover",function() {
				$(this).css("background-position", "right top");
			});
			$(this).bind("mouseout",function() {
				$(this).css("background-position", "left top");
			});
			$(this).bind("click",function() {
				//先AJAX删除
				var _this=$(this);
				$.ajax({
					url: '?a=uploadImgs&m=delImgs',
					data: {
						"id": _this.attr("picId")
					},
					type: 'get',
					success: function(data) {
						data ? _this.parents("li").remove() : alert("删除失败！");
					},
					error: function(data) {
							alert("ajax请求失败,请重试")
					}
				});
				
			});
		});
	}
	
	
	//上传封面图片
	$("#major_pic_upload").uploadify({
		'width'         : 120,
		'height'        : 30,
		'removeTimeout' : 0.1,
		'swf'           : 'view/admin/uploadify/uploadify.swf',
		'uploader'      : '?a=call&m=upload',
		'auto'          : false,
        'multi'         : false,
        'onUploadSuccess' : function(file, data, response) {
        	//返回的是json格式，先解析一下
        	var parseData=jQuery.parseJSON(data);
        	
           $("#majorPic").attr('src',parseData.small);//返回小图的地址
           $("#majorPic_input_s").val(parseData.small);
           
           $("#majorPic_input_b").val(parseData.big);//大图地址
           
        }
		
	});
	
	/*上传内容图片
	*imgPid传递一个时间戳，作为pid，利用了这个插件只在第一次载入页面设置值的特点，
	*这样上传多个图片时，虽然多次提交了，但是页面只加载一次，时间戳就是一个
	*/
	$('#article_imgs_upload').uploadify({
		'width'         : 120,
		'height'        : 30,
		'removeTimeout' : 0.1,
		'formData'      : {'time' : <?php echo $this->_tpl_vars['articleInfo'][0]->img_id; ?>
},
		'swf'           : 'view/admin/uploadify/uploadify.swf',
		'uploader'      : '?a=uploadImgs&m=upload',
		'auto'          : false,
        'multi'         : true,
        'onUploadStart' : function(file) {
        	$('#article_imgs_upload').uploadify('settings','articleType','2');
            //$("#article_imgs_upload").uploadify("settings", "articleType", $("#main_select option:selected").val());
        },
        'onUploadSuccess' : function(file, data, response) {
        	data=jQuery.parseJSON(data);
			$("#articlePics").append("<li style='width:100px;height:100px;'><a target='_blank' href='?a=editImgs&id="+data.id+"'><img  src='" + data.src_small + "' width='100px' height='100px'/></a><em class='close_light' style='right:-4px;top:-2px;' picId='"+data.id+"'></em></li>");
			delImgs();
        }
	});

	//删除按钮
	delImgs();
});
</script>
</head>

<body class="mainbody">
	<div class="onthispage clearfix">
		您当前所在位置&nbsp;&gt;&nbsp;<span>修改文章</span><a href="?a=article" class="back_prev">返回文章列表</a>
	</div>
	<div class="input_content">
		<form action="?a=article&m=update" method="post">
			<ul>
				<li class="clearfix"><span>文章标题：</span><input type="text" name="title" value="<?php echo $this->_tpl_vars['articleInfo'][0]->title; ?>
"/></li>
				<li class="clearfix"><span>标签（逗号分隔）：</span><input type="text" name="tags" value="<?php echo $this->_tpl_vars['articleInfo'][0]->tags; ?>
"/></li>
				<li class="clearfix"><span>所属分类：</span> 
					<select name="parent_nav" id="main_select" class="nav_select" pid="<?php echo $this->_tpl_vars['articleInfo'][0]->parent_nav; ?>
">
						<?php $_from = $this->_tpl_vars['mainNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
							<option value="<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
</option>
						<?php endforeach; endif; unset($_from); ?>
					</select>
					<select name="nav" class="nav_list2" id="child_select" class="nav_select" pid="<?php echo $this->_tpl_vars['articleInfo'][0]->nav; ?>
">
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
				<textarea name="info"><?php echo $this->_tpl_vars['articleInfo'][0]->info; ?>
</textarea></li>
			</ul>
			<!-- 富文本编辑框 -->
			<p style="margin-bottom: 10px;">内容：</p>
			<textarea name="content" id="TextArea1" class="ckeditor"><?php echo $this->_tpl_vars['articleInfo'][0]->content; ?>
</textarea>
			<div class="upload_imgs clearfix">
				<h6>封面图片上传</h6>
				<div class="upload_left">
					<input id="major_pic_upload" name="fiedata" type="file" /> 
					<a href="javascript:$('#major_pic_upload').uploadify('upload','*')" class="click_btn">点击确认上传</a>
				</div>
				<div class="upload_right">
					<img src="<?php echo $this->_tpl_vars['articleInfo'][0]->thumb_s; ?>
" id="majorPic" width="100px" height="100px" />
				</div>
				<input type="hidden" id="majorPic_input_s" name="thumb_s" value="<?php echo $this->_tpl_vars['articleInfo'][0]->thumb_s; ?>
"/>
				<input type="hidden" id="majorPic_input_b" name="thumb_b" value="<?php echo $this->_tpl_vars['articleInfo'][0]->thumb_b; ?>
"/>
				
			</div>
			<div class="upload_imgs clearfix">
				<h6>文章内容图片上传</h6>
				<div class="upload_left">
					<input id="article_imgs_upload" name="fiedata" type="file" /> 
					<a href="javascript:$('#article_imgs_upload').uploadify('upload','*')" class="click_btn">点击确认上传</a>
				</div>
				<div class="upload_right" id="">
					<ul id="articlePics">
					<?php $_from = $this->_tpl_vars['articleInfo']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
						<li style="width: 100px; height: 100px;"><a href="?a=editImgs&id=<?php echo $this->_tpl_vars['value']->pic_id; ?>
" target="_blank"><img width="100px" height="100px" src="<?php echo $this->_tpl_vars['value']->src_small; ?>
"></a><em picid="<?php echo $this->_tpl_vars['value']->pic_id; ?>
" style="right: -4px; top: -2px;" class="close_light"></em></li>
					<?php endforeach; endif; unset($_from); ?>
					</ul>
				</div>
				<input type="hidden" id="img_id" name="img_id" value="<?php echo $this->_tpl_vars['articleInfo'][0]->img_id; ?>
"/>
			</div>
			<div style="text-align: center;">
				<input type="submit" value="更新" class="button" name="send"/>
			</div>
			<input type="hidden" name="id" value="<?php echo $this->_tpl_vars['articleInfo'][0]->id; ?>
"/>
		</form>
	</div>
</body>
</html>