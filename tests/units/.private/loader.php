<?php

$XAPP_BASE_DIRECTORY =  realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '../../../xapp/');

//pull in function.php
require_once(realpath(dirname(__FILE__) . '/../../../autoload.php'));

//pull in function.php
require_once(realpath(dirname(__FILE__) . '/../../functions.php'));

//pull in Bootstrap.php
require_once(realpath(dirname(__FILE__) . '/Bootstrap.php'));

//important, Bootstrap wants that
define('XAPP_BASEDIR',$XAPP_BASE_DIRECTORY);

XApp_Bootstrap::loadXAppCore();//load core, Xapp, Autoloader, event, cli, console, debug, error, Option, Reflection




