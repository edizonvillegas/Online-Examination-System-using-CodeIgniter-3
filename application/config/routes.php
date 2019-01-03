<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'questions';


$route['users/activate/(:any)'] = 'users/activate/$1';
$route['reports/history/(:any)'] = 'reports/history/$1';
$route['reports/all/(:any)'] = 'reports/all/$1';

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
