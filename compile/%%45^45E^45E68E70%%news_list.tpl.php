<?php /* Smarty version 2.6.26, created on 2012-07-09 20:41:19
         compiled from front/include/news_list.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'mb_truncate', 'front/include/news_list.tpl', 10, false),array('function', 'getDays', 'front/include/news_list.tpl', 11, false),array('function', 'explodeString', 'front/include/news_list.tpl', 12, false),array('function', 'htmlspecialchars_decode', 'front/include/news_list.tpl', 13, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['allArticle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
	<li class="NewsList_li clearfix">
     <div class="img">
       <ul>
         <!-- <li><span href="#">I like it!<em></em></span></li>
         <li><span href="#">不错哦,赞<em></em></span></li> -->
       </ul>
       <a href="?m=article&articleId=<?php echo $this->_tpl_vars['value']->id; ?>
"><img src="<?php echo $this->_tpl_vars['value']->thumb_s; ?>
" width="240" height="160" /></a>
     </div>
     <h4><a href="?m=article&articleId=<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['value']->title)) ? $this->_run_mod_handler('mb_truncate', true, $_tmp, 32, "...", true) : smarty_modifier_mb_truncate($_tmp, 32, "...", true)); ?>
</a></h4>
     <span class="time"><?php echo smarty_function_getDays(array('date' => $this->_tpl_vars['value']->date), $this);?>
 days ago &middot; by staff &middot; <?php echo $this->_tpl_vars['value']->count; ?>
 views</span>
     <div class="tags">Tags: <?php echo smarty_function_explodeString(array('string' => $this->_tpl_vars['value']->tags,'split' => ',','joinLeft' => "<a href='#'>",'joinRight' => '</a>'), $this);?>
</div>
     <p><?php echo smarty_function_htmlspecialchars_decode(array('val' => $this->_tpl_vars['value']->info,'truncate' => 160), $this);?>
</p>
   </li>
<?php endforeach; endif; unset($_from); ?>