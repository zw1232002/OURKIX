<?php /* Smarty version 2.6.26, created on 2012-07-08 19:51:23
         compiled from front/include/top_nav.tpl */ ?>
<div class="top_nav">
  <ul class="top_nav_list">
  <?php $_from = $this->_tpl_vars['mainNav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
  	<li><a href="index.php?id=<?php echo $this->_tpl_vars['value']->id; ?>
"><?php echo $this->_tpl_vars['value']->nav_name; ?>
</a></li>
  <?php endforeach; endif; unset($_from); ?>
  </ul>
  <div class="login"><a href="#">24311 ONLINE</a> | <a href="#">LOG IN</a> | <a href="#">REGISTER</a></div>
</div>