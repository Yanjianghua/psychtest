<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 21:36:16
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\menu\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:33765724b4d07efa32-93913299%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6737b5b49d10f11d73eb7cbed909aef0421d93fd' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\menu\\edit.html',
      1 => 1447061251,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '33765724b4d07efa32-93913299',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'father' => 0,
    'edit' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724b4d082b975_59185684',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724b4d082b975_59185684')) {function content_5724b4d082b975_59185684($_smarty_tpl) {?><form method="post" id="form" class="myform" style="line-height: 40px; padding: 10px;">
	<input type="hidden" name="id" />
	<div>
		<label>父名称:</label>
		<select name="pid" id="pid">

		</select>
	</div>
	<div>
		<label>菜单名称:</label>
		<input id="name" name="name" require="true" />
	</div>
	<div>
		<label>控制器名称:</label>
		<input id="controller" name="controller" require="true" />
	</div>
	<div class="row">
		<label>方法名称:</label>
		<input id="method" name="method" require="true" />
	</div>
	<div>
		<label>是否隐藏:</label>
		<input type="checkbox" name="hide" value="1" />
	</div>
	<div>
		<input type="submit" value="提交">
	</div>
</form>

<?php echo '<script'; ?>
 type="text/javascript">
	var data = <?php echo json_encode($_smarty_tpl->tpl_vars['father']->value);?>
;
	$("#pid").combotree({
		data: data,
		required: true,
		width: 500
	});
	$("#name").textbox({
		width: "30%",
		prompt: "请输入权限名称",
		type: "text"
	});
	$('#controller').textbox({
		width: "30%",
		prompt: "请输入控制器名称",
		type: "text"
	});
	$('#method').textbox({
		width: "30%",
		prompt: "请输入方法名称",
		type: "text"
	});
	<?php if (isset($_smarty_tpl->tpl_vars['edit']->value)) {?>
	var row = $("#data_table_body").datagrid("getSelected");
	$("#form").form("clear");
	$("#form").form("load", row);
	<?php }?>
	$('#form').form({
		url: "/Admin_Menu/add/",
		success: function(data) {
			data = JSON.parse(data);
			if (data && data.success) {
				$("#window").window("close");
				$("#data_table_body").treegrid("load");
			} else {
				alert(data.msg);
			}
		}
	});
<?php echo '</script'; ?>
><?php }} ?>
