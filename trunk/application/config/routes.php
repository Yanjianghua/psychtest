<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 | -------------------------------------------------------------------------
 | URI ROUTING
 | -------------------------------------------------------------------------
 | This file lets you re-map URI requests to specific controller functions.
 |
 | Typically there is a one-to-one relationship between a URL string
 | and its corresponding controller class/method. The segments in a
 | URL normally follow this pattern:
 |
 |	example.com/class/method/id/
 |
 | In some instances, however, you may want to remap this relationship
 | so that a different class/function is called than the one
 | corresponding to the URL.
 |
 | Please see the user guide for complete details:
 |
 |	http://codeigniter.com/user_guide/general/routing.html
 |
 | -------------------------------------------------------------------------
 | RESERVED ROUTES
 | -------------------------------------------------------------------------
 |
 | There are three reserved routes:
 |
 |	$route['default_controller'] = 'welcome';
 |
 | This route indicates which controller class should be loaded if the
 | URI contains no data. In the above example, the "welcome" class
 | would be loaded.
 |
 |	$route['404_override'] = 'errors/page_missing';
 |
 | This route will tell the Router which controller/method to use if those
 | provided in the URL cannot be matched to a valid route.
 |
 |	$route['translate_uri_dashes'] = FALSE;
 |
 | This is not exactly a route, but allows you to automatically route
 | controller and method names that contain dashes. '-' isn't a valid
 | class or method name character, so it requires translation.
 | When you set this option to TRUE, it will replace ALL dashes in the
 | controller and method URI segments.
 |
 | Examples:	my-controller/index	-> my_controller/index
 |		my-controller/my-method	-> my_controller/my_method
 */
$home = preg_replace("/^[\/]/", "", $config['home']);
$home_m = preg_replace("/^[\/]/", "", $config['home_m']);
$route['default_controller'] = 'Layout';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route[$home . "Article_API/(:any)"] = "Article_API/$1";

$route[$home . "roll"] = "Mp/index";
$route[$home . "roll/page_([0-9]*?){$config['suffix']}"] = "Mp/index/?page=$1";

$route[$home_m . "roll"] = "Mp_m/index";
$route[$home_m . "roll/page_([0-9]*?){$config['suffix']}"] = "Mp_m/index/?page=$1";

$route[preg_replace("/[\/]$/", "", $home)] = "Layout/index";
$route[$home . "([a-zA-Z0-9]+)"] = "Channel/index/?dir=$1";
$route[$home . "([a-zA-Z0-9]+)/page_([0-9]*?){$config['suffix']}"] = "Channel/index/?dir=$1&page=$2";
$route[$home . "([a-zA-Z0-9]+)/([0-9]*?){$config['suffix']}"] = "Article/index/?dir=$1&id=$2";

$route[preg_replace("/[\/]$/", "", $home_m)] = "Layout_m/index";
$route[$home_m . "([a-zA-Z0-9]+)"] = "Channel_m/index/?dir=$1";
$route[$home_m . "([a-zA-Z0-9]+)/page_([0-9]*?){$config['suffix']}"] = "Channel_m/index/?dir=$1&page=$2";
$route[$home_m . "([a-zA-Z0-9]+)/([0-9]*?){$config['suffix']}"] = "Article_m/index/?dir=$1&id=$2";

$route[$home . "(:any)/(:any)"] = "$1/$2";
$route[$home . "Ad/get/(:any)/(:any)"] = "Ad/get/?uid=$1&typeid=$2";
$route[$home . "m/Ad/get/(:any)/(:any)"] = "Ad/get/?uid=$1&typeid=$2";