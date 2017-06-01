<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 22:05:43
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\message\index.html" */ ?>
<?php /*%%SmartyHeaderCode:243665724b6a147fff5-01691914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'abc7b854ba9a2ea62b2e77a4657962f9496d4a64' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\message\\index.html',
      1 => 1462024865,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '243665724b6a147fff5-01691914',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724b6a14ad232_54672951',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724b6a14ad232_54672951')) {function content_5724b6a14ad232_54672951($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php echo '<script'; ?>
 type="text/javascript" src="/statics/js/lib/my97date/WdatePicker.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/statics/admin/js/admin_article/message.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
>
			function FindData() {
				$('#data_table_body').datagrid('load', {
					name: $('#name').val(),
					starttime: $("#starttime").val(),
					endtime: $("#endtime").val(),
					title: $('#title').val(),
					included: $('#included').val()
				});
			}
		<?php echo '</script'; ?>
>
	</head>

	<body>
		<div id="window"></div>
		<div class="main">
			<div>
				<form action="/Message/get_list/" method="post">
					<label>
						<input class="easyui-searchbox" id="title" name="username" style="width:150px" data-options="prompt:'请输入姓名'" />
						<a href="javascript:FindData()" class="easyui-linkbutton" data-options="iconCls:'icon-search'">查询</a>
					</label>
				</form>
			</div>
			<div id="data_table" style="float: left;">
				<table id="data_table_body">

				</table>
			</div>
		</div>
	</body>

</html><?php }} ?>
