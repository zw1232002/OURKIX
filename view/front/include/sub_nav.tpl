<ul class="news_nav">
  {_foreach from=$subNav key=key item=value_}
  		<li><a href="?m=column&id={_$curId_}&columnId={_$value->id_}">{_$value->nav_name_}</a></li>
  {_/foreach_}
</ul>