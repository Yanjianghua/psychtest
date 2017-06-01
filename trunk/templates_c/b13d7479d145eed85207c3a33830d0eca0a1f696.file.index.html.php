<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-02 12:47:12
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\users\index.html" */ ?>
<?php /*%%SmartyHeaderCode:262825726dbd0525ec7-29340647%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b13d7479d145eed85207c3a33830d0eca0a1f696' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\users\\index.html',
      1 => 1447039919,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '262825726dbd0525ec7-29340647',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5726dbd0649565_81907669',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5726dbd0649565_81907669')) {function content_5726dbd0649565_81907669($_smarty_tpl) {?><!DOCTYPE html>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
	<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

	<?php echo '<script'; ?>
 src="/statics/admin/js/admin_users/data_table_body.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 src="/statics/admin/js/admin_users/ad.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
>
		function FindData() {
			$('#data_table_body').datagrid('load', {
				username: $('#username').val(),
				status: $("#status").val()
			});
		}
	<?php echo '</script'; ?>
>
</head>

<body>
<div id="window"></div>
<div class="main">
	<div>
		<label>
			<input class="easyui-searchbox" id="username" style="width:200px" data-options="prompt:'请输入用户名'" /> 用户状态：
			<select id="status">
				<option value="">不限</option>
				<option value="1">启用</option>
				<option value="0">禁用</option>
			</select>
			<a href="javascript:FindData()" class="easyui-linkbutton" data-options="iconCls:'icon-search'">查询</a>
		</label>
	</div>
	<div id="data_table" style="float: left;">
		<table id="data_table_body">

		</table>
	</div>
</div>
</body>

</html><?php }} ?>
