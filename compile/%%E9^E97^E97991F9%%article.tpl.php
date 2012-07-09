<?php /* Smarty version 2.6.26, created on 2012-07-09 16:57:38
         compiled from front/article.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getDays', 'front/article.tpl', 73, false),array('function', 'htmlspecialchars_decode', 'front/article.tpl', 76, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OURKIX-文章</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<link href="view/front/css/News_list.css" rel="stylesheet" type="text/css" />
<link href="view/front/css/News_content.css" rel="stylesheet" type="text/css"/>
<script language="javascript" type="text/javascript" src="view/front/js/common.js"></script>
<script type="text/javascript" src="view/front/js/slideImg.js"></script>
<script type="text/javascript">
	(function (){
		coly.addEvent(window,"load",function (){
			/*开始轮播器初始化*/
			var imgDiv=coly.$("#content_box_div"),imgCon=coly.$(".content_box",imgDiv)[0],preBtn=coly.$(".prev",imgDiv)[0],nextBtn=coly.$(".next",imgDiv)[0];
			var slider=new coly.SlideImg({
				imgContainer:imgCon,
				btnsClass:"box_btns",
				hoverClass:"hover",
				t:3800,
				scrollSpeed:500
			});
			coly.addEvent(preBtn,"click",function (){slider.stop();slider.prev();});
			coly.addEvent(nextBtn,"click",function (){slider.stop();slider.next();});
			slider.start();
			/*结束轮播器初始化*/
			
			/*开始修正文章中的图片，强制显示固定尺寸*/
			var contentDiv=coly.$(".content_all")[0],textDiv=coly.$(".text",contentDiv)[0],allImages=coly.$("img",textDiv);
			if(allImages.length<=0){
				return;
			}
			coly.each(allImages,function (){
				if(coly.getImgSize(this).width>640){
					this.css({
						"width":"640px"
					});
				}
				if(coly.getImgSize(this).height>420){
					this.css({
						"height":"420px"
					});
				}
			});
			/*结束修正文章中的图片，强制显示固定尺寸*/
		});
	})();
</script>

