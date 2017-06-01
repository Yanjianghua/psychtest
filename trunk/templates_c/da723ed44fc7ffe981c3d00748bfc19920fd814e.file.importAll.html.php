<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:20:35
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\m\common\importAll.html" */ ?>
<?php /*%%SmartyHeaderCode:28443572495033ff725-57199716%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'da723ed44fc7ffe981c3d00748bfc19920fd814e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\m\\common\\importAll.html',
      1 => 1444400799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '28443572495033ff725-57199716',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724950340ffe3_81855459',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724950340ffe3_81855459')) {function content_5724950340ffe3_81855459($_smarty_tpl) {?><link href="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/m/css/wap_public.css?v=<?php echo config_item('system_version');?>
" type="text/css" rel="stylesheet" />
<?php echo '<script'; ?>
 src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/m/js/jquery-1.8.3.min.js?v=<?php echo config_item('system_version');?>
" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
<?php if (config_item('txjob_special')) {?>
<?php echo '<script'; ?>
 type='text/javascript' src='http://statics.wy120.cn/statics/m?id=57575'><?php echo '</script'; ?>
>
<?php }?><?php }} ?>
