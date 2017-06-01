<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:20:35
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\m\common\position.html" */ ?>
<?php /*%%SmartyHeaderCode:2625757249503470a96-35088359%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a92164465a1944ebc1f79a99d997dd5964e9fbb1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\m\\common\\position.html',
      1 => 1444400799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2625757249503470a96-35088359',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'web_name' => 0,
    'channel' => 0,
    'article' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57249503483314_72866389',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57249503483314_72866389')) {function content_57249503483314_72866389($_smarty_tpl) {?><div class="position">
	<a href="<?php echo formatUrl('home_m');?>
"><?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</a><?php if (!empty($_smarty_tpl->tpl_vars['channel']->value)) {?> &gt; <a href="<?php echo formatUrl('channel_m',$_smarty_tpl->tpl_vars['channel']->value['dir'],'');?>
"><?php echo $_smarty_tpl->tpl_vars['channel']->value['name'];?>
</a><?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['article']->value)) {?> &gt; <?php echo $_smarty_tpl->tpl_vars['article']->value['title'];
}?>
</div><?php }} ?>
