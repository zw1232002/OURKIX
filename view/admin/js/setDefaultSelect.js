jQuery(function ($){
	$(".nav_select option").each(function (){
		if($(this).val()===$(this).parent().attr("pid")){
			$(this).attr("selected","selected");
		}
	});
});