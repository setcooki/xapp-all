<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Basic deps and setup
//
require_once dirname(__FILE__) . '/../.private/loader.php';

/**
 * configure and run dependencies
 */
$bootstapOptions = array(

	XApp_Bootstrap::FLAGS => array(

		XAPP_BOOTSTRAP_SETUP_XAPP,
		//takes care about output encoding and compressing
		//XAPP_BOOTSTRAP_SETUP_RPC,
		//setup a RPC server
		//XAPP_BOOTSTRAP_SETUP_STORE,
		//setup a gateway
		//XAPP_BOOTSTRAP_SETUP_GATEWAY,
		//setup a services
		//XAPP_BOOTSTRAP_SETUP_SERVICES,
	)
);

$bootstrap = new XApp_Bootstrap($bootstapOptions);
$bootstrap->run();

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Test specific deps and setup
//

xapp_import('xapp.Log.*');


////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Actual test units
//

class LogTest extends PHPUnit_Framework_TestCase{

	public function testError(){


		$options = array();

		$log = new Xapp_Log_Error($options);

		//$this->assertEquals($result, 'test', 'XApp_Config::retrieve failed: expected: ' . 'test');

	}
}