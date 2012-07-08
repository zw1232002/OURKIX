(function (){
	coly.addEvent(window,"load",init);
	function init(){
		/*开始投票*/
		var voteContain=coly.$("#vote_container"),voteAll=coly.$("li",voteContain),vote=voteAll[0],trueVote=[],numArray=[10,10,30,40,10],perCount=[10,15,20,10,25],checkMax=[];
		voteAll[0].addClass("show_ques");
		if(!voteContain || !vote){
			return;
		}
		coly.each(voteAll,function (){
			if(this.parentNode===voteContain && parseInt(this.getAttribute("qustype"))===1){
				var limit=coly.$(".slect_limit",this)[0];
				checkMax.push(parseInt(limit.innerHTML));
				trueVote.push(this);
			}
		});
		coly.each(trueVote,function (i){
			this.eq=i;
		});
		function voteFunc(){
			if(this.parentNode===voteContain && coly.$(this).hasClass("show_ques")){
				var voteDiv=this,otherInput=coly.$(".other_select",voteDiv)[0],voteBtn=coly.$(".to_vote",voteDiv)[0],nextBtn=coly.$(".next_ques",voteDiv)[0],sumWrap=coly.$(".sum",voteDiv),voteUser=coly.$(".vote_user",voteDiv),voteCount=coly.$(".vote_count",voteDiv),
				per_count=coly.$(".per_count",voteDiv),voteRadio=coly.$(".radio",voteDiv),selectFlag=0,voteFlag=false,clickFlag=false,sumPerCount=coly.$(".count_btn",voteDiv)[0];
				function setRadio(){
					var _this=this;
					if(this.type==="textarea"){
						var textFlag=0;
						coly.addEvent(this,"keydown",function (){
							if(this.value==="请输入内容："){
								this.value="";
							}
							textFlag=1;
							validateSelect(textFlag);
						});
					}else{
						coly.$(this.parentNode.parentNode.parentNode).addClass("roll_select");
						if(this.type==="checkbox" && this.checked===false){
							coly.$(this.parentNode.parentNode.parentNode).delClass("roll_select");
							if(this.hasClass("other_flg")){
								var otherInput=coly.$(".other_select",this.parentNode.parentNode)[0];
								otherInput.css("display","none");
								otherInput.css("color","#bbb");
								otherInput.value="请输入内容:";
							}
						}
						if(this.type==="radio"){
							this.checked=true;
						}
						coly.each(coly.$(this.parentNode.parentNode.parentNode).siblings(),function (){
							if(_this.type==="radio"){
								coly.$(this).delClass("roll_select");
							}else if(_this.type==="checkbox" && _this.checked===true){
								return;
							}
							if(coly.$(".other_flg",this)[0] && coly.$(".other_flg",this)[0].hasClass("other_flg")){
								var otherInput=coly.$(".other_select",this)[0];
								if(otherInput && coly.$(voteDiv).hasClass("show_ques") && coly.$(".other_flg",this)[0].type==="radio"){
									otherInput.css("display","none");
									otherInput.css("color","#bbb");
									otherInput.value="请输入内容:";
								}
							}
						});
						if(this.hasClass("other_flg")){
							var otherInput=coly.$(".other_select",this.parentNode.parentNode)[0];coly.otherInput=otherInput;
							if(otherInput && coly.$(this.parentNode.parentNode.parentNode).hasClass("roll_select")){
								otherInput.css("display","block");
								otherInput.focus();
								coly.addEvent(otherInput,"keydown",function (){
									if(this.value==="请输入内容:"){
										this.value="";
									}
									this.css("color","#fff");
								});
							}
						}
						validateSelect();
					}
				};
				function validateSelect(textFlag){
					var selectLen=coly.$(".roll_select",voteDiv).length;
					if(selectLen>0 || textFlag){
						selectFlag=1;
					}else{
						selectFlag=0;
					}
					if(nextBtn && selectFlag===1 && !voteFlag){
						voteDiv.next() && nextBtn.delClass("grey");
						voteBtn.delClass("grey");
					}
					if(nextBtn && selectFlag===0){
						voteBtn.addClass("grey");
						nextBtn.addClass("grey");
					}
					window.selectLen=selectLen;
				};
				function showCount(num){
					if(num){
						num+=0;
						//根据百分比来计算并显示，其中323是原来的总长度
						if(num>100){
							num=100;
						}
						if(num<=0){
							num=0;
						}
						num=num/100*323;
						var _this=this;
						setTimeout(function (){
							coly.$(_this).animate({"width":0},{"width":num},1200,"",coly.tween.Quad.easeOut);
						},320);
						
					}
				};
				coly.addEvent(sumPerCount,"click",function (){//alert(selectFlag+"\n"+voteFlag);
					if(selectFlag===1 && voteFlag){
						/*开始判断登陆*/
						$.ajax({
							url : 'isLogin',
							dataType : 'json',
							data : {
							},
							type : 'post',
							success : function(data) {
								if(data.isLogin=='false' || data.isLogin == false){
									alert('登录后方可查看投票详情');
									return;}else{
									coly.each(voteUser,function (){
							if(coly.$(this).css("visibility")==="hidden"){
								coly.$(this).css("display","block");
								var curHeight=this.offsetHeight,showDiv=coly.$(".show_sum",this)[0],curHtml=this.innerHTML,_this=this;
								if(curHtml.length> 195){
									this.innerHTML=curHtml.slice(0,195);
									this.innerHTML+="........<a href='javascript:void(0);' class='person_count show_more'>查看更多</a>";
								}
								var handleHeight=this.offsetHeight,showMore,hiddenAll;
								coly.$(this).css("height","0px");
								coly.$(this).css("visibility","visible");
								this.animate({"height":0},{"height":handleHeight},500,"",coly.tween.Cubic.easeInOut);
								setInterval(function (){
									if(showMore=coly.$(".show_more",_this)[0]){
										coly.addEvent(showMore,"click",function (){
											_this.animate({"height":handleHeight},{"height":curHeight-handleHeight},500,"",coly.tween.Cubic.easeInOut);
											_this.innerHTML=curHtml;
											_this.innerHTML+="<a href='javascript:void(0);' class='person_count hidden_all'>收起全部</a>";
										});
									}else{
										return;
									}
								},600);
								setInterval(function (){
									if(hiddenAll=coly.$(".hidden_all",_this)[0]){
										coly.addEvent(hiddenAll,"click",function (){
											_this.animate({"height":curHeight},{"height":handleHeight-curHeight},500,function (){
												_this.innerHTML=curHtml.slice(0,195);
												_this.innerHTML+="........<a href='javascript:void(0);' class='person_count show_more'>查看更多</a>";
											},coly.tween.Cubic.easeInOut);
										});
									}else{
										return;
									}
								},600);
							}
						});
								}
							},
							error : function(data) {
								alert('ajax请求失败');
							}
						});
						/*结束判断登陆*/
						
					}else{
						alert("请先投票！");
					}
				});
				coly.each(voteRadio,function (){
					var _this=this;
					coly.addEvent(this.parentNode,"click",function (){
						setRadio.call(_this);
					});
				});
				coly.addEvent(voteBtn,"click",function (){
					
					var $this=this;
					/*开始ajax*/
							if($(this).attr('qid')){//如果是问答题
								var qid=$(this).attr('qid');
								var te=document.getElementById('textarea'+qid);
								var cont=te.value;
								//ajax begin
								 $.ajax({
										url : 'answerQuestion',
										dataType : 'json',
										data : {'answer':cont,'answerId':qid
										},
										type : 'post',
										success : function(data) {
										},error : function(data) {
											alert('ajax请求失败');
										}
								}); 
								//ajax end
								if($this.value==="提交" ||$this.value=="已提交"){
									$this.value="已提交";
									return;
								}else{
									$this.value="已投票";
								}
								$this.addClass("grey");
								voteFlag=true;
							}else{
								 var otherC='';
					        		if(coly.otherInput){
									otherC=coly.otherInput.value;
								}
								if(selectFlag===1){
						        		if(!voteFlag){
						        			//获取checkMax的值
											var articleId=$(this).attr('aid');
											//alert('本文的ID是:'+articleId);
										if(checkMax[voteDiv.eq] && selectLen>checkMax[voteDiv.eq]){
											alert("对不起，本题限选"+checkMax[voteDiv.eq]+"项，请重新选择！");
											return;
										}
										var r=document.getElementsByName("votes");
										for(var i=0;i<r.length;i++){
									         if(r[i].checked){
										         $.ajax({
														url : 'submitAnswer',
														dataType : 'json',
														data : {'answerId':r[i].value,'othercontent':otherC
														},
														type : 'post',
														success : function(data) {
															perCount=data.voteNum;
															
															numArray=data.votePer;
															coly.each(per_count,function (i){
																this.innerHTML=perCount[i]+"票";
															});
															coly.each(voteCount,function (i){
																//显示投票数字的动画
																this.css("display","block");
																var showNum=coly.$(".vote_c_num",this)[0];
																showNum.innerHTML="0%";
																var curTime=0,dur=parseInt(1500/40)*40;
																var t=setInterval(function (){
																	if(curTime>=dur){
																		clearInterval(t);
																	}
																	showNum.innerHTML=parseInt(coly.tween.Linear(0,parseInt(numArray[i]*100),curTime,dur))+"%";
																	curTime+=40;
																},40);
															});
															coly.each(sumWrap,function (i){
																if(coly.$(this).css("visibility")==="hidden"){
																	coly.$(this).css("display","block");
																	var curHeight=this.offsetHeight,showDiv=coly.$(".show_sum",this)[0];
																	coly.$(this).css("height","0px");
																	coly.$(this).animate({"height":0},{"height":curHeight},400,showCount.call(showDiv,parseInt(numArray[i]*100)));
																	coly.$(this).css("visibility","visible");
																}
															});
															$this.value="已投票";
															$this.addClass("grey");
															voteFlag=true;
														},
														error : function(data) {
															alert('ajax请求失败');
														}
												}); 
									       }
									    }
						        		}else{
										return false;
									}
						        	}
						        	else{
									return false;
								}
								
							}
						        
					/*结束ajax*/
						    
					/*ajax返回三个数组，其中numArray代表每道题目每个选项的投票百分比，第0个代表第一个;
						perCount代表每道题目每个选项的投票人数，第0个代表第一个；
						checkMax代表多选题的最多可选限制，第0个代表第一个多选。
					*/
				
				});
				coly.addEvent(nextBtn,"click",function (){
					//清空所有已选的checkbox
					var r=document.getElementsByName("votes"); 
				    for(var i=0;i<r.length;i++){
					         r[i].checked=false;
					        
				    } 
					if(selectFlag===0){
						return;
					}
					if(selectFlag===1 && voteFlag){
						if(voteDiv.next()){
							voteDiv.delClass("show_ques");
							coly.$(voteDiv.next()).addClass("show_ques");
							var voteNext=coly.$(".show_ques",voteContain)[0];
							voteFunc.call(voteNext);
						}else{
							alert("本题已是最后一题，感谢您的配合！");
						}
						
					}else{
						alert("请先点击投票！");
					}
						
				});
			}
		};
		voteFunc.call(vote);
		/*结束投票*/
	};
	
})();;