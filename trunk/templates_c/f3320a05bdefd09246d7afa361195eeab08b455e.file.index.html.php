<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 22:20:33
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\message\index.html" */ ?>
<?php /*%%SmartyHeaderCode:254035724a674b1ade1-32415423%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3320a05bdefd09246d7afa361195eeab08b455e' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\message\\index.html',
      1 => 1462025870,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '254035724a674b1ade1-32415423',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724a674cae242_97675130',
  'variables' => 
  array (
    'web_name' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724a674cae242_97675130')) {function content_5724a674cae242_97675130($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<link href="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/css/index_article.css?v=<?php echo config_item('system_version');?>
" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div id="content">
			<form method="post" action="" enctype="multipart/form-data" id="form" style="line-height: 40px; padding: 10px;">
				<table style="font-size: 20px;">
					<tr>
						<td>
							<label>姓名:</label>
						</td>
						<td>
							<input type="text" style="width:300px;height:30px;" name="username" value="" />
						</td>
					</tr>
					<tr>
						<td>
							<label>年龄:</label>
						</td>
						<td>
							<input type="number" style="width:300px;height:30px;" name="age" value="" />
						</td>
					</tr>
					<tr>
						<td>
							<label>QQ:</label>
						</td>
						<td>
							<input type="number" style="width:300px;height:30px;" name="qq" value="" />
						</td>
					</tr>
					<tr>
						<td>
							<label>手机号:</label>
						</td>
						<td>
							<input type="number" style="width:300px;height:30px;" name="telephone" value="" />
						</td>
					</tr>
					<tr>
						<td>
							<label>留言内容:</label>
						</td>
						<td>
							<textarea name="content" rows="20" cols="100"></textarea>
						</td>
					</tr>
				</table>
				<div>
					<input style="width: 70px;height:40px;" name="content4" type="submit" value="提交" />
				</div>
			</form>
			<div class="clear20"></div>
		</div>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div style="display: none;">
			<?php echo config_item('cnzz');?>

		</div>
	</body>

</html><?php }} ?>
