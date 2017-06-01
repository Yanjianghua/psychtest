<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:20:35
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\m\common\footer.html" */ ?>
<?php /*%%SmartyHeaderCode:255057249503492378-42229796%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8bcb6fa1cf0b57e7d0a4b8de6a42f887a6a71870' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\m\\common\\footer.html',
      1 => 1444400799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '255057249503492378-42229796',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'channels' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_572495034abb55_36881113',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572495034abb55_36881113')) {function content_572495034abb55_36881113($_smarty_tpl) {?><div class="clear"></div>
<div style="width:100%; height:8px; overflow:hidden;"></div>
<div class="footer">
	<div class="foot_nav">
		<ul>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['channels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
			<li><a href="<?php echo formatUrl('channel_m',$_smarty_tpl->tpl_vars['v']->value['dir'],'');?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a>
			</li>
			<?php } ?>
		</ul>
	</div>
	<div class="foot_top">
		<a href="javascript:void(0);" id="returnTop">返回顶部</a>
	</div>
	<div class="banquan1">
		<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/m/js/wap_bottom.js"><?php echo '</script'; ?>
>
	</div>
</div>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/m/js/wap_top.js"><?php echo '</script'; ?>
><?php }} ?>
