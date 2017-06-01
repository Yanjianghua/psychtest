<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 22:32:56
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\article\add.html" */ ?>
<?php /*%%SmartyHeaderCode:2700657246be37eb878-38467369%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd13dc5206e01e7852d4131aff58b5875c8bf7bf9' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\article\\add.html',
      1 => 1462026774,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2700657246be37eb878-38467369',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57246be38265f4_02608052',
  'variables' => 
  array (
    'channel' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246be38265f4_02608052')) {function content_57246be38265f4_02608052($_smarty_tpl) {?><form method="post" enctype="multipart/form-data" id="form" style="line-height: 40px; padding: 10px;">
	<div class="fm_2" style="clear: both;">
		<label>栏目选择:</label>
		<select name="dir" id="dir" class="easyui-combobox">
			<option value="">请选择栏目组</option>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['channel']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['v']->value['dir'];?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
			<?php } ?>
		</select>
	</div>
	<input type="hidden" name="id" value="" />
	<div>
		<label>标题名称:</label>
		<input id="title11" name="title" value="" />
	</div>
	<div>
		<label>关键字名称:</label>
		<input id="keywords" name="keywords" value="" />
	</div>
	<div>
		<label>描述测试:</label>
		<input id="description" name="description" value="" />
	</div>
	<div>
		<label>内容:</label>
		<input id="content" name="content" value="" />
	</div>
	<div>
		<label>测试选项1:</label>
		<input id="option1" name="option1" value="" />
	</div>
	<div>
		<label>测试选项1内容:</label>
		<input id="content1" name="content1" value="" />
	</div>
	<div>
		<label>测试选项2:</label>
		<input id="option2" name="option2" value="" />
	</div>
	<div>
		<label>测试选项2内容:</label>
		<input id="content2" name="content2" value="" />
	</div>
	<div>
		<label>测试选项3:</label>
		<input id="option3" name="option3" value="" />
	</div>
	<div>
		<label>测试选项3内容:</label>
		<input id="content3" name="content3" value="" />
	</div>
	<div>
		<label>测试选项4:</label>
		<input id="option4" name="option4" value="" />
	</div>
	<div>
		<label>测试选项4内容:</label>
		<input id="content4" name="content4" value="" />
	</div>
	<div>
		<div id="submit">提交</div>
	</div>
</form>
<?php echo '<script'; ?>
 type="text/javascript">
	function adAdd(check, button) {
		$('#form').form({
			url: "/Admin_Article/add/",
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
		$("#title11").textbox({
			width: "30%",
			prompt: "请输入标题名称",
			type: "text"
		});
		$('#keywords').textbox({
			width: "30%",
			prompt: "请输入关键字名称",
			type: "text"
		});
		$('#description').textbox({
			width: "80%",
			prompt: "请输入描述名称",
			type: "text"
		});
		$('#content').textbox({
			width: "80%",
			height:"300%",
			prompt: "请输入内容",
			type: "text"
		});
		$('#option1').textbox({
			width: "30%",
			prompt: "请输入选项1名称",
			type: "text"
		});
		$('#content1').textbox({
			width: "50%",
			height:"300%",
			prompt: "请输入选项1内容",
			type: "text"
		});
		$('#option2').textbox({
			width: "30%",
			prompt: "请输入选项1名称",
			type: "text"
		});
		$('#content2').textbox({
			width: "50%",
			height:"300%",
			prompt: "请输入选项1内容",
			type: "text"
		});
		$('#option3').textbox({
			width: "30%",
			prompt: "请输入选项1名称",
			type: "text"
		});
		$('#content3').textbox({
			width: "50%",
			height:"300%",
			prompt: "请输入选项1内容",
			type: "text"
		});
		$('#option4').textbox({
			width: "30%",
			prompt: "请输入选项1名称",
			type: "text"
		});
		$('#content4').textbox({
			width: "50%",
			height:"300%",
			prompt: "请输入选项1内容",
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
