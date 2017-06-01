<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:32:45
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\channel\index.html" */ ?>
<?php /*%%SmartyHeaderCode:30618572497dd20b904-66314449%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86c59cdae51d5fdd64bdb0d9278dbf9f986442b6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\channel\\index.html',
      1 => 1461937419,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '30618572497dd20b904-66314449',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'channel' => 0,
    'web_name' => 0,
    'list' => 0,
    'v' => 0,
    'data' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_572497dd29aab6_94784297',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572497dd29aab6_94784297')) {function content_572497dd29aab6_94784297($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $_smarty_tpl->tpl_vars['channel']->value['name'];?>
_<?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<link href="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/css/list_article.css?v=<?php echo config_item('system_version');?>
" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div class="clear"></div>
		<div id="content">
			<?php echo $_smarty_tpl->getSubTemplate ('../common/position.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<div class="c_left">
				<?php if (!empty($_smarty_tpl->tpl_vars['list']->value)) {?>
				<ul class="c_left_ul">
					<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['list']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
					<li>
						<h2><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
" target="_blank"><b><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</b></a></h2>
						<p><?php echo cut_str($_smarty_tpl->tpl_vars['v']->value['content'],100);?>
...<a target="_blank" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
">【阅读全文】</a></p>
					</li>
					<?php } ?>
				</ul>
				<?php }?>
				<div class="c_page">
					<?php echo $_smarty_tpl->tpl_vars['list']->value['pages'];?>

				</div>
			</div>

			<div class="c_right">
				<?php if (!empty($_smarty_tpl->tpl_vars['data']->value['recommand']['list'])) {?>
				<div class="re_wen">
					<h2>精彩测试</h2>
					<ul class="num">
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['recommand']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
						<li><span class="num_n" <?php if ($_smarty_tpl->tpl_vars['k']->value<3) {?> style="background-color:#f46e62" <?php }?>><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</span> <a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
						<?php } ?>
					</ul>
				</div>
				<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['hot']['list'])) {?>
				<div class="clear20"></div>
				<div class="re_ping">
					<h2>今日推荐</h2>
					<ul>
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['hot']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
						<li><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
						<?php } ?>
					</ul>
				</div>
				<?php }?>
				</div>

			</div>
		</div>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div style="display: none;">
			<?php echo config_item('cnzz');?>

		</div>
	</body>

</html><?php }} ?>
