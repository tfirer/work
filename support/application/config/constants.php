<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');

/*
** system constants
*/

define("AUTH_TOKEN_SECRET",                       'kjh2k3j5243j62mn4b63lk124hk32');

/* 
** DATABASE TABLES
*/
define('T_SUBSCRIBES',                           't_subscribes');
define('T_INDIEGOGO',                            't_indiegogo_buyer');

// SMTP
define('DC_SMTP_HOST',                            'ssl://smtp.exmail.qq.com');
define('DC_SMTP_USER',                            'public@digi-care.com');
define('DC_SMTP_PASS',                            'digicare1005');
define('DC_SMTP_PORT',                            '465');
define('HTML_EMAIL_TYPE',                         'html');
define('TEXT_EMAIL_TYPE',                         'text');

// COUNTRY CODE
define('COUNTRY_CHINA',                           'CN');
define('COUNTRY_USA',                             'US');

/* End of file constants.php */
/* Location: ./application/config/constants.php */
