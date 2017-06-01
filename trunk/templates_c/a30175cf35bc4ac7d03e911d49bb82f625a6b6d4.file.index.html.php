<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 16:16:42
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\user\index.html" */ ?>
<?php /*%%SmartyHeaderCode:16060572469ea823635-22687574%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a30175cf35bc4ac7d03e911d49bb82f625a6b6d4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\user\\index.html',
      1 => 1446800414,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16060572469ea823635-22687574',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_572469ea87b5c6_36052501',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572469ea87b5c6_36052501')) {function content_572469ea87b5c6_36052501($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php echo '<script'; ?>
 src="/statics/admin/js/users/data_table_body.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/statics/admin/js/users/ad.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
>
			function FindData() {
				$('#data_table_body').datagrid('load', {
					name: $('#name').val(),
					usertype: $("#usertype").val()
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
					<input class="easyui-searchbox" id="name" style="width:200px" data-options="prompt:'请输入用户名'" /> 账户类型：
					<select id="usertype">
						<option value="">不限</option>
						<option value="normal">普通用户</option>
						<option value="inneruser">内部用户</option>
						<option value="gooduser">重点客户</option>
						<option value="oauser">智能OA账户</option>
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
