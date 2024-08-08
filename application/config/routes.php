<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['api'] = 'Api/index';
$route['api/(:num)'] = 'Api/index/$1';
$route['api/create'] = 'Api/insert';
$route['api/update/(:num)'] = 'Api/update/$1';
$route['api/delete/(:num)'] = 'Api/delete/$1';

$route['api/test'] = 'ApiTest/index';
