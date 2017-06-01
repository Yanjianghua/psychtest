<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 16:32:51
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\common\position.html" */ ?>
<?php /*%%SmartyHeaderCode:1074757246db36ba943-42726294%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '960bddc148f6e44d25bab7fac2d1b0536beaf905' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\common\\position.html',
      1 => 1444400799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1074757246db36ba943-42726294',
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
  'unifunc' => 'content_57246db36d19f7_02583650',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246db36d19f7_02583650')) {function content_57246db36d19f7_02583650($_smarty_tpl) {?><span class="man_baoxie">当前位置：<a href="<?php echo formatUrl('home');?>
"><?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</a> <?php if (!empty($_smarty_tpl->tpl_vars['channel']->value)) {?> &gt; <a href="<?php echo formatUrl('channel',$_smarty_tpl->tpl_vars['channel']->value['dir'],'');?>
"><?php echo $_smarty_tpl->tpl_vars['channel']->value['name'];?>
</a><?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['article']->value)) {?> &gt; <?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
 <?php }?></span><?php }} ?>
