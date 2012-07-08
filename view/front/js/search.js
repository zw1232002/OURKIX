(function (){
	coly.addEvent(window,"load",function (){
		var seah=coly.$("#search"),seaForm=coly.$("#searchFrom");
		if(!seah || !seaForm){
			return;
		}
		coly.addEvent(seah,"focus",function (){
			this.value="";
		});
		coly.addEvent(seah,"keyup",searchFun);
		coly.addEvent(seah,"change",function (evt){
			var _this=this;
			seaForm.submit();
		});
		function searchFun(e){
			e.preventDefault();
			var _this=this,curValue=this.value;
			setInterval(function (){
				if(_this.value===curValue || e.keyCode==13){
					seaForm.submit();
				}
				
			},3000);
			
		};
	});
})();