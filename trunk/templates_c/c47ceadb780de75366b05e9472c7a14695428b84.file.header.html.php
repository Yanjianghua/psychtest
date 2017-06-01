<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 21:09:19
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\common\header.html" */ ?>
<?php /*%%SmartyHeaderCode:1790957246db36342e1-47039106%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c47ceadb780de75366b05e9472c7a14695428b84' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\common\\header.html',
      1 => 1462021757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1790957246db36342e1-47039106',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57246db36aaf27_27357775',
  'variables' => 
  array (
    'channel' => 0,
    'channels' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246db36aaf27_27357775')) {function content_57246db36aaf27_27357775($_smarty_tpl) {?><div id="top">
	<div class="top1">
		<div class="top1_l">
			<div class="t_left">
				<ul>
					<li<?php if (empty($_smarty_tpl->tpl_vars['channel']->value)) {?> style="font-weight:bold" <?php }?>><a href="<?php echo formatUrl('home');?>
">首页</a></li>
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['channels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
						<li<?php if (!empty($_smarty_tpl->tpl_vars['channel']->value)&&$_smarty_tpl->tpl_vars['channel']->value['id']==$_smarty_tpl->tpl_vars['v']->value['id']) {?> style="font-weight:bold" <?php }?>><a href="<?php echo formatUrl('channel',$_smarty_tpl->tpl_vars['v']->value['dir'],'');?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a>
							</li>
							<?php } ?>
				</ul>
			</div>

		</div>
		<div class="right_l">
			<ul>
				<li><a href="#">收藏网站</a><span>|</span></li>
				<li><a href="#">设为首页</a><span>|</span></li>
				<li><a href="<?php echo formatUrl('home_m');?>
">手机版</a></li>
			</ul>
		</div>

	</div>
</div>
<div class="clear"></div>
<div id="header">
	<?php if (config_item('hsdcw_special')) {?>
	<img src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/banner/banner4.jpg" width="1000" height="90">
	<?php } else { ?>
	<img src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/banner/banner<?php echo rand(1,3);?>
.jpg" width="1000" height="90">
	<?php }?>
</div>
<div class="clear"></div>

<div style="width:100%; height:45px;background-color:#0080d5;overflow:hidden">
	<ul id="nav">
		<li<?php if (empty($_smarty_tpl->tpl_vars['channel']->value)) {?> style="background-color:#379be9;" <?php }?>><a href="<?php echo formatUrl('home');?>
">首页</a></li>
			<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['channels']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
			<li<?php if (!empty($_smarty_tpl->tpl_vars['channel']->value)&&$_smarty_tpl->tpl_vars['channel']->value['id']==$_smarty_tpl->tpl_vars['v']->value['id']) {?> style="background-color:#379be9;" <?php }?>><a href="<?php echo formatUrl('channel',$_smarty_tpl->tpl_vars['v']->value['dir'],'');?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a>
			</li>
			<?php } ?>
		<li><a href="/Message/index/">留言板</a></li>
	</ul>
</div>
<div class="clear20"></div><?php }} ?>
