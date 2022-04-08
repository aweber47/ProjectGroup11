<?php
/*** Author: your name*
 * Date: 3/31/2022*
 * File: config.php*
 * Description: */
//error reporting level: 0 to turn off all error reporting; E_ALL to report all
error_reporting(E_ALL);

//local time zone
date_default_timezone_set('America/New_York');

//base url of the application
define("BASE_URL", "http://localhost/ProjectGroup11");

/*************************************************************************************
 *                       settings for menu                        *
 ************************************************************************************/
// path for the menu item images
define("MENU_IMG", "www/images/menuimg/");