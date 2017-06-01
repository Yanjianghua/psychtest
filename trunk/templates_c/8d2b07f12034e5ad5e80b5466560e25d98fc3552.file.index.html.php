<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 22:24:13
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\article\index.html" */ ?>
<?php /*%%SmartyHeaderCode:277315724694b070425-53660253%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8d2b07f12034e5ad5e80b5466560e25d98fc3552' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\article\\index.html',
      1 => 1462026251,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '277315724694b070425-53660253',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724694b0a26c6_23115127',
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724694b0a26c6_23115127')) {function content_5724694b0a26c6_23115127($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
		<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php echo '<script'; ?>
 type="text/javascript" src="/statics/js/lib/my97date/WdatePicker.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 src="/statics/admin/js/admin_article/data_table_body.js" type="text/javascript" charset="utf-8"><?php echo '</script'; ?>
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
			$(function() {
				var today = new Date();
				$("#starttime").val(today.Format("YYYY-MM-DD 00:00:00"));
				$("#endtime").val(today.Format("YYYY-MM-DD 23:59:59"));
				var oldStarttime = $("#starttime").val();
				var oldEndtime = $("#endtime").val();
				$("#starttime").focus(function() {
					WdatePicker({
						dateFmt: 'yyyy-MM-dd HH:mm:ss',
						opposite: true,
						onpicked: function() {
							if ($(this).val().strtotime().getTime() > $("#endtime").val().strtotime().getTime()) {
								alert("起始时间不能大于结束时间");
								$("#starttime").val(oldStarttime);
							}
							oldStarttime = $(this).val()
						}
					});
				});
				$("#endtime").focus(function() {
					WdatePicker({
						dateFmt: 'yyyy-MM-dd HH:mm:ss',
						opposite: true,
						onpicked: function() {
							if ($(this).val().strtotime().getTime() < $("#starttime").val().strtotime().getTime()) {
								alert("结束时间不能小于起始时间");
								$("#endtime").val(oldEndtime);
							}
							oldEndtime = $(this).val()
						}
					});
				});
			});
		<?php echo '</script'; ?>
>
	</head>

	<body>
		<div id="window"></div>
		<div class="main">
			<div>
				<form action="/Admin_Article/get_list/" method="post">
					<input type="hidden" name="type" value="csv" />
					<label>
						<input class="easyui-searchbox" id="title" name="title" style="width:150px" data-options="prompt:'请输入文章标题'" />
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
