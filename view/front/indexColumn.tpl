<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>OURKIX</title>
{_include file=front/include/css_js.tpl_}
<link href="view/front/css/News_list.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
	(function (){
		coly.addEvent(window,"load",function (){
			
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
  {_include file=front/include/top_nav.tpl_}
  {_include file=front/include/logo_search.tpl_}
  <!--content start-->
  <div class="main clearfix">
    <div class="box_left">
      {_include file=front/include/sub_nav.tpl_}
      <div class="listBox_Art clearfix">
    		<div class="art_left">
    			<strong>Editor | Rafael</strong>
    			<a href="mailto:rafaelcao@kixtile.com">rafaelcao@kixtile.com</a>
    			<img src="view/front/images/art_img.jpg" height="113" width="114" style="padding-left:3px"/>
    		</div>
    		
    		<div class="art_right">
	    		{_foreach from=$nav_infos key=key item=value_}
	    			<span>{_$value->nav_title_}</span>
	    			<div class="text">{_$value->nav_info | truncate:30:"...":true_}</div>
				{_/foreach_}
    			
    			
    		</div>
    		
    	</div>
    	<div class="listBox_News">
	        <h4 class="sort">NEWS | 最新资讯</h4>
	        <ul class="NewsList_ul">
	          {_foreach from=$allArticle key=key item=value_}
	      	 		  <li class="NewsList_li clearfix">
			            <div class="img">
			              <ul>
			                <!-- <li><span href="#">I like it!<em></em></span></li>
			                <li><span href="#">不错哦,赞<em></em></span></li> -->
			              </ul>
			              <a href="#"><img src="{_$value->thumb_s_}" width="240" height="160" /></a>
			            </div>
			            <h4><a href="#">{_$value->title_}</a></h4>
			            <span class="time">{_getDays date=$value->date_} days ago &middot; by staff &middot; {_$value->count_} views</span>
			            <div class="tags">Tags: {_explodeString string=$value->tags split=','_}</div>
			            <p>{_htmlspecialchars_decode val=$value->info_}</p>
			          </li>
	      	 	{_/foreach_}
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
  {_include file=front/include/footer.tpl_}
</div>
</body>
</html>
