<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 16:16:34
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\login\index.html" */ ?>
<?php /*%%SmartyHeaderCode:21018572469e20777b3-64359102%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '881a013d83bf83ec7488ea6b074e75814a1ec398' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\login\\index.html',
      1 => 1439910294,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21018572469e20777b3-64359102',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_572469e20cbb44_63720558',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572469e20cbb44_63720558')) {function content_572469e20cbb44_63720558($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<title>登录</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php echo '<script'; ?>
 src="/statics/js/admin/Login/win.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/statics/js/admin/Login/form.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
	</head>

	<body>
		<div id="win">
			<form id="form" method="post" style="line-height: 60px; margin: 50px 40px 0 40px;">
				<input name="Submit" type="hidden" value="1">
				<div>
					<label for="username">用户名:</label>
					<input name="username" id="username">
				</div>
				<div>
					<label for="password">密　码:</label>
					<input name="password" id="password">
				</div>
				<div style="text-align: right;">
					<div id="submit">登录</div>
				</div>
			</form>
		</div>
	</body>

</html><?php }} ?>
