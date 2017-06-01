<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:02:16
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\article\edit.html" */ ?>
<?php /*%%SmartyHeaderCode:3945724892d99ff88-30818211%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bacdaae91d0ef22e9ba204cfb6ae50d2f918134c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\article\\edit.html',
      1 => 1462014063,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3945724892d99ff88-30818211',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724892d9ed5e0_98856708',
  'variables' => 
  array (
    'channel' => 0,
    'v' => 0,
    'article' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724892d9ed5e0_98856708')) {function content_5724892d9ed5e0_98856708($_smarty_tpl) {?><form method="post" enctype="multipart/form-data" id="form" style="line-height: 40px; padding: 10px;">
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
" <?php if ($_smarty_tpl->tpl_vars['article']->value[0]['dir']==$_smarty_tpl->tpl_vars['v']->value['dir']) {?> selected="selected" <?php }?>><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</option>
			<?php } ?>
		</select>
	</div>
	<input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['article']->value[0]['id'];?>
" />
	<div>
		<label>标题名称:</label>
		<input id="title11" name="title" value="<?php echo $_smarty_tpl->tpl_vars['article']->value[0]['title'];?>
" />
	</div>
	<div>
		<label>关键字名称:</label>
		<input id="keywords" name="keywords" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['keywords'];?>
" />
	</div>
	<div>
		<label>描述测试:</label>
		<input id="description" name="description" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['description'];?>
" />
	</div>
	<div>
		<label>内容:</label>
		<input id="content" name="content" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['content'];?>
" />
	</div>
	<div>
		<label>测试选项1:</label>
		<input id="option1" name="option1" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['option1'];?>
" />
	</div>
	<div>
		<label>测试选项1内容:</label>
		<input id="content1" name="content1" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['content1'];?>
" />
	</div>
	<div>
		<label>测试选项2:</label>
		<input id="option2" name="option2" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['option2'];?>
" />
	</div>
	<div>
		<label>测试选项2内容:</label>
		<input id="content2" name="content2" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['content2'];?>
" />
	</div>
	<div>
		<label>测试选项3:</label>
		<input id="option3" name="option3" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['option3'];?>
" />
	</div>
	<div>
		<label>测试选项3内容:</label>
		<input id="content3" name="content3" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['content3'];?>
" />
	</div>
	<div>
		<label>测试选项4:</label>
		<input id="option4" name="option4" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['option4'];?>
" />
	</div>
	<div>
		<label>测试选项4内容:</label>
		<input id="content4" name="content4" value="<?php echo $_smarty_tpl->tpl_vars['article']->value['add']['content4'];?>
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
			url: "/Admin_Article/edit/",
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
