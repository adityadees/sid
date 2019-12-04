<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
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
$route['loginadm'] = 'login';

$route['register'] = 'frontend/user/register';
$route['logouts'] = 'frontend/user/logout';
$route['dash'] = 'backend/home';
$route['dash/slider'] = 'backend/slider';
$route['dash/galeri'] = 'backend/galeri';
$route['dash/artikel'] = 'backend/artikel';
$route['dash/produk'] = 'backend/produk';
$route['dash/produk/create'] = 'backend/produk/create';
$route['dash/produk/detail/(:any)'] = 'backend/produk/detail/$1';
$route['dash/artikel/create'] = 'backend/artikel/create';
$route['dash/artikel/detail/(:any)'] = 'backend/artikel/detail/$1';
$route['dash/artikel/edit/(:any)'] = 'backend/artikel/edit/$1';
$route['dash/artikel/delete'] = 'backend/artikel/delete';

/*
| -------------------------------------------------------------------------
|							  ---FrontPage----
| -------------------------------------------------------------------------
*/
$route['artikel/detail/(:any)'] = 'frontend/artikel/detail/$1';
$route['berita'] = 'frontend/artikel/news';
$route['info/p/(:any)'] = 'frontend/artikel/info/$1';
$route['info'] = 'frontend/artikel/info';
$route['berita/p/(:any)'] = 'frontend/artikel/news/$1';
$route['organisasi'] = 'frontend/informasi/organisasi';
$route['galeri'] = 'frontend/galeri';
$route['produk'] = 'frontend/produk';
$route['p/detail'] = 'frontend/produk/ajax_page';
$route['support/faq'] = 'frontend/support/faq';
$route['support/contact-us'] = 'frontend/support/contactus';


$route['404-error'] = 'errpage/notfound_err';
$route['406-error'] = 'errpage/nojs_err';
$route['default_controller'] = 'frontend/home';
$route['404_override'] = 'errpage/notfound_err';
$route['translate_uri_dashes'] = FALSE;
