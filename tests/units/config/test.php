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

xapp_import('xapp.Config.*');

class ConfigTest extends PHPUnit_Framework_TestCase{

	public function testGet(){

		$config = array
		(
			'value1' => 'test',
			'value2' => array('value3' => 'test')
		);

		$conf = Xapp_Config::create($config, 'priv1', 'php');

		$result = Xapp_Config::retrieve('priv1', 'value2.value3');

		$this->assertEquals($result, 'test', 'XApp_Config::retrieve failed: expected: ' . 'test');

	}

	public function testIni(){

		$config = '
		value1 = test
        ';

		$config = Xapp_Config::create($config, 'priv2', 'ini');
		$result = Xapp_Config::retrieve('priv1', 'value1');

		$this->assertEquals($result, 'test', 'XApp_Config::retrieve failed: expected: ' . 'test');

	}

	public function testJson(){

		$config =
		'
	    {"value1": "test", "value2": {"value3": "test"}}
        ';

		$config = Xapp_Config::create($config, 'priv3', 'json');
		$result = Xapp_Config::retrieve('priv3', 'value2.value3');
		$this->assertEquals($result, 'test', 'XApp_Config::retrieve failed: expected: ' . 'test');

	}
	public function testXml(){

		$config =
		'
	    <config><value1>test</value1><value2><value3>test</value3></value2></config>
	    ';
		$config = Xapp_Config::create($config, 'priv4', 'xml');
		$result = Xapp_Config::retrieve('priv4', 'value2.value3');

		$this->assertEquals($result, 'test', 'XApp_Config::retrieve failed: expected: ' . 'test');

	}
}