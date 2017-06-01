<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 19:20:35
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\m\article\index.html" */ ?>
<?php /*%%SmartyHeaderCode:1770657249503262839-55550881%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3e56a229fe8adfddeff4a8e748637ba00b059c3' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\m\\article\\index.html',
      1 => 1458892969,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1770657249503262839-55550881',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'article' => 0,
    'web_name' => 0,
    'addata' => 0,
    'readnumswich' => 0,
    'readnum' => 0,
    'adv' => 0,
    'prevArticle' => 0,
    'nextArticle' => 0,
    'relateArticle' => 0,
    'v' => 0,
    'newArticle' => 0,
    'ad' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_572495033d63c8_91526633',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_572495033d63c8_91526633')) {function content_572495033d63c8_91526633($_smarty_tpl) {?><!DOCTYPE html>
<html>

	<head>
		<meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
		<meta content="telephone=no" name="format-detection" />
		<meta content="email=no" name="format-detection" />
		<meta name="keywords" content="<?php if ($_smarty_tpl->tpl_vars['article']->value['keywords']) {
echo $_smarty_tpl->tpl_vars['article']->value['keywords'];
} else {
echo $_smarty_tpl->tpl_vars['article']->value['title'];
}?>">
		<meta name="description" content="<?php if ($_smarty_tpl->tpl_vars['article']->value['description']) {
echo $_smarty_tpl->tpl_vars['article']->value['description'];
} else {
echo cut_str(strip_tags($_smarty_tpl->tpl_vars['article']->value['content']),250);
}?>" />
		<meta charset="utf-8">
		<title><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
_<?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<link rel="stylesheet" type="text/css" href="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/m/css/wap_article.css?v=<?php echo config_item('system_version');?>
"> <?php if (!isset($_smarty_tpl->tpl_vars['addata']->value)) {?>
		<?php echo '<script'; ?>
 type="text/javascript" id="ad" data-url="<?php echo formatUrl('domain');
echo formatUrl('home');?>
" data-uid="<?php echo $_smarty_tpl->tpl_vars['article']->value['uid'];?>
" data-typeid="2" src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/js/ad.js?v=<?php echo config_item('system_version');?>
"><?php echo '</script'; ?>
>
		<?php }?>
	</head>

	<body>
		<div class="all">
			<?php echo $_smarty_tpl->getSubTemplate ('../common/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 <?php echo $_smarty_tpl->getSubTemplate ('../common/position.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			<div class="article">
				<div class="art_title"><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</div>
				<div class="art_info">
					<span style="color:#1962cc;"><?php echo $_smarty_tpl->tpl_vars['article']->value['editor'];?>
</span>
					<span><?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['article']->value['addtime']);?>
</span>
					<?php if ($_smarty_tpl->tpl_vars['readnumswich']->value) {?><span>阅读量:<?php echo $_smarty_tpl->tpl_vars['readnum']->value;?>
</span><?php }?>
				</div>
				<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
					<div adid="11">
						<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][11])) {?>
						<?php echo '<script'; ?>
 type='text/javascript' src='http://st.niudai120.com/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][11]['scriptid'];?>
'><?php echo '</script'; ?>
>
						<?php }?>
					</div>
				<?php } else { ?>
					<div adid="11">
						<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][11])) {?>
						<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][11]['scriptid'];?>
");<?php echo '</script'; ?>
>
						<?php }?>
					</div>
				<?php }?>
				<div class="neirong">
					<?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>

				</div>
				<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
					<div adid="12">
						<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][12])) {?>
						<?php echo '<script'; ?>
 type='text/javascript' src='http://st.niudai120.com/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][12]['scriptid'];?>
'><?php echo '</script'; ?>
>
						<?php }?>
					</div>
				<?php } else { ?>
					<div adid="12">
						<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][12])) {?>
						<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][12]['scriptid'];?>
");<?php echo '</script'; ?>
>
						<?php }?>
					</div>
				<?php }?>
				<div class="share">
					<span>分享到：</span>
					<div class="bdsharebuttonbox tubiao">
						<a href="#" class="bds_more" data-cmd="more"></a>
						<a href="#" class="bds_qzone" data-cmd="qzone"></a>
						<a href="#" class="bds_tsina" data-cmd="tsina"></a>
						<a href="#" class="bds_tqq" data-cmd="tqq"></a>
						<a href="#" class="bds_renren" data-cmd="renren"></a>
						<a href="#" class="bds_weixin" data-cmd="weixin"></a>
					</div>
					<?php echo '<script'; ?>
>
						window._bd_share_config = {
							"common": {
								"bdSnsKey": {},
								"bdText": "",
								"bdMini": "2",
								"bdPic": "",
								"bdStyle": "0",
								"bdSize": "16"
							},
							"share": {},
							"image": {
								"viewList": ["qzone", "tsina", "tqq", "renren", "weixin"],
								"viewText": "分享到：",
								"viewSize": "16"
							},
							"selectShare": {
								"bdContainerClass": null,
								"bdSelectMiniList": ["qzone", "tsina", "tqq", "renren", "weixin"]
							}
						};
						with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
					<?php echo '</script'; ?>
>
				</div>
			</div>
			<?php if (!empty($_smarty_tpl->tpl_vars['prevArticle']->value)) {?>
			<div class="pre"><a href="<?php echo formatUrl('article_m',$_smarty_tpl->tpl_vars['prevArticle']->value['dir'],$_smarty_tpl->tpl_vars['prevArticle']->value['id']);?>
">上一篇：<?php echo $_smarty_tpl->tpl_vars['prevArticle']->value['title'];?>
</a></div>
			<?php } else { ?>
			<div class="pre"><a>上一篇：没有了</a></div>
			<?php }?> <?php if (!empty($_smarty_tpl->tpl_vars['nextArticle']->value)) {?>
			<div class="next"><a href="<?php echo formatUrl('article_m',$_smarty_tpl->tpl_vars['nextArticle']->value['dir'],$_smarty_tpl->tpl_vars['nextArticle']->value['id']);?>
">上一篇：<?php echo $_smarty_tpl->tpl_vars['nextArticle']->value['title'];?>
</a></div>
			<?php } else { ?>
			<div class="next"><a>上一篇：没有了</a></div>
			<?php }?>
		</div>
		<?php if (!empty($_smarty_tpl->tpl_vars['relateArticle']->value['list'])) {?>
		<div class="clear"></div>
		<div class="xgyd">
			<div class="xgyd_title"><a>相关阅读</a></div>
			<div class="xgydb">
				<ul>
					<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['relateArticle']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
					<li><a href="<?php echo formatUrl('article_m',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
			<div adid="13">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][13])) {?>
				<?php echo '<script'; ?>
 type='text/javascript' src='http://st.niudai120.com/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][13]['scriptid'];?>
'><?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php } else { ?>
			<div adid="13">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][13])) {?>
				<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][13]['scriptid'];?>
");<?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
			<div adid="14">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][14])) {?>
				<?php echo '<script'; ?>
 type='text/javascript' src='http://st.niudai120.com/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][14]['scriptid'];?>
'><?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php } else { ?>
			<div adid="14">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][14])) {?>
				<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][14]['scriptid'];?>
");<?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php }?>
		<?php if (!empty($_smarty_tpl->tpl_vars['newArticle']->value['list'])) {?>
		<div class="clear"></div>
		<div style="width:100%; height:24px;"></div>
		<div class="xgyd">
			<div class="xgyd_title"><a href="#">最新更新</a></div>
			<div class="xgydb">
				<ul>
					<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['newArticle']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
?>
					<li><a href="<?php echo formatUrl('article_m',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
					<?php } ?>
				</ul>
			</div>
		</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
			<div adid="15">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][15])) {?>
				<?php echo '<script'; ?>
 type='text/javascript' src='http://st.niudai120.com/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][15]['scriptid'];?>
'><?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php } else { ?>
			<div adid="15">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][15])) {?>
				<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][15]['scriptid'];?>
");<?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php }?>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
			<div adid="16">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][16])) {?>
				<?php echo '<script'; ?>
 type='text/javascript' src='http://st.niudai120.com/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][16]['scriptid'];?>
'><?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php } else { ?>
			<div adid="16">
				<?php if (isset($_smarty_tpl->tpl_vars['addata']->value['data'][16])) {?>
				<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][16]['scriptid'];?>
");<?php echo '</script'; ?>
>
				<?php }?>
			</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->tpl_vars['adv']->value)) {?>
			<?php if (isset($_smarty_tpl->tpl_vars['ad']->value['data'][17])) {?> <?php if ($_smarty_tpl->tpl_vars['ad']->value['typeid']==2) {?>
			<?php echo '<script'; ?>
 type='text/javascript' src='http://statics.wy120.cn/statics/m?id=<?php echo $_smarty_tpl->tpl_vars['ad']->value['data'][17]['scriptid'];?>
'><?php echo '</script'; ?>
>
			<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ad']->value['data'][17]['script'];?>
 <?php }?> <?php }?>
		<?php } else { ?>
			<?php if (isset($_smarty_tpl->tpl_vars['ad']->value['data'][17])) {?> <?php if ($_smarty_tpl->tpl_vars['ad']->value['typeid']==2) {?>
			<?php echo '<script'; ?>
 type="text/javascript">BAIDU_CLB_fillSlot("<?php echo $_smarty_tpl->tpl_vars['addata']->value['data'][17]['scriptid'];?>
");<?php echo '</script'; ?>
>
			<?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['ad']->value['data'][17]['script'];?>
 <?php }?> <?php }?>
		<?php }?>
		<div style="display: none;">
			<?php echo config_item('cnzz_m');?>

		</div>
	</body>

</html><?php }} ?>
