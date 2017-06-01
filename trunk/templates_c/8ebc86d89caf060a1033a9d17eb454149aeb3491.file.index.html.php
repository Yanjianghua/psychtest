<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-05-01 00:29:53
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\layout\index.html" */ ?>
<?php /*%%SmartyHeaderCode:146365724887e5f1cf8-16955377%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8ebc86d89caf060a1033a9d17eb454149aeb3491' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\layout\\index.html',
      1 => 1462033753,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '146365724887e5f1cf8-16955377',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_5724887e8f39c4_88760216',
  'variables' => 
  array (
    'web_name' => 0,
    'data' => 0,
    'k' => 0,
    'v' => 0,
    'i' => 0,
    'v1' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5724887e8f39c4_88760216')) {function content_5724887e8f39c4_88760216($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<link href="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/css/index_article.css?v=<?php echo config_item('system_version');?>
" rel="stylesheet" type="text/css" />
	</head>

	<body>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div id="content">
			<div id="content_s">
				<div class="s_l">
					<h2 class="t_t"><a>神测</a></h2> <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['head']['list'])) {?>
					<ul class="s_l_t">
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['head']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <?php if ($_smarty_tpl->tpl_vars['k']->value%4!=0) {?> <?php continue 1;?> <?php }?>
						<li class="text_blue">
							<a class="text_blue" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value]['dir'],$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value]['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a>
						</li>
						<li>
							<?php if (isset($_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+1])) {?>
							<a class="li_a1" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+1]['dir'],$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+1]['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+1]['title'];?>
</a> <?php }?> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+2])) {?>
							<a class="li_a2" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+2]['dir'],$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+2]['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+2]['title'];?>
</a> <?php }?> <?php if (isset($_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+3])) {?>
							<a class="li_a3" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+3]['dir'],$_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+3]['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['head']['list'][$_smarty_tpl->tpl_vars['k']->value+3]['title'];?>
</a> <?php }?>
						</li>
						<?php } ?>
					</ul>
					<?php }?>
					<div class="clear20"></div>
				</div>
				<?php if (!empty($_smarty_tpl->tpl_vars['data']->value['newest']['list'])) {?>
				<div class="s_c">
					<span><a>最新测试</a></span>
					<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['newest']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?> <?php if ($_smarty_tpl->tpl_vars['k']->value%5!=0) {
continue 1;
}?> <?php if ($_smarty_tpl->tpl_vars['k']->value>=5) {?>
					<div class="line"></div>
					<?php }?>
					<ul<?php if ($_smarty_tpl->tpl_vars['k']->value<5) {?> style="margin-top:20px;" <?php }?>>
						<?php  $_smarty_tpl->tpl_vars['i'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['i']->value = 0;
  if ($_smarty_tpl->tpl_vars['i']->value<5) { for ($_foo=true;$_smarty_tpl->tpl_vars['i']->value<5; $_smarty_tpl->tpl_vars['i']->value++) {
?> <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['newest']['list'][$_smarty_tpl->tpl_vars['k']->value+$_smarty_tpl->tpl_vars['i']->value])) {?> <li><a target="_blank" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['data']->value['newest']['list'][$_smarty_tpl->tpl_vars['k']->value+$_smarty_tpl->tpl_vars['i']->value]['dir'],$_smarty_tpl->tpl_vars['data']->value['newest']['list'][$_smarty_tpl->tpl_vars['k']->value+$_smarty_tpl->tpl_vars['i']->value]['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['data']->value['newest']['list'][$_smarty_tpl->tpl_vars['k']->value+$_smarty_tpl->tpl_vars['i']->value]['title'];?>
</a></li>
							<?php }?> <?php }} ?>
					</ul>
					<?php } ?>
				</div>
				<?php }?>
				<div class="s_r">
					<span class="s_r_s"><a style="color:#589ede" href="#">一周排行榜</a></span> <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['recommandimg']['list'])) {?>
					<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['recommand']['list'])) {?>
					<ul class="num">
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['recommand']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
						<li><span class="num_n" <?php if ($_smarty_tpl->tpl_vars['k']->value<3) {?> style="background-color:#f46e62" <?php }?>><?php echo $_smarty_tpl->tpl_vars['k']->value+1;?>
</span><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
						<?php } ?>
					</ul>
					<?php }?>
				</div>
			</div>
			<div class="clear20"></div>
			<!-- 栏目内容 start-->
			<div class="content_z">
				<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['mod']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
				<div class="c_z<?php if ($_smarty_tpl->tpl_vars['k']->value%3==0) {?> c_z_l<?php }
if ($_smarty_tpl->tpl_vars['k']->value%3==2) {?> c_z_r<?php }?>">
					<h2><a href="<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['v']->value['dir'];?>
<?php $_tmp1=ob_get_clean();?><?php echo formatUrl('channel',$_tmp1,'');?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['name'];?>
</a></h2>
					<?php if (!empty($_smarty_tpl->tpl_vars['v']->value['head']['list'])) {?>
					<div class="c_z_pic_t">
						<div class="c_z_pic">
							<a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['dir'],$_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['id']);?>
"><img src="<?php echo $_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['thumb'];?>
" /></a>
						</div>
						<div class="c_z_t">
							<span><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['dir'],$_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['title'];?>
</a></span>
							<p>
								<?php echo cut_str($_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['content'],25);?>
...<a style="color:#0175c1" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['dir'],$_smarty_tpl->tpl_vars['v']->value['head']['list'][0]['id']);?>
" target="_blank">[详细]</a>
							</p>
						</div>

					</div>
					<?php }?>
					<?php if (!empty($_smarty_tpl->tpl_vars['v']->value['list'])) {?>
					<ul>
						<?php  $_smarty_tpl->tpl_vars['v1'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v1']->_loop = false;
 $_smarty_tpl->tpl_vars['k1'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['v']->value['list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v1']->key => $_smarty_tpl->tpl_vars['v1']->value) {
$_smarty_tpl->tpl_vars['v1']->_loop = true;
 $_smarty_tpl->tpl_vars['k1']->value = $_smarty_tpl->tpl_vars['v1']->key;
?>
						<li><a target="_blank" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v1']->value['dir'],$_smarty_tpl->tpl_vars['v1']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v1']->value['title'];?>
</a></li>
						<?php } ?>
					</ul>
					<?php }?>
				</div>
				<?php } ?>
			</div>
			<!-- 栏目内容 end-->
			<div class="clear"></div>
			<?php if (!empty($_smarty_tpl->tpl_vars['data']->value['last']['list']['list'])) {?>
			<div class="content_x">
				<span><a href="<?php echo formatUrl('channel',$_smarty_tpl->tpl_vars['data']->value['last']['dir'],'');?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['data']->value['last']['name'];?>
</a></span>
				<div class="c_x_ul">
					<ul>
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['last']['list']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
						<li>
							<p><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></p>
						</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['data']->value['rollnews']['list'])) {?>
			<div class="clear20"></div>
			<div class="content_x">
				<span><a href="<?php echo formatUrl('rollnews','');?>
" target="_blank">滚动测试</a></span>
			</div>
			<div class="c_x_ul" style="overflow:hidden;height:95px;">
				<ul class="roll_news">
					<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['data']->value['rollnews']['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
					<li><a target="_blank" href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
					<?php } ?>
				</ul>
			</div>
			<?php }?>
			<div class="clear20"></div>
		</div>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div style="display: none;">
			<?php echo config_item('cnzz');?>

		</div>
	</body>

</html><?php }} ?>
