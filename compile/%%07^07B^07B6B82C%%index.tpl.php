<?php /* Smarty version 2.6.26, created on 2012-07-09 19:35:32
         compiled from front/index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'getDays', 'front/index.tpl', 66, false),array('function', 'htmlspecialchars_decode', 'front/index.tpl', 69, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OURKIX</title>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/css_js.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<script type="text/javascript">
	(function (){
		coly.addEvent(window,"load",function (){
			var imgDiv=coly.$("#con_box_index"),imgCon=coly.$(".content_box",imgDiv)[0];
			var slider=new coly.SlideImg({
				imgContainer:imgCon,
				btnsClass:"box_btns",
				hoverClass:"hover",
				t:3800,
				scrollSpeed:600
			});
			slider.start();
			//文章排序js
			var sortDiv=coly.$("#sortDiv"),dayDiv=coly.$(".article_day",sortDiv)[0],weekDiv=coly.$(".article_week",sortDiv)[0],sortBtn=coly.$(".article_sort_btn",sortDiv)[0];
			showFlag=true;
			coly.addEvent(sortBtn,"click",sortFunc);
			function sortFunc(){
				var hiddenDiv=coly.$(".btn_hd",sortDiv)[0];
				if(showFlag){
					hiddenDiv.css("display","block");
					showFlag=false;
				}else{
					hiddenDiv.css("display","none");
					showFlag=true;
				}
				coly.addEvent(hiddenDiv,"click",function (){
					this.delClass("btn_hd");
					coly.each(this.siblings(),function (){
						if(/^article_sort_btn$/.test(this.className)){
							return;
						}
						this.addClass("btn_hd");
						this.css("display","none");
					});
					if(!showFlag){
						showFlag=true;
					}
				});
			}
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
      <div id="con_box_index">
      	 <ul class="content_box clearfix index_slider">
      	 	<?php $_from = $this->_tpl_vars['topArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
      	 		<li>
		          <a href="?m=article&articleId=<?php echo $this->_tpl_vars['value']->id; ?>
"><img src="<?php echo $this->_tpl_vars['value']->thumb_b; ?>
"  height="420" /></a>
		          <h2><a href="#"><?php echo $this->_tpl_vars['value']->title; ?>
</a></h2>
		          <span class="time"><?php echo smarty_function_getDays(array('date' => $this->_tpl_vars['value']->date), $this);?>
 days ago &middot; by <a href="#">staff</a> &middot; <?php echo $this->_tpl_vars['value']->count; ?>
 views</span>
		          <div class="tags">Tags: <a href="#">Clot</a>, <a href="#">Fashion</a>, <a href="#">Gildas Loaec</a>, <a href="#">Interviews</a>, <a href="#">Kitsune</a></div>
		          <div class="text">
		          <?php echo smarty_function_htmlspecialchars_decode(array('val' => $this->_tpl_vars['value']->content,'truncate' => 950), $this);?>

		          </div>
		        </li>
      	 	<?php endforeach; endif; unset($_from); ?>
	        
	        
     	 </ul>
      </div>
    </div>
    <div class="box_right">
      <div class="listBox_Shading mt25 mb0">
        <h4 class="sort">HEADLINES | 头条</h4>
        <ul class="headlines clearfix">
          <li>
            <img src="view/front/images/test/pic02.jpg" width="260" height="173" />
            <h5><a href="#">FEATURE | 专题</a></h5>
            <p><a href="#">We found the Air Jordan One "BAND" in...We found the Air Jordan One "BAND" in...</a></p>
          </li>
          <li>
            <img src="view/front/images/test/pic02.jpg" width="260" height="173" />
            <h5><a href="#">FEATURE | 专题</a></h5>
            <p><a href="#">We found the Air Jordan One "BAND" in...</a></p>
          </li>
          <li>
            <img src="view/front/images/test/pic02.jpg" width="260" height="173" />
            <h5><a href="#">FEATURE | 专题</a></h5>
            <p><a href="#">We found the Air Jordan One "BAND" in...</a></p>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="main clearfix">
    <div class="box_left">
      <div class="listBox_News">
        <h4 class="sort">NEWS | 最新资讯</h4>
        <ul class="NewsList_ul">
        	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "front/include/news_list.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
        </ul>
        <ul class="PageFen">
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
      </div>
    </div>
    <div class="box_right">
      
      
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
      <div class="thead">
        <a href="#"><img src="view/front/images/test/ad1.jpg" width="300" height="250" /></a>
      </div>
      <div class="listBox_Shading">
        <h4 class="sort">FRIENDS | 友邻</h4>
        <div class="friendsBox">
          <ul class="friends clearfix">
            <li><a href="http://www.hoopchina.com"><img src="view/front/images/friends/hupu.jpg" width="80" height="80"/></a></li>
            <li><a href="http://www.kenlu.net" ><img src="view/front/images/friends/kanlv.jpg" width="80" height="80" /></a></li>
            <li><a href="http://www.hk-kicks.com/"><img src="view/front/images/friends/hk.jpg" width="80" height="80" /></a></li>
            <li><a href="http://sneakernews.com/" ><img src="view/front/images/friends/snak.jpg" width="80" height="80" /></a></li>
            <li><a href="http://www.skatehere.com/"><img src="view/front/images/friends/ska.jpg" width="80" height="80" /></a></li>
            <li><a href="#"><img src="view/front/images/pic05.jpg" width="80" height="80" /></a></li>
            <li><a href="#"><img src="view/front/images/pic05.jpg" width="80" height="80" /></a></li>
            <li><a href="#"><img src="view/front/images/pic05.jpg" width="80" height="80" /></a></li>
            <li><a href="#"><img src="view/front/images/pic05.jpg" width="80" height="80" /></a></li>
          </ul>
        </div>
      </div>
      <div class="listBox_Shading mb0">
        <h4 class="sort">FOLLOW US | 更多关注</h4>
        <ul class="follow clearfix">
          <li class="weibo"><a href="#">weibo</a></li>
          <li class="qq"><a href="#">qq</a></li>
          <li class="diandian"><a href="#">qq</a></li>
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
</body>
</html>