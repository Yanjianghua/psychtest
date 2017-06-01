<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 16:32:51
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\common\importAll.html" */ ?>
<?php /*%%SmartyHeaderCode:1002857246db361ca18-17499318%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '660c1592c190af76bdaae9b7158763fad1cb656b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\common\\importAll.html',
      1 => 1444400799,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1002857246db361ca18-17499318',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57246db3626c30_48114914',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246db3626c30_48114914')) {function content_57246db3626c30_48114914($_smarty_tpl) {?><?php echo '<script'; ?>
 type="text/javascript" src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/js/jquery-1.8.2.min.js?v=<?php echo config_item('system_version');?>
"><?php echo '</script'; ?>
>
<?php if (config_item('txjob_special')) {?>
<?php echo '<script'; ?>
 type='text/javascript' src='http://statics.wy120.cn/statics/m?id=57575'><?php echo '</script'; ?>
>
<?php }?><?php }} ?>
