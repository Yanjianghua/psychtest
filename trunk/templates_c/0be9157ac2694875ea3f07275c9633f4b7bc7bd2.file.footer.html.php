<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 16:32:51
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\common\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:258457246db36e3771-40496237%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0be9157ac2694875ea3f07275c9633f4b7bc7bd2' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\common\\footer.html',
      1 => 1456102226,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '258457246db36e3771-40496237',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'channels' => 0,
    'v' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57246db36f49a2_11033101',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246db36f49a2_11033101')) {function content_57246db36f49a2_11033101($_smarty_tpl) {?><div class="clear20"></div>
<div id="footer">
	<div class="f_x">
		<div class="f_x_ul">
			<ul>
				<li><a href="<?php echo formatUrl('home');?>
">首页</a><span>|</span></li>
				<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['channels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
				<li><a href="<?php echo formatUrl('channel',$_smarty_tpl->tpl_vars['v']->value['dir'],'');?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a><?php if ($_smarty_tpl->tpl_vars['k']->value<count($_smarty_tpl->tpl_vars['channels']->value)) {?><span>|</span><?php }?></li>
				<?php } ?>
			</ul>

		</div>
	</div>
	<div class="clear20"></div>
	<p class="pp">内容来自互联网如有侵权请联系我们删除
		<br>
	</p>
</div><?php }} ?>
