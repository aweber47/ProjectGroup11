<?php
/*
 * Author: ProjectGroup11
 * Date: 3/31/2022
 * File: index.php
 * Description: Home page for the website
*/
//load application settings
require_once("applications/config.php");

//load autoloader
require_once("vendor/autoload.php");

//load the dispatcher that dissects a request URL
new Dispatcher();