<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'Depan';
$route['reset'] = 'Reset_contr';
$route['ntox'] = 'Coba_contr';
$route['lolos'] = 'Lolos_contr';
$route['nilai'] = 'Xtosera_contr';
$route['nilaitop'] = 'Nilaitop_contr';
$route['scren'] = 'Scren_contr';
$route['screne'] = 'Screne_contr';
$route['pisah'] = 'Pisah';
$route['top'] = 'Limatotiga_contr';
$route['topsera'] = 'Topsera_contr';
$route['topfinal'] = 'Topfinal_contr';
$route['topsere'] = 'Topsere_contr';
$route['toppd'] = 'Toppd_contr';
$route['topiot'] = 'Topiot_contr';
$route['topip'] = 'Topip_contr';
$route['ketiga'] = 'Seratolima_contr';

$route['akun/reset_password/token/(:any)'] = 'akun/reset_password/$1';