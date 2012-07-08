<div class="top_nav">
  <ul class="top_nav_list">
  {_foreach from=$mainNav key=key item=value_}
  	<li><a href="index.php?id={_$value->id_}">{_$value->nav_name_}</a></li>
  {_/foreach_}
  </ul>
  <div class="login"><a href="#">24311 ONLINE</a> | <a href="#">LOG IN</a> | <a href="#">REGISTER</a></div>
</div>