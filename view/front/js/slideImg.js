(function (){
	/*start slideImage  */
		/*
			SlideImg 图片轮播器 加[]表示可选参数
			args{
				imgContainer:img 图片容器,
				[btnsClass]:生成的按钮框的class
				[hoverClass]:className 图片播放时按钮样式的className
				[t]: t           图片自动轮播的时间间隔,
				[scrollSpeed],轮播的速度
			}
		*/
	function SlideImg(args){
		var _this=this;
		for(var i in args){
			_this[i]=args[i];
		};
		this.t=this.t || 3000;
		this.scrollSpeed=this.scrollSpeed || 1500;
		this.btnDiv=coly.$("<div></div>");
		this.btnConWrap=coly.$("<div></div>");
		this.btnContain=coly.$("<ul></ul>");
		this.btnContain.addClass("clearfix");
		this.btnsClass && this.btnDiv.addClass(this.btnsClass);
		/*开始 获取图片尺寸代码*/
		this.imgAll=coly.$("img",this.imgContainer);
		this.sizeWidth=this.sizeHeight=[];//创建2个数组，存储所有图片的尺寸
		coly.each(this.imgAll,function (){
			_this.sizeWidth.push(parseInt(coly.getImgSize(this).width));
			_this.sizeHeight.push(parseInt(coly.getImgSize(this).height));
		});
		this.sizeWidth.sort(function (a,b){return a-b;});//对存储图片尺寸的数组进行升序排序，以最小值作为图片尺寸的值
		this.sizeHeight.sort(function (a,b){return a-b;});
		//如果css中设置了图片尺寸，那么以css为准，否则以获取到图片的最小尺寸为
		this.imgWidth=parseInt(this.imgAll[0].css("width"))?parseInt(this.imgAll[0].css("width")):this.sizeWidth[0];
		this.imgHeight=parseInt(this.imgAll[0].css("height"))?parseInt(this.imgAll[0].css("height")):this.sizeHeight[0];
		if(parseInt(coly.$("li",this.imgContainer)[0].css("width"))){
			this.imgWidth=parseInt(coly.$("li",this.imgContainer)[0].css("width"));
		}
		if(parseInt(coly.$("li",this.imgContainer)[0].css("height"))){
			this.imgHeight=parseInt(coly.$("li",this.imgContainer)[0].css("height"));
		}
		/*结束 获取图片尺寸代码*/
		this.imgLen=this.imgAll.length;
		this.imgWrapLen=coly.$("li",this.imgContainer).length;
		this.imgLen=this.imgWrapLen===this.imgLen ? this.imgLen :this.imgWrapLen;
		for(var i=0;i<this.imgLen;i++){
			_this.btnContain.appendChild(coly.$("<li></li>"));
		};
		this.btnConWrap.appendChild(this.btnContain);
		this.btnDiv.appendChild(this.btnConWrap);
		if(this.imgLen>6){
			this.btnPre=coly.$("<div></div>");
			this.btnPre.addClass("btn_pre");
			this.btnPre.css({
				"cursor":"pointer",
				"position":"absolute",
				"left":"-19px",
				"top":0,
				"background":"url(view/front/images/common_bg.gif) no-repeat 0 -88px",
				"width":"10px",
				"height":"14px"				
			});
			this.btnDiv.appendChild(this.btnPre);
			this.btnNext=coly.$("<div></div>");
			this.btnNext.addClass("btn_next");
			this.btnNext.css({
				"cursor":"pointer",
				"position":"absolute",
				"right":"-13px",
				"top":0,
				"background":"url(view/front/images/common_bg.gif) no-repeat -30px -88px",
				"width":"10px",
				"height":"14px"
			});
			this.btnDiv.appendChild(this.btnNext);
			coly.addEvent(this.btnPre,"click",function (){
				_this.stop();
				_this.prev();
			});
			coly.addEvent(this.btnNext,"click",function (){
				_this.stop();
				_this.next();
			});
			coly.addEvent(this.btnPre,"mouseover",function (){
				_this.stop();
			});
			coly.addEvent(this.btnPre,"mouseout",function (){
				_this.start();
			});
			coly.addEvent(this.btnNext,"mouseover",function (){
				_this.stop();
			});
			coly.addEvent(this.btnNext,"mouseout",function (){
				_this.start();
			});
		}

		this.imgContainer.parentNode.appendChild(this.btnDiv);
		this.imgContainer.css({
			"width":this.imgWidth*this.imgLen+1+"px",
			"position":"absolute"
		});//+1是因为IE6没有这一像素会不够长，该死的IE6
		//这个高度是因为IE6没有高度显示不了
		this.btnContain.css({
			"position":"absolute",
			"top":0,
			"left":0	
		});	
		this.btnOffWid=this.btnContain.offsetWidth;//alert(this.btnContain.parentNode);
		this.disNum=this.imgLen>6 ?6:this.imgLen;
		this.btnDiv.css({
			"position":"relative",
			"top":this.imgContainer.offsetHeight+10+"px",
			"left":(this.imgContainer.parentNode.offsetWidth-this.btnOffWid/this.imgLen*this.disNum)/2+3+"px",
			"width":this.btnOffWid/this.imgLen*6+"px"
		});
		this.btnConWrap.css({
			"position":"relative",
			"width":this.btnOffWid/this.imgLen*6+"px",
			"overflow":"hidden",
			"height":this.btnDiv.offsetHeight+"px"
		});
		this.btnContain.css({
			"width":this.btnOffWid+"px"
		});
		//这里设置的高度主要是因为IE6清除浮动的clearfix设置了height:为1%；
		this.imgContainer.css({
			"height":this.imgContainer.offsetHeight+"px"
		});
		coly.$(this.imgContainer.parentNode).css({
			"height":this.imgContainer.offsetHeight+this.btnDiv.offsetHeight+13+"px",
			"position":"relative",
			"overflow":"hidden"
		});
		
		this.btns=coly.$("li",this.btnDiv);
		this.curImg=this.btns[0];
		for(var i=0;i<this.btns.length;i++){
			coly.addEvent(this.btns[i],"mouseover",function (){
				_this.stop();
				_this.go(this.index);
			});
			coly.addEvent(this.btns[i],"mouseout",function (){
				_this.start();
			});
				_this.btns[i].index=i;
		};
		this.go(0);
	};
	SlideImg.prototype={
		start:function (){
			var _this=this;
			this.stop();
			this.inv=setInterval(function (){
				_this.next();
			},this.t);
		},
		stop:function (){
			clearInterval(this.inv);
		},
		go:function (n){
			if(n>5){
				var oLeft=parseInt(this.btnContain.css("left")) || 0;
				this.btnContain.animate({"left":oLeft},{"left":(n-5)*(-18)-oLeft},500);
			}else{
				var oLeft=parseInt(this.btnContain.css("left")) || 0;
				this.btnContain.animate({"left":oLeft},{"left":0-oLeft},500);
			}
			var curLeft=parseInt(this.imgContainer.css("left")) || 0,_this=this;
			this.curImg=this.btns[n];
			this.hoverClass && this.btns[n].addClass(this.hoverClass);
			coly.each(this.btns[n].siblings(),function (){
				this.delClass(_this.hoverClass);
			});
			this.animateIterval && this.animateIterval();
			this.animateIterval =this.imgContainer.animate({
			left:curLeft
			},{
			left:(-n*this.imgWidth)-curLeft},this.scrollSpeed,"",coly.tween.Quad.easeOut);//coly.tween.Quad.easeInOut
		},
		prev:function (){
			var prevIndex=this.curImg.index-1;
			if(prevIndex<=0){
				prevIndex=0;
			}
			this.go(prevIndex);
		},
		next:function (){
			var nextIndex=this.curImg.index+1;
			if(nextIndex>=this.btns.length){
				nextIndex=0;
			}
			this.go(nextIndex);
		}
	};
	coly.SlideImg=SlideImg;
})();;