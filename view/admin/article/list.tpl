<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
{_include file="admin/include/css_js.tpl"_}
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
<h6>请选择文章类型：<select name="nav_main" id="nav_select" pid='{_$parentId_}'>
						{_foreach from=$mainNav key=key item=value_}
							<option value="{_$value->id_}">{_$value->nav_name_}文章</option>
						{_/foreach_}
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
  	{_foreach from=$allArtice key=key item=value_}
  	  <tr>
        <td><a href="?a=article&m=update&id={_$value->id_}">{_$value->title_}</a></td>
        <td>{_$value->nav_name_}</td>
        <td><a href="#" articleId="{_$value->id_}" class="set_top" val="{_$value->top_}">{_if $value->top==0_}置顶{_else_}取消置顶{_/if_}</a></td>
        <td>{_$value->date_}</td>
        <td><a href="?a=article&m=update&id={_$value->id_}">编辑</a> | <a href="?a=article&m=delete&id={_$value->id_}"">删除</a></td>
      </tr>
      {_foreachelse_}
      <tr>
        <td colspan="5">该分类下没有文章！</td>
      </tr>
  	{_/foreach_}
      
  </tbody>
</table>
</div>
</body>
</html>
