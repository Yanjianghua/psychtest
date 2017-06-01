<?php /* Smarty version Smarty-3.1.21-dev, created on 2016-04-30 20:22:31
         compiled from "C:\xampp\htdocs\mycms\trunk\application\views\default\article\index.html" */ ?>
<?php /*%%SmartyHeaderCode:3247957246db3399441-42822742%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be7feaaefbe7008a54008714deea3c4f1b29b375' => 
    array (
      0 => 'C:\\xampp\\htdocs\\mycms\\trunk\\application\\views\\default\\article\\index.html',
      1 => 1462018949,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3247957246db3399441-42822742',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.21-dev',
  'unifunc' => 'content_57246db3602be9_23492351',
  'variables' => 
  array (
    'article' => 0,
    'web_name' => 0,
    'addata' => 0,
    'readnumswich' => 0,
    'readnum' => 0,
    'prevArticle' => 0,
    'nextArticle' => 0,
    'channelRecommand' => 0,
    'v' => 0,
    'allArticle' => 0,
    'k' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_57246db3602be9_23492351')) {function content_57246db3602be9_23492351($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Cache-Control" content="no-siteapp">
		<meta http-equiv="Cache-Control" content="no-transform">
		<meta name="mobile-agent" content="format=html5;url=<?php echo getServer('REMOTE_HOST');
echo formatUrl('article_m',$_smarty_tpl->tpl_vars['article']->value['dir'],$_smarty_tpl->tpl_vars['article']->value['id']);?>
">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
		<title><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
_<?php echo $_smarty_tpl->tpl_vars['web_name']->value;?>
</title>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/importAll.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>
 <?php if (!isset($_smarty_tpl->tpl_vars['addata']->value)) {?>
		<?php echo '<script'; ?>
 type="text/javascript" id="ad" data-url="<?php echo formatUrl('domain');
echo formatUrl('home');?>
" data-uid="<?php echo $_smarty_tpl->tpl_vars['article']->value['uid'];?>
" data-typeid="1" src="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/js/ad.js?v=<?php echo config_item('system_version');?>
"><?php echo '</script'; ?>
>
		<?php }?>
		<?php echo '<script'; ?>
 type="text/javascript" src="http://cbjs.baidu.com/js/m.js"><?php echo '</script'; ?>
>
		<link href="<?php echo formatUrl('domain');
echo formatUrl('home');?>
statics/<?php echo config_item('style');?>
/css/article_article.css?v=<?php echo config_item('system_version');?>
" rel="stylesheet" type="text/css" />

	</head>

	<body>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/header.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div id="content">
			<div class="c_top">
				<?php echo $_smarty_tpl->getSubTemplate ('../common/position.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

			</div>
			<div class="c_left">
				<div class="c_l_1">
					<h1><?php echo $_smarty_tpl->tpl_vars['article']->value['title'];?>
</h1>
					<div class="clear"></div>

					<div class="xin_xi">
						<span><a><?php echo $_smarty_tpl->tpl_vars['article']->value['editor'];?>
</a>&nbsp;<?php echo date("Y-m-d",$_smarty_tpl->tpl_vars['article']->value['addtime']);?>
&nbsp;&nbsp;<?php if ($_smarty_tpl->tpl_vars['readnumswich']->value) {?>阅读量:<?php echo $_smarty_tpl->tpl_vars['readnum']->value;
}?></span>
						<ul>
							<li class="sj_kan"><a href="<?php echo formatUrl('article_m',$_smarty_tpl->tpl_vars['article']->value['dir'],$_smarty_tpl->tpl_vars['article']->value['id']);?>
">手机版</a></li>
							<li class="bc_dao">
								<div class="share">
									<div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1442403177050"><span>分享：</span>
										<a href="static/images/article_article.htm" class="bds_more" data-cmd="more"></a>
										<a href="static/images/article_article.htm" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
										<a href="static/images/article_article.htm" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
										<a href="static/images/article_article.htm" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
										<a href="static/images/article_article.htm" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
										<a href="static/images/article_article.htm" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
									</div>
									<?php echo '<script'; ?>
>
										with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
									<?php echo '</script'; ?>
>
								</div>

							</li>

						</ul>
					</div>
					<div class="clear"></div>
					<span class="sheng_m">声明：本文由平台作者撰写，观点仅代表作者本人，如涉及专业知识，仅供参考。</span>
					<div class="clear"></div>
					<div class="zheng_w">
						<?php echo $_smarty_tpl->tpl_vars['article']->value['content'];?>

					</div>
					<div class="clear"></div>
					<div class="zheng_x">
						<form name="see">
							<div align="center"><center><table width="635" height="129%" border="0" align="center" cellpadding="10" cellspacing="0" bgcolor="#FFFFFF">
								<tr>
									<td height="40" align="center" ><div align="left">
										<p><?php echo $_smarty_tpl->tpl_vars['article']->value['description'];?>
</p>
									</div><div align="center"><table border="0" cellpadding="8" cellspacing="0" width="70%">
										<tr>
											<td width="50%"><div align="left"><p><span style="font-size: 11pt; line-height: 40px"><input name="c1" type="radio" value="1"><?php echo $_smarty_tpl->tpl_vars['article']->value['option1'];?>
</span></p>
											</div><div align="left"><p><span style="font-size: 11pt; line-height: 40px"><input name="c1" type="radio" value="2"><?php echo $_smarty_tpl->tpl_vars['article']->value['option2'];?>
</span></p>
											</div><div align="left"><p><span style="font-size: 11pt; line-height: 40px"><input name="c1" type="radio" value="3"><?php echo $_smarty_tpl->tpl_vars['article']->value['option3'];?>
</span></p>
											</div><div align="left"><p><span style="font-size:11pt; line-height: 40px"><input name="c1" type="radio" value="4"><?php echo $_smarty_tpl->tpl_vars['article']->value['option4'];?>
</span></p>
											</div>
											</td>
										</tr>
									</table>
									</div><p><input type="button" value="已选好，看看结论！" onClick="processForm(this.form)" style="font-size: 9pt; font-family: 宋体;width:150px;height:40px;">　　<input type="reset" value="重新选！" onClick="processForm(this.form)" style="font-size: 9pt; font-family: 宋体;width:80px;height:40px;"></p>
										<p><textarea rows="10" name="answer" cols="70" wrap="virtual" style="font-family: 宋体; font-size: 11pt; line-height: 15px; color: rgb(255,0,0)"></textarea></td>
								</tr>
							</table>
							</center></div>
						</form>

					</div>
					<div class="clear30"></div>
					<ul class="p_n_ul">
						<?php if (!empty($_smarty_tpl->tpl_vars['prevArticle']->value)) {?>
						<li>上一篇：<a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['prevArticle']->value['dir'],$_smarty_tpl->tpl_vars['prevArticle']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['prevArticle']->value['title'];?>
</a></li>
						<?php } else { ?>
						<li>上一篇：没有了 </li>
						<?php }?>
						<?php if (!empty($_smarty_tpl->tpl_vars['nextArticle']->value)) {?>
						<li>下一篇：<a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['nextArticle']->value['dir'],$_smarty_tpl->tpl_vars['nextArticle']->value['id']);?>
"><?php echo $_smarty_tpl->tpl_vars['nextArticle']->value['title'];?>
</a></li>
						<?php } else { ?>
						<li>下一篇：没有了 </li>
						<?php }?>
					</ul>
					<div class="clear20" style="border-bottom:1px solid #dddddd;"></div>

					<div class="f_b_f">
						<div class="f_b_f_x">

							<div class="share">
								<div class="bdsharebuttonbox bdshare-button-style0-16" data-bd-bind="1442403177050"><span>分享：</span>
									<a href="static/images/article_article.htm" class="bds_more" data-cmd="more"></a>
									<a href="static/images/article_article.htm" class="bds_qzone" data-cmd="qzone" title="分享到QQ空间"></a>
									<a href="static/images/article_article.htm" class="bds_tsina" data-cmd="tsina" title="分享到新浪微博"></a>
									<a href="static/images/article_article.htm" class="bds_tqq" data-cmd="tqq" title="分享到腾讯微博"></a>
									<a href="static/images/article_article.htm" class="bds_renren" data-cmd="renren" title="分享到人人网"></a>
									<a href="static/images/article_article.htm" class="bds_weixin" data-cmd="weixin" title="分享到微信"></a>
								</div>
								<?php echo '<script'; ?>
>
									with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src = 'http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
								<?php echo '</script'; ?>
>
							</div>

						</div>
						<ul class="f_b_f_ul">
							<li class="f_b_b_c">保存在桌面</li>
							<li class="f_r_s_c">放入收藏夹</li>
						</ul>
					</div>
					<?php echo '<script'; ?>
 Language="JavaScript">
						<!--
						function processForm(form){
							if (form.c1[0].checked==1) form.answer.value=
									"<?php echo $_smarty_tpl->tpl_vars['article']->value['content1'];?>
";
							if (form.c1[1].checked==1) form.answer.value=
									"<?php echo $_smarty_tpl->tpl_vars['article']->value['content2'];?>
";
							if (form.c1[2].checked==1) form.answer.value=
									"<?php echo $_smarty_tpl->tpl_vars['article']->value['content3'];?>
";
							if (form.c1[3].checked==1) form.answer.value=
									"<?php echo $_smarty_tpl->tpl_vars['article']->value['content4'];?>
";
						}
						//-->
					<?php echo '</script'; ?>
>

					<div class="clear20"></div>
				</div>

			</div>

			<div class="c_right">
				<?php if (!empty($_smarty_tpl->tpl_vars['channelRecommand']->value['list'])) {?>
				<div class="clear20"></div>
				<div class="lm_tj">
					<h2>精彩推荐</h2>
					<ul class="lm_tj_lb">
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['channelRecommand']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
						<li><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
						<?php } ?>
					</ul>
				</div>
				<?php }?>
				<?php if (!empty($_smarty_tpl->tpl_vars['allArticle']->value['list'])) {?>
				<div class="clear20"></div>
				<div class="re_wen">
					<h2>精彩测试&nbsp;TOP10</h2>
					<ul class="num">
						<?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['allArticle']->value['list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
						<li><span class="num_n"<?php if ($_smarty_tpl->tpl_vars['k']->value<3) {?> style="color:#ff5a00"<?php }?>><?php if ($_smarty_tpl->tpl_vars['k']->value<9) {?>0<?php echo $_smarty_tpl->tpl_vars['k']->value+1;
} else {
echo $_smarty_tpl->tpl_vars['k']->value+1;
}?></span><a href="<?php echo formatUrl('article',$_smarty_tpl->tpl_vars['v']->value['dir'],$_smarty_tpl->tpl_vars['v']->value['id']);?>
" target="_blank"><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</a></li>
						<?php } ?>
					</ul>
				</div>
				<?php }?>
			</div>

		</div>
		<?php echo $_smarty_tpl->getSubTemplate ('../common/footer.html', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

		<div style="display: none;">
			<?php echo config_item('cnzz');?>

		</div>
	</body>

</html><?php }} ?>
