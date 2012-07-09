{_foreach from=$allArticle key=key item=value_}
	<li class="NewsList_li clearfix">
     <div class="img">
       <ul>
         <!-- <li><span href="#">I like it!<em></em></span></li>
         <li><span href="#">不错哦,赞<em></em></span></li> -->
       </ul>
       <a href="?m=article&articleId={_$value->id_}"><img src="{_$value->thumb_s_}" width="240" height="160" /></a>
     </div>
     <h4><a href="?m=article&articleId={_$value->id_}">{_$value->title|mb_truncate:32:"...":true_}</a></h4>
     <span class="time">{_getDays date=$value->date_} days ago &middot; by staff &middot; {_$value->count_} views</span>
     <div class="tags">Tags: {_explodeString string=$value->tags split=',' joinLeft="<a href='#'>" joinRight='</a>'_}</div>
     <p>{_htmlspecialchars_decode val=$value->info truncate=160_}</p>
   </li>
{_/foreach_}