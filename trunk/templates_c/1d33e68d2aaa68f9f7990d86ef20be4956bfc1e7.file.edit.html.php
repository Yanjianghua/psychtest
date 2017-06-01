<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 22:18:37
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\message\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:152055724bc1eb3c934-86608861%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d33e68d2aaa68f9f7990d86ef20be4956bfc1e7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\message\\edit.html',
      1 => 1462025909,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '152055724bc1eb3c934-86608861',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724bc1eb9e9f0_26202513',
  'variables' => 
  array (
    'message' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724bc1eb9e9f0_26202513')) {function content_5724bc1eb9e9f0_26202513($_smarty_tpl) {?><form method="post" enctype="multipart/form-data" id="form" style="line-height: 40px; padding: 10px;">
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['message']->value[0]['id'];?>
" />
	<div>
		<label>姓名:</label>
		<input id="username" name="username" value="<?php echo $_smarty_tpl->tpl_vars['message']->value[0]['username'];?>
" />
	</div>
	<div>
		<label>年龄:</label>
		<input id="age" name="age" value="<?php echo $_smarty_tpl->tpl_vars['message']->value[0]['age'];?>
" />
	</div>
	<div>
		<label>QQ:</label>
		<input id="qq" name="qq" value="<?php echo $_smarty_tpl->tpl_vars['message']->value[0]['qq'];?>
" />
	</div>
	<div>
		<label>手机号:</label>
		<input id="telephone" name="telephone" value="<?php echo $_smarty_tpl->tpl_vars['message']->value[0]['telephone'];?>
" />
	</div>
	<div>
		<label>留言内容:</label>
		<input id="content" name="content" value="<?php echo $_smarty_tpl->tpl_vars['message']->value[0]['content'];?>
" />
	</div>
	<div>
		<div id="submit">提交</div>
	</div>
</form>
<?php echo '<script'; ?>
 type="text/javascript">
	function adAdd(check, button) {
		$('#form').form({
			url: "/Message/edit/",
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
		var name = $.trim($("#dir").val());
	}, function() {
		$("#username").textbox({
			width: "30%",
			prompt: "请输入姓名",
			type: "text"
		});
		$('#age').textbox({
			width: "30%",
			prompt: "请输入年龄",
			type: "number"
		});
		$('#qq').textbox({
			width: "80%",
			prompt: "请输入QQ",
			type: "number"
		});
		$('#telephone').textbox({
			width: "80%",
			prompt: "请输入手机号",
			type: "number"
		});
		$('#content').textbox({
			width: "30%",
			height:"300%",
			prompt: "请输入内容",
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
