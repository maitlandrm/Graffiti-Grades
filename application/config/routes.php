<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


$route['default_controller'] = "Users";
$route['users/create'] = "Users/create";
$route['sessions/create'] = "Sessions/create";
// $route['welcome'] = "Sessions/welcome";

$route['sessions/destroy'] = "Sessions/destroy";


$route['upload'] = "Upload/do_upload";

$route['photos/show/(:num)'] = "Photos/show/$1";

$route['photos/add'] = "Photos/add_comment";

$route['404_override'] = '';


