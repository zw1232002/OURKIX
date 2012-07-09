(function (){
	coly.addEvent(window,"load",page);
	function page(){
		/*start news_content popbox */
		var content_box=coly.$("#content_box_div"),content_imgs=coly.$("img",content_box),pop_box=coly.$("#pop_box"),
		pop_bg=coly.$("#popbox_bg"),box_content=coly.$(".box_content",pop_box)[0],img_all=coly.$("#img_all"),closeBtn=coly.$(".closeBtn")[0],popNav=coly.$("#popNav"),prevBtn=coly.$(".prev",pop_box)[0],nextBtn=coly.$(".next",pop_box)[0],
		small_prev=coly.$(".small_prev",popNav)[0],small_next=coly.$(".small_next",popNav)[0],btns=coly.$(".btns",pop_box);
		if(!content_box || !pop_box){
			return;
		}
		/*
		{
			pop_bg:     popbox的背景div
			pop_box:   pop_box的主div
			box_content：图片和按钮的外层div
			btns：              所有的next，close的集合，方便统一进行显示动画
			img_all：         所有图片的外层容器
			popNav：        下方的导航容器
			closeBtn：       关闭按钮
			nextBtn：       	下一个按钮
			prevBtn：         上一个按钮
			small_prev：    下方导航上的上一个按钮
			small_next：    下方导航上的下一个按钮
			hoverClass：      下方导航高亮显示的className
		}
		*/
		var showBox=new ShowBox({
			"pop_bg":pop_bg,
			"pop_box":pop_box,
			"box_content":box_content,
			"btns":btns,
			"img_all":img_all,
			"popNav":popNav,
			"closeBtn":closeBtn,
			"prevBtn":prevBtn,
			"nextBtn":nextBtn,
			"small_prev":small_prev,
			"small_next":small_next,
			"hoverClass":"select"
		});
		for(var i=0;i<content_imgs.length;i++){
			content_imgs[i].eq=i;
			coly.addEvent(content_imgs[i],"click",function (){
				showBox.invoke(this.eq);
			});
		};
	};
	/*start news_content popbox */
	function ShowBox(args){
		var _this=this;this.navFlag=true;
		//讲参数添加到this的属性中
		coly.extend(this,args);
		//获取页面的高度和宽度
		this.pageWidth=document.documentElement.scrollWidth;
		this.pageHeight=document.documentElement.scrollHeight;
		this.pop_bg.css("z-index","90");
		this.popNav.css("z-index","100");
		this.pop_box.css("z-index","100");
		coly.addEvent(this.pop_bg,"click",function (){
			_this.close();
		});
		coly.addEvent(this.closeBtn,"click",function (){
			_this.close();
		});
		coly.addEvent(this.prevBtn,"click",function (){
			_this.prev();
		});
		coly.addEvent(this.nextBtn,"click",function (){
			_this.next();
		});
		coly.addEvent(this.small_prev,"click",function (){
			_this.prev();
		});
		coly.addEvent(this.small_next,"click",function (){
			_this.next();
		});
		this.imgCon=coly.$("li",this.img_all);
		this.btnDiv=coly.$(".choose_img")[0];
		this.navBtn=coly.$("img",this.btnDiv);
		this.ret=[];
		//ret是存储所有的图片li的容器
		for(var i=0;i<this.imgCon.length;i++){
			if(_this.imgCon[i].parentNode===_this.img_all){
				_this.ret.push(_this.imgCon[i]);
			}
		};
		for(var i=0;i<_this.navBtn.length;i++){
			_this.navBtn[i].eq=i;
			coly.addEvent(_this.navBtn[i],"click",function (){
				_this.invoke(this.eq,1);
			});
			_this.curImg=_this.navBtn[0];
		};
		//设定下方导航按钮的样式，其中771是最大宽度，最多可以放7个，默认的按钮图片的的尺寸是101*62
		this.imgWrap=coly.$(".cho_container",this.popNav)[0];
		this.navAll=coly.$(".choose_img",this.imgWrap)[0];
		this.navShowNum=this.navBtn.length<=7 ? this.navBtn.length :7; 
		this.imgWrap.css({
			"width":771/7*this.navShowNum+"px"	
		});
	};
	ShowBox.prototype={
		toogle_bg:function (){//用来切换灰色的背景
			var _this=this;
			if(_this.pop_bg.css("display")==="block"){
				_this.anima5=_this.pop_bg.animate({"opacity":70},{"opacity":-70},500,function (){
					_this.pop_bg.css({"display":"none","width":"0","height":"0","opacity":"70"});
				});
			}else{
				_this.pop_bg.css({"display":"block","width":_this.pageWidth+"px","height":_this.pageHeight+"px","opacity":70});
			}
		},
		/*
			对于文章的评论进行显示
			参数说明
			curHei 当前主popbox的height值，
			alter    要变化的height值，也即是 _this.itemContent的高度
		*/
		show_content:function (curHei,alter){
			var _this=this;
			curHei=parseInt(curHei);
			//_this.navFlag是一个控制背景和导航隐藏和显示的flag，
			//图片切换时，背景和导航不隐藏，点开时，淡入，关闭时，淡出
			if(_this.navFlag){
				setTimeout(function (){_this.toggle_nav()},900);;	//使用setTimeout是因为到等到内容加载完毕之后再显示导航条
			}
			_this.navFlag=false;
			_this.anima1=this.img_all.animate({"height":curHei},{"height":alter},800,function (){
				//下方导航条进行的动画，当图片切换时，改变导航的top值
				//其中下方的110是popbox的top值，20是popbox的padding值，30是导航离popbox的间距
				_this.popHeight=parseInt(_this.img_all.css("height"));
				
				_this.anima6=_this.popNav.animate({"top":parseInt(_this.popNav.css("top"))},{"top":_this.popHeight+110+20+30-parseInt(_this.popNav.css("top"))},500);
			});
			//由于需要动态获取content的高度，需要用到offsetHeight属性，而offsetHeight不支持display:none;
			//所以暂且用visibility来代替
			_this.itemContent.css("visibility","visible");
			_this.toggleBtns();
		},
		toggle_nav:function (){//导航条动画
			var _this=this;
			_this.popNav.css({
				"opacity":"0",
				"visibility":"visible"
			});
			_this.popNav.animate({"opacity":0},{"opacity":100},700);		
		},
		//控制按钮的统一显示，因为设置了absolute的div，不包含在主div中
		//	所以动画开始时会自己显示，影响美观，所以设置一个动画进行控制
		toggleBtns:function (){
			var _this=this;
			this.btns.each(function (){
				this.css("display","block");
				coly.each(_this.com,function (){
					this.css("display","block");
				});
			});
		},
		//进行放大缩小所需要的div的动画切换
		/*
			变量说明
			itemWid  表示当前要显示的那一个图片的长度，同理itemHe
			curWid     表示前一个图片的长度，同理curH
			alterW      要变化的长度
			alterH        要变化的高度
			代码中所有的+20都是因为popbox的padding的作用，而+10则是因为高度的变化只需要考虑下方的padding
		*/
		toggleMask:function (item,flag){
			var _this=this,
			w=flag?(_this.itemWid+20)/2*2/3:(_this.curWid+20)/2,
			h=flag?(_this.itemHe+10)*2/3:_this.curHe+10,
			alterW=flag?(_this.itemWid+20)/2/3:(_this.itemWid-_this.curWid)/2,
			alterH=flag?(_this.itemHe+10)/3:(_this.itemHe-_this.curHe);
			this.loadingDiv.css("display","block");
			_this.anima2=this.maskDivLeft.animate({"width":w,"height":h},{"width":alterW,"height":alterH},800,function (){
				_this.itemImg.animate({"opacity":20},{"opacity":80},600,function (){
					_this.show_content(_this.itemHe,_this.itemContent.offsetHeight);
				});
				_this.img_all.css({
					"background":"#fff",
					"width":_this.itemWid+"px",
					"height":_this.itemHe+"px"
				});
				_this.box_content.css({
					"width":_this.itemWid+20+"px"
				});
				_this.maskDiv.css({
					"display":"none"
				});
				_this.loadingDiv.css("display","none");
			});
		},
		/*
			进行主要的设置和动画
			包括img显示和切换，调用其他主要的方法
		*/
		show:function (item){
			var _this=this;
			_this.itemImg=coly.$("img",item)[0];
			_this.itemContent=coly.$(".popContent",item)[0];
			_this.itemContentText=coly.$(".text",_this.itemContent)[0];
			_this.itemContentComs=coly.$(".com_content",_this.itemContent)[0];
			if(!(_this.itemContentText.innerHTML)){
				_this.itemContentText.css("display","none");
			}
			if(!(_this.itemContentComs.innerHTML)){
				_this.itemContentComs.css("display","none");
			}
			_this.itemWid=coly.getImgSize(_this.itemImg).width;
			_this.itemHe=coly.getImgSize(_this.itemImg).height;
			_this.itemContent.css("visibility","hidden");
			_this.com=coly.$(".comDiv",item);
			this.comDiv=coly.$(".comDiv",this.pop_box);
			coly.each(_this.comDiv,function (){
					this.css("display","none");
			});
			/*
				清除当前还在进行的动画
				防止用户点击过快而导致动画混乱
			*/
			_this.anima1 &&_this.anima1();
			_this.anima2 &&_this.anima2();
			_this.anima3 &&_this.anima3();
			_this.anima4 &&_this.anima4();
			_this.anima5 &&_this.anima5();
			_this.anima6 &&_this.anima6();
			_this.img_all.css({
				"background":"none",
				"width":"auto",
				"height":"auto"
			});
			_this.popNav.css({
					"left":_this.popNav.offsetWidth?(_this.pageWidth-_this.popNav.offsetWidth)/2+"px":"227px"
			});
			_this.box_content.css({
				"width":"auto",
				"height":"auto"
			});
			item.css({
				"display":"block",
				"opacity":"100"
			});
			_this.itemImg.css({
				"display":"block",
				"opacity":"0"
			});
			_this.prevBtn.css("top",_this.itemHe/2+"px");
			_this.nextBtn.css("top",_this.itemHe/2+"px");
			coly.each(item.siblings(),function (){
				var o=this;
				if(o.nodeName==="LI"){
					o.css({
						"display":"none",
						"opacity":"0"
					});
				}
			});
			this.pop_box.css({
				"left":(_this.pageWidth-_this.itemWid-20)/2+"px",
				"top":110+"px",
				"display":"block"
			});
			if(!this.maskDiv){
				this.maskDiv=coly.$("<div><div id='mask' style='position:relative;'>mask</div></div>");
				this.loadingDiv=coly.$("<div><img src='view/front/images/loading.gif'/></div>");
				this.pop_box.appendChild(this.maskDiv);
				this.mask=coly.$("#mask");
				this.maskDivLeft=coly.$("<div>this.maskDivRigh</div>");
				this.maskDivRight=coly.$("<div>this.maskDivRight</div>");
				this.mask.appendChild(this.maskDivLeft);
				this.mask.appendChild(this.maskDivRight);
				this.mask.appendChild(this.loadingDiv);
			}
			this.loadingDiv.css({
				"position":"absolute",
				"left":(_this.itemWid+20)/2+"px",
				"top":(_this.itemHe+10)/3+"px",
				"display":"none"
			});
			this.maskDiv.css({
				"id":"mask",
				"position":"absolute",
				"top":"0",
				"left":"0",
				"font-size":"0px",
				"display":"block"
			});
			this.mask.css({
					"width":_this.itemWid+20+"px",
					"height":_this.itemHe+10+"px"
			});
			this.maskDivLeft.css({
				"position":"absolute",
				"right":(_this.itemWid+20)/2+"px",
				"top":"0px",
				"display":"block",
				"background":"#fff",
				"text-indent":"-9999px"
			});
			this.maskDivRight.css({
				"position":"absolute",
				"left":(_this.itemWid+20)/2+"px",
				"top":"0px",
				"display":"block",
				"background":"#fff",
				"text-indent":"-9999px"
			});
			if(_this.navFlag){
				_this.toogle_bg();
				this.maskDivLeft.css({
					"width":(_this.itemWid+20)/2*2/3+"px",
					"height":(_this.itemHe+10)*2/3+"px",
					"opacity":"0"
				});
				this.maskDivRight.css({
					"width":(_this.itemWid+20)/2*2/3+"px",
					"height":(_this.itemHe+10)*2/3+"px",
					"opacity":"0"
				});
				this.maskDivLeft.animate({"opacity":0},{"opacity":100},200,function (){
					_this.toggleMask(item,1);
				});
				_this.anima3=this.maskDivRight.animate({"opacity":0},{"opacity":100},200,function (){
					this.animate({"width":parseInt(this.css("width")),"height":parseInt(this.css("height"))},{"width":(_this.itemWid+20)/2/3,"height":(_this.itemHe+10)/3},800,function (){
						_this.maskDiv.css({
							"display":"none"
						});
					});
				});
			}else{
				_this.toggleMask(item);
				_this.anima4=this.maskDivRight.animate({"width":(_this.curWid+20)/2,"height":(_this.curHe+10)},{"width":(_this.itemWid-_this.curWid)/2,"height":_this.itemHe-_this.curHe},800,function (){
				});
			}
		},
		/*
			调用指定的图片序列
			i表示将要进行显示的li的索引值
			flag是一个标志，用来控制是否对curwid的重新获取，当切换时，重新获取，第一次点开时，不获取
		*/
		invoke:function (i,flag){
			var _this=this;
			if(i>6){
				var oLeft=parseInt(this.btnDiv.css("left"));
				this.btnDiv.animate({"left":oLeft},{"left":(i-6)*(-111)-oLeft},500);
			}else{
				var oLeft=parseInt(this.btnDiv.css("left"));
				this.btnDiv.animate({"left":oLeft},{"left":0-oLeft},500);
			}
			if(flag){
				this.curWid=parseInt(coly.getImgSize(coly.$("img",_this.ret[_this.curImg.eq])[0]).width);
				this.curHe=parseInt(coly.getImgSize(coly.$("img",_this.ret[_this.curImg.eq])[0]).height);
			};
			_this.curImg=this.navBtn[i];
			_this.setStyle(_this.navBtn[i]);
			this.btns.each(function (){
				this.css({"display":"none"});
			});
			this.show(_this.ret[i]);
		},
		setStyle:function (obj){//改选中li对应的按钮进行高亮显示
			var _this=this;
			coly.$(obj).addClass(this.hoverClass);
			coly.each(obj.siblings(),function (){
				coly.$(this).delClass(_this.hoverClass);
			});
		},
		next:function (){
			var _this=this;
			this.curWid=parseInt(coly.getImgSize(coly.$("img",_this.ret[_this.curImg.eq])[0]).width);
			this.curHe=parseInt(coly.getImgSize(coly.$("img",_this.ret[_this.curImg.eq])[0]).height);
			if(this.curImg.eq>=_this.navBtn.length-1){
				_this.curImg=_this.navBtn[0];
			}else{
				var nextEq=_this.curImg.eq+1;
				_this.curImg=_this.navBtn[nextEq];
			}
			this.invoke(_this.curImg.eq);
		},
		prev:function (){
			var _this=this;
			this.curWid=parseInt(coly.getImgSize(coly.$("img",_this.ret[_this.curImg.eq])[0]).width);
			this.curHe=parseInt(coly.getImgSize(coly.$("img",_this.ret[_this.curImg.eq])[0]).height);
			if(this.curImg.eq<1){
				_this.curImg=_this.navBtn[0];
				return;
			}else{
				var prevEq=_this.curImg.eq-1;
				_this.curImg=_this.navBtn[prevEq];
			}
			this.invoke(_this.curImg.eq);
		},
		close:function (){
			var _this=this;
			_this.anima1 &&_this.anima1();
			_this.anima2 &&_this.anima2();
			_this.anima3 &&_this.anima3();
			_this.anima4 &&_this.anima4();
			_this.anima5 &&_this.anima5();
			_this.anima6 &&_this.anima6();
			this.pop_box.css("display","none");
			this.popNav.css({"visibility":"hidden","opacity":"0"});
			this.toogle_bg();
			_this.navFlag=true;
		}
	};
	/*end news_content popbox */
})();