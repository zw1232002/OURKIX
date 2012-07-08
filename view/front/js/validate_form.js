(function (){
	coly.addEvent(window,"load",page);
	function page(){
		/*这段js是验证注册的*/
		var regForm=coly.$("#regist"),formLi=coly.$("Li",regForm),val={},hD=document.createElement("input");coly.count=0,showFlag=true,invBtn=coly.$("#inv_btn"),invaTation=coly.$("#show_inv");
		coly.addEvent(invBtn,"click",function (){
			if(showFlag){
				invaTation.css("display","block");
				showFlag=false;
			}else{
				invaTation.css("display","none");
				showFlag=true;
			}
		});
		if(regForm){
			hD.setAttribute("type","hidden");
			hD.setAttribute("id","hidden");
			document.body.appendChild(hD);
			function validate(){
				coly.each(formLi,function (){
					var _this=this,f_input=coly.$("input",this)[0],showAttention=coly.$(".show_attention",this)[0],atten=coly.$(".attention",showAttention)[0],err=coly.$(".error",showAttention)[0],classArray=["e_mail","userName","password","re_passwd","invitation"],sta1=coly.$(".sta1",showAttention)[0],sta2=coly.$(".sta2",showAttention)[0],pass_strong=coly.$(".pass_strong",showAttention)[0],pwL=coly.$(".pwLev",pass_strong)[0];
					coly.addEvent(f_input,"keydown",function (){
						_this.addClass("hover");
						coly.each(atten.siblings(),function (){coly.$(this).css("display","none");});
						atten.css("display","block");
					});
					coly.addEvent(regForm,"submit",function (evt){
						if(coly.count<3){
							evt.preventDefault();
						}else{
							return true;
						}
					});
					coly.addEvent(f_input,"blur",function (){
						_this.delClass("hover");
						var $this=this;
						coly.each(classArray,function (i){
							if(new RegExp(classArray[i],"g").test(_this.className)){				
								switch(i){
									case 0:var sta=vEmail($this.value);
												if(sta==0){coly.count++}
												//因为设定sta=0,是正确的，所以在已经验证正确的情况下才ajax
												if(!sta){
													$.ajax({
														url : 'checkEmail',
														data : {
															"eMail":$this.value
														},
														type : 'post',
														success : function(data) {
															var sta=vEmail($this.value,data.emailBool);
															showStatus(sta,sta1,sta2,_this);
														}
													});
												}else{
													showStatus(sta,sta1,sta2,_this);
												}
									break;
									case 1:
												var sta=vUser($this.value);
												if(sta==0){coly.count++}
												//因为设定sta=0,是正确的，所以在已经验证正确的情况下才ajax
												if(!sta){
													$.ajax({
														url : 'checkUserName',
														data : {
															username:$this.value
														},
														type : 'post',
														success : function(data) {
															var sta=vUser($this.value,data.nameBool);
															showStatus(sta,sta1,sta2,_this);
														}
													});
												}else{
													showStatus(sta,sta1,sta2,_this);
												}
									break;
									case 2:var sta=vPass($this.value);val.v=$this.value;
												if(sta==0){coly.count++}
												showStatus(sta,sta1,sta2,_this);
									break;
									case 3:var sta=vPass(val.v,$this.value);
												if(sta==0){coly.count++}
												showStatus(sta,sta1,sta2,_this);
									break;
									case 4:$.ajax({
													url : 'checkInvateCode',
													data : {
														"invateCode":$this.value
													},
													type : 'post',
													success : function(data) {
														var sta;
														//alert(data.invateInvail);
														if(data.invateInvail.toString()=="true"){
															sta=0;
														}else{
															sta=2;
														}
														if(sta==0){coly.count++}
														showStatus(sta,sta1,sta2,_this);
													}
												});
								};
							}
						});
					});
					coly.each(classArray,function (i){
						if(new RegExp(classArray[i],"g").test(_this.className)){				
						switch(i){
							case 0:
								coly.addEvent(f_input,"keydown",function (){
									if(this.value.length>=25){
										this.value=this.value.slice(0,24);
									}
								});
							break;
							case 1:
								coly.addEvent(f_input,"keydown",function (){
									if(this.value.length>=20){
										this.value=this.value.slice(0,19);
									}
								});
							break;
							case 2:
								coly.addEvent(f_input,"focus",function (){
									_this.addClass("hover");
									coly.each(atten.siblings(),function (){coly.$(this).css("display","none");});
									atten.css("display","block");
								});
								coly.addEvent(f_input,"keydown",function (){
									if(this.value.length>=20){
										this.value=this.value.slice(0,19);
									}
									var pw= this.value,level;
									atten.css("display","none");
									pass_strong && pass_strong.css("display","block");
									 level=pwLevel(pw);
									switch(level){
										case 0:pwL.css({
														"background-position":"left center"
													});
										break;
										case 1:pwL.css({
														"background-position":"left center"
													});
										break;
										case 2:pwL.css({
														"background-position":"-80px center"
													});
										break;
										case 3:pwL.css({
														"background-position":"-80px center"
													});
										break;
										case 4:pwL.css({
														"background-position":"right center"
													});
										break;
									};
								
								});
							break;
							case 3:
								coly.addEvent(f_input,"keydown",function (){
									if(this.value.length>=20){
										this.value=this.value.slice(0,19);
									}
								});
							break;
						};
					}
					});
				});
			};
			validate();
			function pwLevel(v){
				var modes = 0;
				 if (v.length < 6) return modes;
				 if (/\d/.test(v)) modes++; //数字
				 if (/[a-z]/.test(v)) modes++; //小写
				 if (/[A-Z]/.test(v)) modes++; //大写  
				 if (/\W/.test(v)) modes++; //特殊字符
				  switch (modes)
					 {
					  case 1:
					   return 1;
					   break;
					  case 2:
					   return 2;
					  case 3:
					  return 3;
					  case 4:
					   return v.length < 12 ? 3 : 4
					   break;
					 }
			};
			function showStatus(sta,sta1,sta2,o){
				switch(sta){
					case 0:return;
					break;
					case 1:
						if(sta1 && o){
							sta1.css("display","block");
							o.addClass("hover");
							coly.each(sta1.siblings(),function (){coly.$(this).css("display","none");})
						};
					break;
					case 2:
						if(sta2&& o){
							sta2.css("display","block");
							o.addClass("hover");
							coly.each(sta2.siblings(),function (){coly.$(this).css("display","none");});
						};
					break;
				};
			};
			function vEmail(v,bol){
				/*
				返回状态码 
				0表示所有验证通过
				1表示格式正确但是已被注册
				2表示邮箱格式不合法或为空
				*/
				if(bol!=undefined){
					if(bol.toString()=="false"){
						return 1;
					}else{
						return 0;
					}
				}
				if(!(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i.test(v)) || v.length <6  || v.length >25){
					return 2;
				}else{
					return 0;
				}
			};
			function vUser(username,bol) {
				if(bol!=undefined){
					if(bol.toString()=="false"){
						return 1;
					}else{
						return 0;
					}
				}
				 if(username.gbLen() < 4 || username.gbLen() > 20 || !(/^([\u4E00-\uFA29]|[\uE7C7-\uE7F3]|[a-zA-Z0-9])*$/i.test(username))) {
				 	return 2;
				 }else{
				 	return 0;
				 }
			}
			function vPass(password, password2) {
					if(arguments.length==1){
						if(password.length < 6 || password.length > 20 || !(/^[\w@!#$%^&*~`]+$/i.test(password))) {
							return 2;
						}else{
							return 0;
						}
					}else{
						if (!password2) {
						    return 2;
						} else{
							if (!password || password2!==password) {
							    return 1;
							} else {
							    return 0;
							}
						}
					}
			}
		}
		/*结束验证注册js*/
		
		/*开始登录js*/
		var loginDiv=coly.$(".reg_content")[0],inputWrap=coly.$(".text",loginDiv),loginBtn=coly.$("#login_btn",loginDiv) ?coly.$("#login_btn",loginDiv) :coly.$("#regist_btn",loginDiv);
		if(loginDiv &&loginBtn && inputWrap){
			coly.addEvent(loginBtn,"mouseover",function (){
				this.css("background-position","-417px -245px");
			});
			coly.addEvent(loginBtn,"mouseout",function (){
				this.css("background-position","-417px -200px");
			});
			function focusFunc(emilCon,passCon){
				var orialText=coly.$(".orial",this.parentNode)[0];
				orialText.css("display","none");
				this.parentNode.css({
					"background-position":"-297px 0"
				});
				coly.emilCon && coly.emilCon.css({
					"background-position":"0px -130px"
				});
				coly.passCon && coly.passCon.css({
					"background-position":"0px -233px"
				});
			};
			function blurFunc(emilCon,passCon){
				var orialText=coly.$(".orial",this.parentNode)[0];
				if(!this.value){
					orialText.css("display","inline");
				}
				this.parentNode.css({
					"background-position":"-297px -52px"
				});
				coly.emilCon && coly.emilCon.css({
					"background-position":"0px -180px"
				});
				coly.passCon && coly.passCon.css({
					"background-position":"0px -283px"
				});
			};
			coly.each(inputWrap,function (){
				if(/^input$/gi.test(this.tagName)){
					var emilCon=coly.$(".icon_e_mail",this.parentNode)[0],passCon=coly.$(".icon_pass",this.parentNode)[0],_this=this;
					coly.emilCon=emilCon;coly.passCon=passCon;
					if(/e_mail/gi.test(this.parentNode.className)){
						this.focus();
						coly.$(this.parentNode).css({
							"background-position":"-297px 0"
						});
						emilCon && emilCon.css({
							"background-position":"0px -130px"
						});
					}
					coly.addEvent(this.parentNode,"click",function (){
						_this.focus();
						var orialText=coly.$(".orial",this)[0];
						orialText.css("display","none");
						coly.$(this).css({
							"background-position":"-297px 0"
						});
						coly.emilCon && coly.emilCon.css({
							"background-position":"0px -130px"
						});
						coly.passCon && coly.passCon.css({
							"background-position":"0px -233px"
						});
					});
					coly.addEvent(this,"focus",focusFunc);
					coly.addEvent(this,"blur",blurFunc);
					coly.addEvent(this,"keydown",focusFunc);
				}
			});
			coly.emilCon=coly.passCon=null;
		}
		/*结束登录js*/
	};
	
})();