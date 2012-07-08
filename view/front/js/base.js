	/*
Autor coly
by coly    2011/12/5
*/
String.prototype.trim=function (){//去除字符串的前后空格
	return this.replace(/^\s*/,"").replace(/\s*$/,'');
};
String.prototype.gbLen=function (){//获取包含中文的字符串的长度
	var len=0;
	for(var i=0;i<this.length;i++){
		if(this.charCodeAt(i)>127 || this.charCodeAt(i)==94){
			len+=2;
		}else{
			len++;
		}
	};
	return len;
};
Array.prototype.each=function (fn){
	var _this=this;
	for(var i=0;i<_this.length;i++){
		fn.call(_this[i],i);
	};
};
var coly={};
coly.extend=function (obj,methodObj){
	for(var i in methodObj){
		obj[i]=methodObj[i];
	};
};
coly.methods={
	next:function (){
		var elem=this;
		do{
			elem=elem.nextSibling;
		}while(elem && elem.nodeType!=1);
		if(elem){
			return coly.$(elem);
		}else{
			return null;
		}
	},
	prev:function (){
		var elem=this;
		do{
			elem=elem.previousSibling;
		}while(elem && elem.nodeType!=1);
		if(elem){
			return coly.$(elem);
		}else{
			return null;
		}
	},
	first:function (){
		var elem=this.firstChild;
		while(elem.nodeType!=1){
			elem=coly.$(elem).next();	
		};
		if(elem){
			return coly.$(elem);
		}else{
			return null;
		}
	},
	hasClass:function (className){
		if(new RegExp(className,"g").test(this.className)){
			return true;
		}else{
			return false;
		}
	},
	addClass:function (className){
		if(coly.$(this).hasClass(className)){
			if(this){
				return coly.$(this);
			}else{
				return null;
			}
		}
		this.className=this.className+" "+className;
		if(this){
			return coly.$(this);
		}else{
			return null;
		}
	},
	delClass:function (className){
		if(coly.$(this).hasClass(className)){
			this.className=this.className.replace(new RegExp(className,"g"),"");
		}
		if(this){
			return coly.$(this);
		}else{
			return null;
		}
	},
	siblings:function (){
		var par=this.parentNode,child=par.childNodes,ret=[],_this=this;
		for(var i=0;i<child.length;i++){
			if(child[i].nodeType===1 && child[i]!==_this &&child[i].nodeName===_this.nodeName){
				ret.push(child[i]);
			}
		}
		return ret;
	},
	/*
	css方法说明
	@param name   string/object   属性
	@param  value   string/null  属性值
	demo:
	coly.$("id").css("width");//获取当前width属性值
	coly.$("id").css("width","200px");//设置width属性
	coly.$("id").css({
		"width":"100px",
		"height":"100px",
		"opacity":"10"
	});
	*/
	css:function (name,value){
		var _this=this;
		if(arguments.length==0){
			return _this;
		}
		switch(typeof name){
			case "string":
				if(value!==undefined){
					name=coly.toCamel(name);
					if(name ==="opacity"){
						coly.setOpacity(_this,value);
					}else{
						_this.style[name]=value;						
					}
					return _this;
				}else{
					if(window.getComputedStyle){
						return window.getComputedStyle(_this,null).getPropertyValue(name);
					}else{
						name=coly.toCamel(name);
						if(name=="float"){
							name="styleFloat";
						}
						return this.currentStyle[name];
					}
				}
				break;
			case "object":
				for(var i in name){
					if(i==="opacity"){
						coly.setOpacity(_this,name[i]);
					}else{
						_this.css(i,name[i]);
					}
				};
				return _this;
				break;
		};
	},
	/*
	ainmate 
	@param start  object 动画的起始值
	@param alter  object 动画的变化值
	@param dur    number 动画的持续时间
	@param fx        进行动画的函数,从coly.tween里选。
	demo:
	coly.$("#id").animate({"width":"100","height":"100"},{"width":"100","height":"100"},1000,function(){},coly.tween.Quad.easeInOut);
	*/
	animate:function (start,alter,dur,callback,fx){
		var obj=this,curTime=0;dur=parseInt(dur/40)*40;fx=fx || coly.tween.Quad.easeOut;
		var t=setInterval(function (){
			if(curTime>=dur){
				clearInterval(t);
				if(callback){
					callback.call(obj);
				}
			}
			for(var i in start){
				if(i!=="opacity"){
					obj.style[i]=fx(start[i],alter[i],curTime,dur)+"px";	
				}else{
					obj.css("opacity",fx(start[i],alter[i],curTime,dur));
				}	
			}
			curTime+=40;
		},40);
		return function (){
			clearInterval(t);
		};
	}
};
/*
*getImgSize  获取图片的实际尺寸
*/
coly.getImgSize=function (img){
	var newImage=new Image();
	newImage.setAttribute("src",img.getAttribute("src"));
	return {
		"width":newImage.width,
		"height":newImage.height
	}
};
coly.each=function (obj,fn){
	for(var i=0,maxLen=obj.length;i<maxLen;i++){
		fn.call(obj[i],i);
	};
};
coly.setOpacity=function (obj,op){
	if(obj.filters){
		obj.style.filter="alpha(opacity="+op+")";
	}else{
		obj.style.opacity=op/100;
	}
};
coly.$=function (name,context){
	if(typeof name==="string"){
		var regExp=[/^#\w+$/gi,/^\.\w+$/gi,/^[a-zA-Z]+/gi,/^<[a-zA-Z]+>.*<\/[a-zA-Z]+>$/gi],trueName=name.slice(1,name.length).trim();//console.log(trueName);
		context=context || document;
		for(var i=0;i<regExp.length;i++){
			if(regExp[i].test(name)){
				switch(i){
					case 0:
						var _a=document.getElementById(trueName);
						_a &&coly.extend(_a,coly.methods);
						return _a;
						break;
					case 1:
						var ret=[];
						var allElem=context.getElementsByTagName("*");
						for(var i=0;i<allElem.length;i++){
							if(new RegExp(trueName).test(allElem[i].className) && !new RegExp("[a-zA-Z_]"+trueName).test(allElem[i].className) && !new RegExp(trueName+"[a-zA-Z_]").test(allElem[i].className)){
								allElem[i] && coly.extend(allElem[i],coly.methods);
								ret.push(allElem[i]);
							}
						}
						return ret;
						break;
					case 2:
						var _b=context.getElementsByTagName(name);
						for(var i=0;i<_b.length;i++){
							_b[i] && coly.extend(_b[i],coly.methods);
						};
						return _b;
						break;
					case 3:
						var ecName=/^<[a-zA-Z]+>/i.exec(name).toString(),dName=ecName.slice(1,ecName.length-1),newDiv=document.createElement(dName),
						dInner=/>.*</i.exec(name);
						if(dInner){
							dInner=dInner.toString();
							dLen=dInner.length;
							dInner=dInner.slice(1,dLen-1);	
							newDiv.innerHTML=dInner;
						}
						coly.extend(newDiv,coly.methods);
						return newDiv;
						
				}
			}
		}
	}else{
		coly.extend(name,coly.methods);
		return name;
	}
};	
coly.addEvent=function (o,evt,fn){
	if(!o){return;}
	if(!o.functions){
		o.functions={};
	}
	if(!o.functions[evt]){
		o.functions[evt]=[];
	}
	for(var i=0;i<o.functions[evt].length;i++){
		if(o.functions[evt][i].toString()==fn.toString()){
			return o;
		}
	}
	o.functions[evt].push(fn);
	if(typeof o["on"+evt] ==="function"){
		if(o["on"+evt]!=coly.handle){
			o.functions[evt].push(o["on"+evt]);
		}
	}
	o["on"+evt]=coly.handle;
	return o;
};
coly.handle=function (evt){
	evt=coly.fixEvent(evt || window.event,this);
	evtype=evt.type;
	var funs=this.functions[evtype];
	for(var i=0;i<funs.length;i++){
		if(funs[i]){
			funs[i].call(this,evt);
		}
	};
};
coly.delEvent=function(obj,evtype,fn){
	var funs=obj.functions[evtype];
	for(var i=0;i<funs.length;i++){
		if(funs[i] && funs[i].toString()===fn.toString()){
			funs.splice(i,1);
			return obj;
		}
	}
};
coly.fixEvent=function (evt,obj){
	if (!evt.target) {//IE
		evt.target=evt.srcElement;
		if (evt.type=="mouseover")
			evt.relatedTarget=evt.fromElement;
		else if ("mouseout"==evt.type)
			evt.relatedTarget=evt.toElement;
		
		evt.pageX=evt.clientX+document.documentElement.scrollLeft;
		evt.pageY=evt.clientY+document.documentElement.scrollTop;
		evt.stopPropagation=function () {
			evt.cancelBubble=true;
		};
		evt.preventDefault=function () {
			evt.returnValue=false;
		};
	}else{
		evt.offsetX=evt.layerX;
		evt.offsetY=evt.layerY;
	}
	obj.getOffsetX=evt.pageX-evt.offsetX;
	obj.getOffsetY=evt.pageY-evt.offsetY;
	return evt;
};
coly.toCamel=function (name){
	return name.replace(/-[a-z]/gi,function (s){
		return s.charAt(1).toUpperCase();
	});
};
/*
*coly.serial   对采用键值对传值的数据进行串行化，即转化成类似：http://test.php?name="lu"&name="d"
*pararm dat  默认data采用键值对格式
*/
coly.serial=function (data){
	var ret=[];
	for(var i in data){
		if(data[i]!==undefined){
			ret.push(encodeURIComponent(i)+"="+encodeURIComponent(data[i]));
		}
	};
	return ret.join("&");
};
/*
args{
	type:默认为get
	url:
	success:    传一个回调函数
	data:{key:value}
	cache: 传一个值表示是否缓存数据，默认为false
}
*/
coly.ajax=function (args){
	var xhr=window.XMLHttpRequest?new XMLHttpRequest:new ActiveXObject("Microsoft.XMLHTTp"),datas=coly.serial(args.data);
	args.type=args.type || "get";
	if(/get/gi.test(args.type)){
		args.url+="?"+datas;
	}
	xhr.open(args.type,args.url,true);
	xhr.onreadystatechange=function (){
		if(xhr.readyState===4 && xhr.status==200){
			args.success(xhr.responseText,xhr.responseXML);
		}
	};
	if(/post/gi.test(args.type)){
		xhr.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
		xhr.send(datas);
	}else{
		xhr.send(null);
	}
};
coly.tween = {
	Linear:function (start,alter,curTime,dur) {return start+curTime/dur*alter;},//最简单的线性变化,即匀速运动
	Quad:{//二次方缓动
		easeIn:function (start,alter,curTime,dur) {
			return start+Math.pow(curTime/dur,2)*alter;
		},
		easeOut:function (start,alter,curTime,dur) {
			return start-alter *(curTime/=dur)*(curTime-2);
		},
		easeInOut:function (start,alter,curTime,dur) {
			if ((curTime/=dur/2) < 1) return alter/2*curTime*curTime + start;
			return -alter/2 * ((--curTime)*(curTime-2) - 1) + start;
		}
	},
	Cubic:{//三次方缓动
		easeIn:function (start,alter,curTime,dur) {
			return start+Math.pow(curTime/dur,3)*alter;
		},
		easeOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur;
			return start-(Math.pow(progress,3)-Math.pow(progress,2)+1)*alter;
		},
		easeInOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur*2;
			return (progress<1?Math.pow(progress,3):((progress-=2)*Math.pow(progress,2) + 2))*alter/2+start;
		}
	},
	Quart:{//四次方缓动
		easeIn:function (start,alter,curTime,dur) {
			return start+Math.pow(curTime/dur,4)*alter;
		},
		easeOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur;
			return start-(Math.pow(progress,4)-Math.pow(progress,3)-1)*alter;
		},
		easeInOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur*2;
			return (progress<1?Math.pow(progress,4):-((progress-=2)*Math.pow(progress,3) - 2))*alter/2+start;
		}
	},
	Quint:{//五次方缓动
		easeIn:function (start,alter,curTime,dur) {
			return start+Math.pow(curTime/dur,5)*alter;
		},
		easeOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur;
			return start-(Math.pow(progress,5)-Math.pow(progress,4)+1)*alter;
		},
		easeInOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur*2;
			return (progress<1?Math.pow(progress,5):((progress-=2)*Math.pow(progress,4) +2))*alter/2+start;
		}
	},
	Sine :{//正弦曲线缓动
		easeIn:function (start,alter,curTime,dur) {
			return start-(Math.cos(curTime/dur*Math.PI/2)-1)*alter;
		},
		easeOut:function (start,alter,curTime,dur) {
			return start+Math.sin(curTime/dur*Math.PI/2)*alter;
		},
		easeInOut:function (start,alter,curTime,dur) {
			return start-(Math.cos(curTime/dur*Math.PI/2)-1)*alter/2;
		}
	},
	Expo: {//指数曲线缓动
		easeIn:function (start,alter,curTime,dur) {
			return curTime?(start+alter*Math.pow(2,10*(curTime/dur-1))):start;
		},
		easeOut:function (start,alter,curTime,dur) {
			return (curTime==dur)?(start+alter):(start-(Math.pow(2,-10*curTime/dur)+1)*alter);
		},
		easeInOut:function (start,alter,curTime,dur) {
			if (!curTime) {return start;}
			if (curTime==dur) {return start+alter;}
			var progress =curTime/dur*2;
			if (progress < 1) {
				return alter/2*Math.pow(2,10* (progress-1))+start;
			} else {
				return alter/2* (-Math.pow(2, -10*--progress) + 2) +start;
			}
		}
	},
	Circ :{//圆形曲线缓动
		easeIn:function (start,alter,curTime,dur) {
			return start-alter*Math.sqrt(-Math.pow(curTime/dur,2));
		},
		easeOut:function (start,alter,curTime,dur) {
			return start+alter*Math.sqrt(1-Math.pow(curTime/dur-1));
		},
		easeInOut:function (start,alter,curTime,dur) {
			var progress =curTime/dur*2;
			return (progress<1?1-Math.sqrt(1-Math.pow(progress,2)):(Math.sqrt(1 - Math.pow(progress-2,2)) + 1))*alter/2+start;
		}
	},
	Elastic: {//指数衰减的正弦曲线缓动
		easeIn:function (start,alter,curTime,dur,extent,cycle) {
			if (!curTime) {return start;}
			if ((curTime==dur)==1) {return start+alter;}
			if (!cycle) {cycle=dur*0.3;}
			var s;
			if (!extent || extent< Math.abs(alter)) {
				extent=alter;
				s = cycle/4;
			} else {s=cycle/(Math.PI*2)*Math.asin(alter/extent);}
			return start-extent*Math.pow(2,10*(curTime/dur-1)) * Math.sin((curTime-dur-s)*(2*Math.PI)/cycle);
		},
		easeOut:function (start,alter,curTime,dur,extent,cycle) {
			if (!curTime) {return start;}
			if (curTime==dur) {return start+alter;}
			if (!cycle) {cycle=dur*0.3;}
			var s;
			if (!extent || extent< Math.abs(alter)) {
				extent=alter;
				s =cycle/4;
			} else {s=cycle/(Math.PI*2)*Math.asin(alter/extent);}
			return start+alter+extent*Math.pow(2,-curTime/dur*10)*Math.sin((curTime-s)*(2*Math.PI)/cycle);
		},
		easeInOut:function (start,alter,curTime,dur,extent,cycle) {
			if (!curTime) {return start;}
			if (curTime==dur) {return start+alter;}
			if (!cycle) {cycle=dur*0.45;}
			var s;
			if (!extent || extent< Math.abs(alter)) {
				extent=alter;
				s =cycle/4;
			} else {s=cycle/(Math.PI*2)*Math.asin(alter/extent);}
			var progress = curTime/dur*2;
			if (progress<1) {
				return start-0.5*extent*Math.pow(2,10*(progress-=1))*Math.sin( (progress*dur-s)*(2*Math.PI)/cycle);
			} else {
				return start+alter+0.5*extent*Math.pow(2,-10*(progress-=1)) * Math.sin( (progress*dur-s)*(2*Math.PI)/cycle);
			}
		}
	},
	Back:{
		easeIn: function (start,alter,curTime,dur,s){
			if (typeof s == "undefined") {s = 1.70158;}
			return start+alter*(curTime/=dur)*curTime*((s+1)*curTime - s);
		},
		easeOut: function (start,alter,curTime,dur,s) {
			if (typeof s == "undefined") {s = 1.70158;}
			return start+alter*((curTime=curTime/dur-1)*curTime*((s+1)*curTime + s) + 1);
		},
		easeInOut: function (start,alter,curTime,dur,s){
			if (typeof s == "undefined") {s = 1.70158;}
			if ((curTime/=dur/2) < 1) {
				return start+alter/2*(Math.pow(curTime,2)*(((s*=(1.525))+1)*curTime- s));
			}
			return start+alter/2*((curTime-=2)*curTime*(((s*=(1.525))+1)*curTime+ s)+2);
		}
	},
	Bounce:{
		easeIn: function(start,alter,curTime,dur){
			return start+alter-Tween.Bounce.easeOut(0,alter,dur-curTime,dur);
		},
		easeOut: function(start,alter,curTime,dur){
			if ((curTime/=dur) < (1/2.75)) {
				return alter*(7.5625*Math.pow(curTime,2))+start;
			} else if (curTime < (2/2.75)) {
				return alter*(7.5625*(curTime-=(1.5/2.75))*curTime + .75)+start;
			} else if (curTime< (2.5/2.75)) {
				return alter*(7.5625*(curTime-=(2.25/2.75))*curTime + .9375)+start;
			} else {
				return alter*(7.5625*(curTime-=(2.625/2.75))*curTime + .984375)+start;
			}
		},
		easeInOut: function (start,alter,curTime,dur){
			if (curTime< dur/2) {
				return Tween.Bounce.easeIn(0,alter,curTime*2,dur) *0.5+start;
			} else {
				return Tween.Bounce.easeOut(0,alter,curTime*2-dur,dur) *0.5 + alter*0.5 +start;
			}
		}
	}
};