</head>
<body>
<div class="page">
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/top_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/logo_search.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
  <!--content start-->
  <div class="main clearfix">
    <div class="box_left">
      <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/sub_nav.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
      <div class="content_container">
      	<div id="content_box_div">
      		
      		<ul class="content_box clearfix new_content_slider" >
      		<?php $_from = $this->_tpl_vars['oneArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
		        <li> <a href="javascript:void(0);"><img src="<?php echo $this->_tpl_vars['value']->src_big; ?>
"  height="420" /></a></li>
	     	 <?php endforeach; endif; unset($_from); ?>
	     	 </ul>
	     	 <div class="prev conten_btn"></div>
      		<div class="next conten_btn"></div>
      	</div>
	      <div class="content_all">
	      	<?php $_from = $this->_tpl_vars['oneArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	      		 <h2><?php echo $this->_tpl_vars['value']->title; ?>
</h2>
	          	<span class="time"><?php echo smarty_function_getDays(array('date' => $this->_tpl_vars['value']->date), $this);?>
 days ago &middot; by <a href="#">staff</a> &middot; <?php echo $this->_tpl_vars['value']->count; ?>
 views</span>
		          <div class="tags">Tags: <a href="#">Clot</a>, <a href="#">Fashion</a>, <a href="#">Gildas Loaec</a>, <a href="#">Interviews</a>, <a href="#">Kitsune</a></div>
		          <div class="text">
		          <?php echo smarty_function_htmlspecialchars_decode(array('val' => $this->_tpl_vars['value']->content), $this);?>

		          </div>
	      	<?php endforeach; endif; unset($_from); ?>
	      	 </div>
	     	<ul class="article_tool">
	     		<li class="like_it">
	     			<a href="#" title="喜欢"></a>
	     			<em><?php echo $this->_tpl_vars['oneArticel'][0]->like; ?>
</em>
	     		</li>
	     		<li class="collect">
	     			<a href="#" title="收藏"></a>
	     			<em><?php echo $this->_tpl_vars['oneArticel'][0]->collect; ?>
</em>
	     		</li>
	     		<li >
	     			<a href="#" title="分享" class="shar_btn"></a>
	     			<em><?php echo $this->_tpl_vars['oneArticel'][0]->share; ?>
</em>
	     			<ul class="share clearfix">
			            <li><a href="javascript:void((function(s,d,e,r,l,p,t,z,c){x=document;y=window;if(x.selection){Q=x.selection.createRange().text;}else%20if(y.getSelection){Q=y.getSelection();}else%20if(x.getSelection){Q=x.getSelection();};var%20f='http://v.t.sina.com.cn/share/share.php?',u=z||d.location,p=['url=',e(u)+e('\n')+e(Q),'&amp;title=',e(t||d.title),'&amp;source=',e(r),'&amp;sourceUrl=',e(l),'&amp;content=',c||'gb2312','&amp;pic=',e(p||'')].join('');function%20a(){if(!window.open([f,p].join(''),'mb',['toolbar=0,status=0,resizable=1,width=650,height=500,left=',300,',top=',150].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent,'','','','','','utf-8'));" class="sina" title="分享到新浪微博"></a></li>
			            <li><a href="javascript:void((function(s,d,e){if(/xiaonei\.com/.test(d.location))return;var%20f='http://share.xiaonei.com/share/buttonshare.do?link=',u=d.location,l=d.title,p=[e(u),'&amp;title=',e(l)].join('');function%20a(){if(!window.open([f,p].join(''),'xnshare',['toolbar=0,status=0,resizable=1,width=650,height=500,left=',300,',top=',150].join('')))u.href=[f,p].join('');};if(/Firefox/.test(navigator.userAgent))setTimeout(a,0);else%20a();})(screen,document,encodeURIComponent));" class="renren" title="分享到人人网"></a></li>
			            <li><a href="javascript:d=document;t=d.selection?(d.selection.type!='None'?d.selection.createRange().text:''):(d.getSelection?d.getSelection():'');void(kaixin=window.open('http://www.kaixin001.com/~repaste/repaste.php?&amp;rurl='+escape(d.location.href)+'&amp;rtitle='+escape(d.title)+'&amp;rcontent='+escape(d.title),'kaixin'));kaixin.focus();" class="share1" title="分享到开心网"></a></li>
			            <li><a href="javascript:var u='http://www.douban.com/recommend/?url='+location.href+'&amp;title='+encodeURIComponent(document.title);window.open(u,'douban','toolbar=0,resizable=1,scrollbars=yes,status=1,width=650,height=500,left=300,top=100');void(0)" class="share2" title="分享到豆瓣"></a></li>
			            <li><a href="javascript:void(0);" class="share3" title="分享到腾讯微博" onclick="coly.postToWb();"></a></li>
			         </ul>
	     		</li>	
	     	</ul>
           <script type="text/javascript">
			  (function (){
			  	  function postToWb(){
					var _t = encodeURI(document.title);
					var _url = encodeURIComponent(document.location);
					var _appkey = encodeURI("");//你从腾讯获得的appkey
					var _pic = encodeURI('');//（例如：var _pic='图片url1|图片url2|图片url3....）
					var _site = '';//你的网站地址
					var _u = 'http://v.t.qq.com/share/share.php?title='+_t+'&url='+_url+'&appkey='+_appkey+'&site='+_site+'&pic='+_pic;
					window.open( _u,'转播到腾讯微博', 'width=650, height=500, top=150, left=300, toolbar=no, menubar=no, scrollbars=no, location=yes, resizable=no, status=no' );
				}
				coly.postToWb=postToWb;
				//以下弹出分享按钮的js
				var articleTool=coly.$(".article_tool")[0],shareBtn=coly.$(".shar_btn",articleTool)[0],share_box=coly.$(".share",articleTool)[0],showFlag=true;
				articleTool && shareBtn&& share_box &&coly.addEvent(shareBtn,"click",function (evt){
					evt.preventDefault();
					var oriHeight=share_box.offsetHeight;
					if(showFlag){
						share_box.css({
						"visibility":"visible",
						"opacity":"0",
						"top":"25px"
						});
						share_box.animate({
							"top":25,"opacity":0
						},{"top":38,"opacity":100},900);
						showFlag=false;
					}else{
						share_box.animate({
							"opacity":100
						},{"opacity":-100},400,function (){
						share_box.css({
							"visibility":"hidden"
						});
						});
						showFlag=true;
					}
				});
			  })();
			</script>
      </div>
      <div class="community_says">
        <div class="htitle">
          <h4 class="sort">COMMUNITY SAYS | 用户评论</h4>
        </div>
        <div class="common_content commu_content clearfix">
          <div class="ulbox">
          <form>
            <ul class="clearfix">
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like" ></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
              <li><label><span>这很不错哦</span>
                <input type="radio" name="like"></label>
              </li>
            </ul>
          </form>
          </div>
        </div>
      </div>
      <div class="related_articles">
        <div class="htitle">
          <h4 class="sort">RELATED ARTICLES | 相关文章</h4>
        </div>
	    <div class="common_content related_content clearfix">
	      <ul>
	      	<li class="clearfix">
	      		<img src="images/test/ad2.jpg"/>
	      		<strong>The Complex Guide to Dressing for Los Angeles</strong><br/>
	      		<span>Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear. Relying on performance rather than strictly visual aesthetics</span>
	      	</li>
	      	<li class="clearfix">
	      		<img src="images/test/ad2.jpg"/>
	      		<strong>The Complex Guide to Dressing for Los Angeles</strong><br/>
	      		<span>Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear. Relying on performance rather than strictly visual aesthetics</span>
	      	</li>
	      </ul>
	    </div>
      </div>
      <div class="comments">
        <div class="htitle">
          <h4 class="sort">COMMENTS | 评论</h4>
        </div>
        <div class="common_content comments_content clearfix">
          <ul>
            <li class="clearfix com_top"> 
              <div class="floor_comm clearfix">
              	<em class="left_top"></em>
              	<em class="left_bottom"></em>
              	<em class="right_top"></em>
              	<em class="right_bottom"></em>
              	<strong>2011-10-17  14:56 <span>亮点</span>(12)    &nbsp;&nbsp;引用</strong>
                <div class="floor flor_top">Top</div>
                <div class="comment">Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear. Relying on performance rather than strictly visual aesthetics</div>
                <div class="comment_right"></div>
              </div>
              <img class="portrait" src="images/test/touxiang.jpg"/>
            </li>
            <li class="clearfix"> 
              <div class="floor_comm clearfix">
              	<strong>/ 2011-10-17  14:56 <span>亮点</span>(12)    &nbsp;&nbsp;引用</strong>
                <div class="floor">1</div>
                <div class="comment">Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear. Relying on performance rather than strictly visual aesthetics</div>
                <div class="comment_right"></div>
              </div>
              <img class="portrait" src="images/test/touxiang.jpg"/>
            </li>
            <li class="clearfix">
              <div class="floor_comm clearfix">
              	 <strong>/ 2011-10-17  14:56 <span>亮点</span>(12)    &nbsp;&nbsp;引用</strong>
                <div class="floor">20</div>
                <div class="quote">
                	<em ></em>
                	<p>"Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear."</p><span>引用3楼<strong>esuna</strong>发表的</span></div>
                <div class="quote_comment comment">Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear. Relying on performance rather than strictly visual aesthetics</div>
                <div class="comment_right"></div>
              </div>
              <img class="portrait" src="images/test/touxiang.jpg"/>
            </li>
            <li class="clearfix"> 
              <div class="floor_comm clearfix">
              	<strong>/ 2011-10-17  14:56 <span>亮点</span>(12)    &nbsp;&nbsp;引用</strong>
                <div class="floor">30</div>
                <div class="comment">Jordan Brand held a special "Flight Forum" this week at the Nike Campus in Beaverton, heavily centered around the brand's evolution of basketball footwear. Relying on performance rather than strictly visual aesthetics</div>
                <div class="comment_right"></div>
              </div>
              <img class="portrait" src="images/test/touxiang.jpg"/>
            </li>
            <li>
              <ul id="PageFen">
                <li class="onthis"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li><a href="#">7</a></li>
                <li><a href="#">8</a></li>
                <li><a href="#">...</a></li>
                <li>PREV</li>
                <li class="last"><a href="#">NEXT</a></li>
              </ul>
            </li>
            <li>
              <form name="comment" id="comment">
              <textarea  name="comment" onfocus="this.innerHTML=''" class="textarea" id="comment" >Type your comment here......</textarea><div class="textarea_btm">d</div>
                <input type="submit" class="submit"  value="" name="submit" />
              </form>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="box_right">
      <div class="thead">
        <a href="#"><img src="view/front/images/test/ad1.jpg" width="300" height="223" /></a>
      </div>
      <div class="thead clearfix">
      	<a href="#" ><img src="view/front/images/test/right_ad.jpg" width="300" height="612"/></a>
      </div>
      <div class="thead">
        <a href="#"><img src="view/front/images/test/ad1.jpg" width="300" height="250" /></a>
      </div>
      <div class="listBox_Shading week_today_sort">
        <h4 class="sort">TOP ARTICLES | 热门文章</h4>
        <ul class="sortBtn" id="sortDiv">
        		<li class="article_week">WEEK</li>
        		<li class="btn_hd article_day">TODAY</li>
        		<li class="article_sort_btn"></li>
        	</ul>
        <ul class="Interview clearfix">
          <li class="border clearfix">
            <a class="img" href="#"><img src="view/front/images/test/pic04.jpg" width="129" height="81" /></a>
            <h4><a href="#">The Complex Guide to Dressing for Los Angeles</a></h4>
            <p>How the West gets dressed.</p>
          </li>
          <li class="border clearfix">
            <a class="img" href="#"><img src="view/front/images/test/pic04.jpg" width="129" height="81" /></a>
            <h4><a href="#">The Complex Guide to Dressing for Los Angeles</a></h4>
            <p>How the West gets dressed.</p>
          </li>
          <li class="border clearfix">
            <a class="img" href="#"><img src="view/front/images/test/pic04.jpg" width="129" height="81" /></a>
            <h4><a href="#">The Complex Guide to Dressing for Los Angeles</a></h4>
            <p>How the West gets dressed.</p>
          </li>
          <li class="border clearfix">
            <a class="img" href="#"><img src="view/front/images/test/pic04.jpg" width="129" height="81" /></a>
            <h4><a href="#">The Complex Guide to Dressing for Los Angeles</a></h4>
            <p>How the West gets dressed.</p>
          </li>
          <li class="border clearfix">
            <a class="img" href="#"><img src="view/front/images/test/pic04.jpg" width="129" height="81" /></a>
            <h4><a href="#">The Complex Guide to Dressing for Los Angeles</a></h4>
            <p>How the West gets dressed.</p>
          </li>
          <li class="border clearfix">
            <a class="img" href="#"><img src="view/front/images/test/pic04.jpg" width="129" height="81" /></a>
            <h4><a href="#">The Complex Guide to Dressing for Los Angeles</a></h4>
            <p>How the West gets dressed.</p>
          </li>
        </ul>
      </div>
    </div>
  
  </div>
  <!--content end-->
  <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div class="popbox_bg" id="popbox_bg"></div>
<div class="popbox" id="pop_box">
	<div class="box_content">
		<div class="closeBtn btns">close</div>
		<div class="prev btns">prev</div>
		<div class="next btns">next</div>
		<ul class="img_container" id="img_all">
		<?php $_from = $this->_tpl_vars['oneArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
			<li>
				<div class="popImg">
					<img src="<?php echo $this->_tpl_vars['value']->src_big; ?>
"/>
				</div>
				<div class="popContent">
					<div class="text"><?php echo $this->_tpl_vars['value']->imgs_content; ?>
</div>
					
				</div>
			</li>
     	 <?php endforeach; endif; unset($_from); ?>
			
			
		</ul>
	</div>
</div>
<div class="smallimg_container" id="popNav">
	<div class="cho_container">
		<div class="choose_img">
		<?php $_from = $this->_tpl_vars['oneArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
			<img src="<?php echo $this->_tpl_vars['value']->src_small; ?>
" width="101" height="62"/>
     	 <?php endforeach; endif; unset($_from); ?>
			
  	  </div>
	</div>
	<div class="small_prev img_btn">prev</div>
	<div class="small_next img_btn">prev</div>
</div>
</body>
</html>