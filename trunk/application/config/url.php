<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$config = array();
$config['page_prefix'] = "page_";
$config['page_suffix'] = "";
$config['suffix'] = ".html";
$config['domain'] = "";
$config['home'] = "/test/";
$config['home_m'] = "/test/m/";
$config['channel'] = array(
	"url" => "{$config['home']}[$1]/[page_$2{$config['suffix']}]",
	"none" => "",
	"all" => false
);
$config['article'] = array(
	"url" => "{$config['home']}[$1]/[$2]{$config['suffix']}",
	"none" => "",
	"all" => true
);

$config['channel_m'] = array(
	"url" => "{$config['home_m']}[$1]/[{$config['page_prefix']}$2{$config['suffix']}]",
	"none" => "",
	"all" => false
);
$config['article_m'] = array(
	"url" => "{$config['home_m']}[$1]/[$2]{$config['suffix']}",
	"none" => "",
	"all" => true
);
$config['oldomain'] = "http://www.local.mycms.com";
$config['rollnews'] = array(
	"url" => "{$config['home']}roll/[page_$1{$config['suffix']}]",
	"none" => "",
	"all" => false
);
