<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 16:19:59
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\menu\add.html" */ ?>
<?php /*%%SmartyHeaderCode:2073757246aaf063dc1-64294302%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8f916ebd8fde08c1bd0226d647308c72cdaf05a3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\menu\\add.html',
      1 => 1447207076,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2073757246aaf063dc1-64294302',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'father' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57246aaf08ef75_32890125',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246aaf08ef75_32890125')) {function content_57246aaf08ef75_32890125($_smarty_tpl) {?><form method="post" enctype="multipart/form-data" id="form" style="line-height: 40px; padding: 10px;">
	<input type="hidden" name="id" value="" />
	<div>
		<label>父名称:</label>
		<select name="pid" id="pid" value="">

		</select>
	</div>
	<div>
		<label>权限名称:</label>
		<input id="name" name="name" value="" />
	</div>
	<div>
		<label>控制器名称:</label>
		<input id="controller" name="controller" value="" />
	</div>
	<div>
		<label>方法名称:</label>
		<input id="method" name="method" value="" />
	</div>
	<div>
		<label>是否隐藏:</label>
		<input type="checkbox" name="hide" value="1" />
	</div>
	<div>
		<div id="submit">提交</div>
	</div>
</form>
<?php echo '<script'; ?>
 type="text/javascript">
	function adAdd(check, button) {
		$('#form').form({
			url: "/Admin_Menu/add/",
			onSubmit: function() {
				if(check() === false){
					return false;
				}
				$("#window").mask();
				return true;
			},
			success: function(data) {
				data = JSON.parse(data);
				if (!data.success) {
					alert(data.msg);
				} else {
					$("#data_table_body").datagrid("reload");
					$("#window").window("close");
				}
				$("#window").unmask();
			}
		});
		button();
	}
	adAdd(function() {
		var name = $.trim($("#name").val());
		if (name == "") {
			alert("权限名称不能为空");
			return false;
		}
	}, function() {
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
		$("#submit").linkbutton({
			iconCls: 'icon-ok'
		}).click(function() {
			$('#form').submit();
		});
	});
<?php echo '</script'; ?>
><?php }} ?>
