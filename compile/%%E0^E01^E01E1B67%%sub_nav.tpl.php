<?php /* Smarty version 2.6.26, created on 2012-07-08 21:10:05
         compiled from front/include/sub_nav.tpl */ ?>
<ul class="news_nav">
  <?php $_from = $this->_tpl_vars['subNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
  		<li><a href="?m=column&id=<?php echo $this->_tpl_vars['curId']; ?>
&columnId=<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
</a></li>
  <?php endforeach; endif; unset($_from); ?>
</ul>