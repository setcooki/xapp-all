<?php

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//
//  Basic deps and setup
//
require_once dirname(__FILE__) . '/../loader.php';

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
}



//_print("testing xapp/Config module:");


/*


if(is_dir(dirname(__FILE__) . '/vendor'))
{
    if(isset($_GET['custom']) || (php_sapi_name() === 'cli' && isset($argv[1]) && $argv[1] === 'custom'))
    {
        require_once dirname(__FILE__) . '/vendor/xapp/Core/core.php';
    }else{
        require_once dirname(__FILE__) . '/vendor/autoload.php';
        require_once dirname(__FILE__) . '/vendor/xapp/Core/core.php';
    }
}else{
    die("... module missing - please install with composer");
}

$conf = array
(
    XAPP_CONF_DEBUG_MODE => false,
    XAPP_CONF_AUTOLOAD => false,
    XAPP_CONF_DEV_MODE => true,
    XAPP_CONF_HANDLE_BUFFER => false,
    XAPP_CONF_HANDLE_SHUTDOWN => false,
    XAPP_CONF_HTTP_GZIP => false,
    XAPP_CONF_CONSOLE => false,
    XAPP_CONF_HANDLE_ERROR => false,
    XAPP_CONF_HANDLE_EXCEPTION => false,
    XAPP_CONF_LOG_ERROR => false,
);

xapp_conf($conf);

xapp_import('xapp.Config.*');

try
{

    $config = array
    (
        'value1' => 'test',
        'value2' => array('value3' => 'test')
    );

    $conf = Xapp_Config::create($config, 'priv1', 'php');
    if(Xapp_Config::retrieve('priv1', 'value2.value3') === 'test')
    {
        _print("... xapp/Config/Php - OK");
    }else{
        _print("... xapp/Config/Php - NOT OK");
    }


    $config =
    '
    value1 = test
    ';
    $config = Xapp_Config::create($config, 'priv2', 'ini');
    if(Xapp_Config::retrieve('priv2', 'value1') === 'test')
    {
        _print("... xapp/Config/Ini - OK");
    }else{
        _print("... xapp/Config/Ini - NOT OK");
    }


    $config =
    '
    {"value1": "test", "value2": {"value3": "test"}}
    ';
    $config = Xapp_Config::create($config, 'priv3', 'json');
    if(Xapp_Config::retrieve('priv3', 'value2.value3') === 'test')
    {
        _print("... xapp/Config/Json - OK");
    }else{
        _print("... xapp/Config/Json - NOT OK");
    }


    $config =
    '
    <config><value1>test</value1><value2><value3>test</value3></value2></config>
    ';
    $config = Xapp_Config::create($config, 'priv4', 'xml');
    if(Xapp_Config::retrieve('priv4', 'value2.value3') === 'test')
    {
        _print("... xapp/Config/Xml - OK");
    }else{
        _print("... xapp/Config/Xml - NOT OK");
    }
}
catch(Exception $e)
{
    _print("... xapp/Config - " . $e->getMessage());
}
*/