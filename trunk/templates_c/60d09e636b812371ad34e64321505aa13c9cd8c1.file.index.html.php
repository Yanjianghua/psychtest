<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-02 12:47:04
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\admin\layout\index.html" */ ?>
<?php /*%%SmartyHeaderCode:31407572469ea4ab7f7-05555308%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '60d09e636b812371ad34e64321505aa13c9cd8c1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\admin\\layout\\index.html',
      1 => 1462164421,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '31407572469ea4ab7f7-05555308',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_572469ea4fb507_21216972',
  'variables' => 
  array (
    'login_user' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572469ea4fb507_21216972')) {function content_572469ea4fb507_21216972($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>后台系统</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php echo '<script'; ?>
 type="text/javascript" charset="utf-8">
			$(function() {
				$("#tree_menu").tree({
					lines: true,
					onClick: function (node) {
						console.log(node);
						if (node.controller && node.method) {
							var url = "/" + node.controller + "/" + node.method + "/";
							$('#sys_main').attr('src', url);
						}
					}
				});
			});
		<?php echo '</script'; ?>
>
	</head>

	<body class="easyui-layout">
		<div id="header" region="north" style="height:69px;">
			<div class="right">
				<img src="/statics/images/avatar.gif" />
				<span>欢迎您！<b><?php echo $_smarty_tpl->tpl_vars['login_user']->value['username'];?>
</b></span>
				<div class="links">
					<a href="/Admin_Login/logout/">安全退出</a>
				</div>
			</div>
		</div>

		<div region="west" title="导航菜单" split="true" style="width:200px">
			<div class="easyui-accordion" style="height:100%;">
				<div title="系统设置">
					<ul id="tree_menu" class="easyui-tree" data-options="url:'/Admin_Menu/get_menu/'"></ul>
				</div>
			</div>
		</div>

		<div region="center">
			<iframe id="sys_main" src="/Admin_Article/index/" height="100%" width="100%" frameborder='0' marginheight='0' marginwidth='0' scrolling='yes'></iframe>
		</div>

		<div id="footer" region="south" style="height:35px;">
			<center>
				这里是底部 <a href="#">联系我们</a>
			</center>
		</div>
	</body>

</html><?php }} ?>
