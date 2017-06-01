<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:20:35
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\m\common\header.html" */ ?>
<?php /*%%SmartyHeaderCode:1452057249503420db4-84643943%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f38455aba21392c4ae8ecf1ea8fa4fbc9c1b2e53' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\m\\common\\header.html',
      1 => 1444400799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1452057249503420db4-84643943',
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
  'unifunc' => 'content_572495034616e2_53483591',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572495034616e2_53483591')) {function content_572495034616e2_53483591($_smarty_tpl) {?><div class="header">
	<div class="time">
		<?php echo '<script'; ?>
 language="JavaScript">
			var dayNames = new Array("星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六");
					Stamp = new Date();
					document.write("" + Stamp.getFullYear() + "年" + (Stamp.getMonth() + 1) + "月" + Stamp.getDate() + "日" + " " + dayNames[Stamp.getDay()] + "  " + Stamp.getHours() + ":" + Stamp.getMinutes() + "");
		<?php echo '</script'; ?>
>
	</div>
	<div class="shouye"><a href="<?php echo formatUrl('home_m');?>
">首页</a></div>
</div>
<div class="clear"></div>
<div class="nav">
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
<div class="clear"></div><?php }} ?>
