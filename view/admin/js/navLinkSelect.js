jQuery(function ($){
	
	//
	var mainSelect=$("#main_select"),childSelect=$("#child_select");
	ajaxSetChildNav();
	
	//通过ajax设置主导航和二级导航的联动
	mainSelect.bind('change',function (){
		ajaxSetChildNav();
	});
	
	function ajaxSetChildNav(){
		$.ajax({
			   type: "POST",
			   url: "?a=nav&m=ajaxChildNav",
			   data: "id="+mainSelect.find("option:selected").val(),
			   success: function(msg){
				 childSelect.html("");
				 var objs=jQuery.parseJSON(msg);
				 if(objs==''){
					 childSelect.append("<option value="+mainSelect.find("option:selected").val()+">"+mainSelect.find("option:selected").html()+"</option>");
				 }else{
					 for(var i=0,l=objs.length;i<l;i++){
				    	 childSelect.append("<option value="+objs[i].id+">"+objs[i].nav_name+"</option>");
				     }
				 }
			     
			     
			   }
			});
	}
});