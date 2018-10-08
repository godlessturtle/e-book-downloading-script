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
$route['default_controller'] = 'FrontController';
$route['404_override'] = 'FrontController/notFound';
$route['translate_uri_dashes'] = FALSE;

$route['sitemap.xml'] = 'FrontController/sitemap';
$route['/?sayfa=(:num)'] = 'FrontController';


$route['panel'] = 'AdminController/index';
$route['login'] = 'AdminController/loginPage';
$route['signin'] = 'AdminController/signIn';
$route['panel/logout'] = 'AdminController/logout';


$route['panel/books'] = 'AdminController/books';
$route['panel/books/?page=(:num)'] = 'AdminController/books';
$route['panel/books/new'] = 'AdminController/newBookPage';
$route['panel/kitap/yeni'] = 'AdminController/createNewBook';
$route['panel/kitap/sil/(:num)'] = 'AdminController/deleteBook/$1';
$route['panel/kitap/duzenle/(:num)'] = 'AdminController/editBook/$1';
$route['panel/kitap/guncelle'] = 'AdminController/updateBook';



$route['panel/categories']  = 'AdminController/categories';
$route['panel/categories/?page=(:num)']  = 'AdminController/categories';
$route['panel/kategori/ekle'] = 'AdminController/createNewCategory';
$route['panel/kategori/sil/(:num)'] = 'AdminController/deleteCategory/$1';

$route['panel/authors'] = 'AdminController/authors';

$route['panel/authors/?page=(:num)'] = 'AdminController/authors';
$route['panel/yazar/ekle'] = 'AdminController/addAuthor';
$route['panel/yazar/sil/(:num)'] = 'AdminController/deleteAuthor/$1';

$route['panel/pages'] = 'AdminController/pages';
$route['panel/sayfa/yeni'] = 'AdminController/newPage';
$route['panel/sayfa/olustur'] = 'AdminController/createNewPage';
$route['panel/sayfa/sil/(:num)'] = 'AdminController/deletePage/$1';
$route['panel/sayfa/duzenle/(:num)'] = 'AdminController/editPage/$1';
$route['panel/sayfa/guncelle'] = 'AdminController/updatePage';

$route['panel/settings'] = 'AdminController/settings';
$route['panel/ayarlar/guncelle'] = 'AdminController/updateSettings';

$route['panel/sifre'] = 'AdminController/changePassPage';
$route['panel/sifre/guncelle'] = 'AdminController/updatePass';
$route['panel/mail/guncelle'] = 'AdminController/updateMail';
//front routeları
$route['kitap/(:any)'] = 'FrontController/single/$1';
$route['rastgele-kitap'] = 'FrontController/randomBook';

$route['kategori/(:any)'] =	'FrontController/category/$1';
$route['kategori/(:any)/?sayfa=(:num)'] = 'FrontController/category/$1';

$route['yazar/(:any)/?sayfa=(:num)'] = 'FrontController/author/$1';
$route['yazar/(:any)'] = 'FrontController/author/$1';


$route['sayfa/(:any)']	= 'FrontController/page/$1';