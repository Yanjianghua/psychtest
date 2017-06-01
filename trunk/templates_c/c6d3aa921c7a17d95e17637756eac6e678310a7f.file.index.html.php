<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-02 12:47:09
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\roles\index.html" */ ?>
<?php /*%%SmartyHeaderCode:2675726dbcd7f35a8-99495909%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c6d3aa921c7a17d95e17637756eac6e678310a7f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\roles\\index.html',
      1 => 1447031633,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2675726dbcd7f35a8-99495909',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5726dbcd854c32_67539745',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5726dbcd854c32_67539745')) {function content_5726dbcd854c32_67539745($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>后台系统</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php echo '<script'; ?>
 src="/statics/admin/js/admin_roles/data_table_body.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/statics/admin/js/admin_roles/ad.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
>
			function FindData() {
				$('#data_table_body').datagrid('load', {
					name: $('#name').val(),
					status: $("#status").val()
				});
			}
		<?php echo '</script'; ?>
>
	</head>

	<body class="easyui-layout">
		<div id="window"></div>
		<div class="main">
			<div>
				<form name="searchform" method="post" action="" id="searchform">
					<input type="text"  class="easyui-searchbox" id="name" style="width:200px" data-options="prompt:'请输入用户组名'" > 用户组状态：
					<select name="status" id="status">
						<option value="">不限</option>
						<option value="<?php echo Roles_model::STATUS_ACTIVE;?>
">启用</option>
						<option value="<?php echo Roles_model::STATUS_FROZEN;?>
">禁用</option>
					</select>
					<a href="javascript:FindData()" class="easyui-linkbutton" data-options="iconCls:'icon-search'">查询</a>
				</form>
			</div>
			<div id="data_table" style="float: left;">
				<table id="data_table_body">

				</table>
			</div>
		</div>


	</body>

</html><?php }} ?>
