<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>新增文章</title>
{_include file="admin/include/css_js.tpl"_}

<script type="text/javascript" src='view/admin/js/navLinkSelect.js'></script>
<script type="text/javascript" src="view/admin/js/ckeditor/ckeditor.js"></script>
<script type="text/javascript">
jQuery(function ($){
	
	var imgPid=new Date().getTime();//当前时间，作为img的pid
	$("#img_id").val(imgPid);
	
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
		'formData'      : {'time' : imgPid},
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
		您当前所在位置&nbsp;&gt;&nbsp;<span>新增文章</span><a href="?a=article" class="back_prev">返回文章列表</a>
	</div>
	<div class="input_content">
		<form action="?a=article&m=add" method="post">
			<ul>
				<li class="clearfix"><span>文章标题：</span><input type="text" name="title" /></li>
				<li class="clearfix"><span>标签（逗号分隔）：</span><input type="text" name="tags" /></li>
				<li class="clearfix"><span>所属分类：</span> 
					<select name="parent_nav" id="main_select">
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
			</ul>
			<!-- 富文本编辑框 -->
			<p style="margin-bottom: 10px;">内容：</p>
			<textarea name="content" id="TextArea1" class="ckeditor"></textarea>
			<div class="upload_imgs clearfix">
				<h6>封面图片上传</h6>
				<div class="upload_left">
					<input id="major_pic_upload" name="fiedata" type="file" /> 
					<a href="javascript:$('#major_pic_upload').uploadify('upload','*')" class="click_btn">点击确认上传</a>
				</div>
				<div class="upload_right">
					<img src="" id="majorPic" width="100px" height="100px" />
				</div>
				<input type="hidden" id="majorPic_input_s" name="thumb_s"/>
				<input type="hidden" id="majorPic_input_b" name="thumb_b"/>
				
			</div>
			<div class="upload_imgs clearfix">
				<h6>文章内容图片上传</h6>
				<div class="upload_left">
					<input id="article_imgs_upload" name="fiedata" type="file" /> 
					<a href="javascript:$('#article_imgs_upload').uploadify('upload','*')" class="click_btn">点击确认上传</a>
				</div>
				<div class="upload_right" id="">
					<ul id="articlePics">
					</ul>
				</div>
				<input type="hidden" id="img_id" name="img_id"/>
			</div>
			<div style="text-align: center;">
				<input type="submit" value="添加" class="button" name="send"/>
			</div>
			
		</form>
	</div>
</body>
</html>