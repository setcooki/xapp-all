<?php
/**
 * @version 0.1.0
 *
 * @author https://github.com/mc007
 * @license : GPL v2. http://www.gnu.org/licenses/gpl-2.0.html
 * @package xapp
 */

/***
 * Processing Flag 'Setup XApp' instructs the bootstrapper to setup xapp-php core, which handles output stream and some debugging options
 */
define('XAPP_BOOTSTRAP_SETUP_XAPP', 55026);

/***
 * Processing Flag 'Setup RPC Server' instructs the bootstrapper to create our standard RPC server
 */
define('XAPP_BOOTSTRAP_SETUP_RPC', 55027);

/***
 * Processing Flag 'Setup Util' instructs the bootstrapper to load all Json stuff and the /Util module
 */
define('XAPP_BOOTSTRAP_SETUP_UTIL', 55027);

/***
 * Processing Flag 'Setup Services' instructs the bootstrapper to register a number of services on the RPC server
 */
define('XAPP_BOOTSTRAP_SETUP_SERVICES', 55029);

/***
 * Processing Flag 'Setup Gateway'
 */
define('XAPP_BOOTSTRAP_SETUP_GATEWAY', 55030);

/***
 * Processing Flag 'Setup Logger'
 */
define('XAPP_BOOTSTRAP_SETUP_LOGGER', 55031);

/***
 * Processing Flag 'Setup Console'
 */
define('XAPP_BOOTSTRAP_SETUP_CONSOLE', 55032);

/***
 * Processing Flag 'Setup Store'
 */
define('XAPP_BOOTSTRAP_SETUP_STORE', 55033);

/***
 * Logging
 */
$global_xapp_logger = null;

/***
 * Class XApp_Bootstrap
 * Utility class to do the initial work.
 */
class XApp_Bootstrap
{

	/***
	 * Flags to use whilst the bootstrapping
	 */
	const FLAGS = "XAPP_BOOTSTRAP_FLAGS";

	/***
	 * Logging flags
	 */
	const LOGGING_FLAGS = "XAPP_BOOTSTRAP_LOGGING_FLAGS";

	/***
	 * The RPC server. This should be in instance to a JSON-RPC or JSONP server.
	 */
	const RPC_SERVER = "XAPP_BOOTSTRAP_RPC_SERVER";

	/***
	 * The class name of the server application
	 */
	const SERVER_APPLICATION_CLASS = "XAPP_SERVER_APPLICATION_CLASS";

	/***
	 * Absolute path to xapp base directory
	 */
	const BASEDIR = "XAPP_BOOTSTRAP_BASEDIR";

	/***
	 * Absolute path to the xapp client directory
	 */
	const APPDIR = "XAPP_BOOTSTRAP_APP_DIR";

	/***
	 * Relative path to the client app's rpc service
	 */
	const SERVICE = "XAPP_BOOTSTRAP_SERVICE";

	/***
	 * RPC target is the entry point for client calls
	 */
	const RPC_TARGET = "XAPP_BOOTSTRAP_RPC_TARGET";


	/***
	 * Service map
	 */
	const SERIVCE_CONF = "XAPP_BOOTSTRAP_RPC_SERVICES";

	/***
	 * Gateway configuration
	 */
	const GATEWAY_CONF = "XAPP_BOOTSTRAP_GATEWAY_CONF";

	/***
	 * XApp configuration
	 */
	const XAPP_CONF = "XAPP_BOOTSTRAP_XAPP_CONF";

	/***
	 * Logging configuration
	 */
	const LOGGING_CONF = "XAPP_BOOTSTRAP_LOGGING_CONF";

	/***
	 * Store configuration
	 */
	const STORE_CONF = "XAPP_BOOTSTRAP_STORE_CONF";

	/***
	 * Token to use for signed request
	 */
	const SIGNING_TOKEN = "XAPP_BOOTSTRAP_SIGNING_TOKEN";

	/***
	 * Signing key
	 */
	const SIGNING_KEY = "XAPP_BOOTSTRAP_SIGNING_KEY";

	/***
	 * Tracked logger instance, might be shared with plugins and other managed instances
	 */
	const LOGGER = "XAPP_BOOTSTRAP_LOGGER";

	/***
	 * Tracked store service instance, might be shared with plugins and other managed instances
	 */
	const STORE = "XAPP_BOOTSTRAP_STORE";

	/***
	 * Tracked gateway instance, might be shared with plugins and other managed instances
	 */
	const GATEWAY = "XAPP_BOOTSTRAP_GATEWAY";


	/**
	 * options dictionary for this class containing all data type values
	 *
	 * @var array
	 */
	public static $optionsDict = array
	(
		self::BASEDIR => XAPP_TYPE_STRING,
		self::SERVICE => XAPP_TYPE_STRING,
		self::RPC_SERVER => XAPP_TYPE_OBJECT,
		self::FLAGS => XAPP_TYPE_ARRAY,
		self::RPC_TARGET => XAPP_TYPE_STRING,
		self::XAPP_CONF => XAPP_TYPE_ARRAY,
		self::LOGGING_CONF => XAPP_TYPE_ARRAY,
		self::GATEWAY_CONF => XAPP_TYPE_ARRAY,
		self::SIGNING_TOKEN => XAPP_TYPE_STRING,
		self::SIGNING_KEY => XAPP_TYPE_STRING,
		self::LOGGING_FLAGS => XAPP_TYPE_ARRAY,
		self::LOGGER => XAPP_TYPE_OBJECT,
		self::STORE => XAPP_TYPE_OBJECT,
		self::GATEWAY => XAPP_TYPE_OBJECT,
		self::SERIVCE_CONF => XAPP_TYPE_ARRAY

	);


	/***
	 * Include XApp-PHP-Core files
	 */
	public static function loadXAppCore()
	{

		if (!defined('XAPP')) {

			//define('XAPPED', true);

			require_once XAPP_BASEDIR . '/Core/core.php';
			//require_once(XAPP_BASEDIR . '/Xapp/src/Xapp.php');

			/*
			require_once XAPP_BASEDIR . '/Core/core.php';
			require_once(XAPP_BASEDIR . '/Xapp/src/Xapp.php');
			*/
			/*
			require_once(XAPP_BASEDIR . '/Xapp/src/Error.php');
			require_once(XAPP_BASEDIR . '/Xapp/src/Autoloader.php');
			require_once(XAPP_BASEDIR . '/Xapp/src/Xapp.php');
			*/

			/*
			//require_once XAPP_BASEDIR . '/../autoload.php';
			require_once XAPP_BASEDIR . '/Core/core.php';

			//require_once(XAPP_BASEDIR . '/Xapp/Error.php');

			require_once(XAPP_BASEDIR . '/Xapp/Xapp.php');

			//include_once(XAPP_BASEDIR . '/Core/core.php');

			//require_once(XAPP_BASEDIR . '/Xapp/Autoloader.php');

			require_once(XAPP_BASEDIR . '/Xapp/Cli.php');
			require_once(XAPP_BASEDIR . '/Xapp/Console.php');
			require_once(XAPP_BASEDIR . '/Xapp/Debug.php');
			require_once(XAPP_BASEDIR . '/Xapp/Event.php');
			require_once(XAPP_BASEDIR . '/Xapp/Option.php');
			require_once(XAPP_BASEDIR . '/Xapp/Reflection.php');
			*/


		}
	}

	/**
	 * options mandatory map for this class contains all mandatory values
	 *
	 * @var array
	 */
	public static $optionsRule = array
	(
		self::BASEDIR => 1,
		self::SERVICE => 0,
		self::FLAGS => 0,
		self::RPC_SERVER => 0,
		self::RPC_TARGET => 0,
		self::GATEWAY_CONF => 0,
		self::LOGGING_CONF => 0,
		self::SIGNING_TOKEN => 0,
		self::SIGNING_KEY => 0,
		self::XAPP_CONF => 0,
		self::LOGGING_FLAGS => 0,
		self::LOGGER => 0,
		self::STORE => 0,
		self::GATEWAY => 0,
		self::SERIVCE_CONF => 0

	);
	/**
	 * contains the singleton instance for this class
	 *
	 * @var null
	 */
	protected static $_instance = null;
	/**
	 * options default value array containing all class option default values
	 *
	 * @var array
	 */
	public $options = array
	(
		self::BASEDIR => null,
		self::SERVICE => null,
		self::FLAGS => array(),
		self::RPC_SERVER => null,
		self::LOGGER => null,
		self::LOGGING_FLAGS => array(),
		self::RPC_TARGET => null,
		self::GATEWAY_CONF => null,
		self::LOGGING_CONF => null,
		self::SIGNING_TOKEN => null,
		self::SIGNING_KEY => null,
		self::STORE => null,
		self::GATEWAY => null,
		self::SERIVCE_CONF => null
	);

	/**
	 *  New main entry,
	 */
	public function run(){


		$flags = xapp_get_option(self::FLAGS, $this);

		$this->loadDependencies($flags);

		//core and misc
		if (in_array(XAPP_BOOTSTRAP_SETUP_XAPP, $flags)) {
			$this->setupXApp(xapp_has_option(self::XAPP_CONF, $this) ? xapp_get_option(self::XAPP_CONF, $this) : null);
		}

		//util
		if (in_array(XAPP_BOOTSTRAP_SETUP_UTIL, $flags)) {
			$this->loadXAppJSONStoreClasses();
		}
	}





	/**
	 * class constructor
	 * call parent constructor for class initialization
	 *
	 * @error 14601
	 * @param null|array|object $options expects optional options
	 */
	public function __construct($options = null)
	{
		xapp_set_options($options, $this);
	}

	public static function loadRPC()
	{
		//XApp_Service_Entry_Utils::includeXAppRPC();

	}

	public static function loadLogging()
	{
		require_once(XAPP_BASEDIR . '/Log/Exception/Exception.php');
		require_once(XAPP_BASEDIR . '/Log/Interface/Interface.php');
		require_once(XAPP_BASEDIR . '/Log/Log.php');
		require_once(XAPP_BASEDIR . '/Log/Writer.php');
		require_once(XAPP_BASEDIR . '/Log/Writer/File.php');
	}

	/***
	 *
	 */
	public static function isRPC()
	{

	}

	/***
	 * Return current request url
	 * @return string
	 */
	public static function getUrl()
	{
		$pageURL = 'http';
		if (array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] == "on") {
			$pageURL .= "s";
		}
		$pageURL .= "://";
		if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
		} else {
			$pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
		}

		return $pageURL;
	}

	/***
	 *
	 */
	public static function loadDebuggingTools()
	{

		xapp_import('xapp.Utils.Debugging');
	}

	public static function getConsoleType()
	{

		$agent = '';
		if (isset($_SERVER['HTTP_USER_AGENT'])) {
			$agent = $_SERVER['HTTP_USER_AGENT'];
		}
		if (strlen(strstr($agent, "Firefox")) > 0) {
			return 'firephp';
		} elseif ((strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== false)) {
			return 'chromephp';
		}

		return false;
	}

	/***
	 *
	 */
	public function printPaths()
	{

		echo('XAPP BOOTSTRAP-PATHS' . '<br/>');
		echo('BASE DIR : ' . xapp_get_option(self::BASEDIR, $this) . '<br/>');
		echo('APP DIR : ' . xapp_get_option(self::APPDIR, $this) . '<br/>');
		echo('SERVICE : ' . xapp_get_option(self::SERVICE, $this) . '<br/>');

	}


	public function init()
	{

		/***
		 * Setup gateway
		 */
		if (in_array(XAPP_BOOTSTRAP_SETUP_GATEWAY, $flags) &&

			xapp_get_option(self::RPC_SERVER, $this)
		) {

			try {
				$needsSigning = false;
				$opt = xapp_has_option(self::GATEWAY_CONF) ? xapp_get_option(self::GATEWAY_CONF) : array();
				/***
				 * Raise security and demand that the client did sign its request
				 */
				$signServiceTypes = xapp_get_option(self::SIGNED_SERVICE_TYPES, $this);
				if (in_array(XApp_Service_Entry_Utils::getServiceType(), $signServiceTypes)) {

					$needsSigning = true;


					//set signed
					$opt[Xapp_Rpc_Gateway::SIGNED_REQUEST] = true;

					//complete configuration

					if (!array_key_exists(Xapp_Rpc_Gateway::SIGNED_REQUEST_METHOD, $opt)) {
						$opt[Xapp_Rpc_Gateway::SIGNED_REQUEST_METHOD] = 'user';
					}

					if (!array_key_exists(Xapp_Rpc_Gateway::SIGNED_REQUEST_USER_PARAM, $opt)) {
						$opt[Xapp_Rpc_Gateway::SIGNED_REQUEST_USER_PARAM] = 'user';
					}
					//complete configuration
				}

				$this->setGatewayOptionArray(Xapp_Rpc_Gateway::ALLOW_IP, $opt);
				$this->setGatewayOptionArray(Xapp_Rpc_Gateway::DENY_IP, $opt);
				$this->setGatewayOptionArray(Xapp_Rpc_Gateway::ALLOW_HOST, $opt);
				$this->setGatewayOptionArray(Xapp_Rpc_Gateway::DENY_HOST, $opt);

				/***
				 * Create the gateway
				 */
				$gateway = Xapp_Rpc_Gateway::instance(xapp_get_option(self::RPC_SERVER, $this), $opt);

				/***
				 * Set the API key for signed requests
				 */
				if ($needsSigning) {
					$gateway->addKey(
						xapp_get_option(self::SIGNING_KEY, $this),
						xapp_get_option(self::SIGNING_TOKEN, $this)
					);
				}
				//$gateway->run();
				xapp_set_option(self::GATEWAY, $gateway, $this);

			} catch (Exception $e) {
				Xapp_Rpc_Server_Json::dump($e);
			}
		}

		return $this;
	}

	/***
	 * Pulls in xapp-php dependencies
	 * @param $flags
	 */
	private function loadDependencies($flags)
	{

		//pull in parts of xapp core framework
		$this->loadXAppCore();

		/***
		 * Load logging deps
		 */
		if (in_array(XAPP_BOOTSTRAP_SETUP_LOGGER, $flags)) {

			if (!class_exists('Xapp_Log_Exception')) {
				require_once(XAPP_BASEDIR . '/Log/Exception/Exception.php');
			}
			if (!class_exists('Xapp_Log_Interface')) {
				require_once(XAPP_BASEDIR . '/Log/Interface/Interface.php');
			}
			if (!class_exists('Xapp_Log')) {
				require_once(XAPP_BASEDIR . '/Log/Log.php');
			}
			if (!class_exists('Xapp_Log_Error')) {
				require_once(XAPP_BASEDIR . '/Log/Error.php');
			}

			if (!class_exists('Xapp_Log_Writer')) {
				require_once(XAPP_BASEDIR . '/Log/Writer.php');
			}
			if (!class_exists('File.php')) {
				require_once(XAPP_BASEDIR . '/Log/Writer/File.php');
			}
		}


	}

	/***
	 * Setup logger
	 */
	private function setupLogger($loggingConf)
	{

		$logginConf[Xapp_Log::WRITER] = array(new Xapp_Log_Writer_File(xapp_get_option(Xapp_Log::PATH, $loggingConf)));

		return new Xapp_Log_Error($loggingConf);
	}

	/**
	 * Xapp_Singleton interface impl.
	 *
	 * static singleton method to create static instance of driver with optional third parameter
	 * xapp options array or object
	 *
	 * @error 15501
	 * @param null|mixed $options expects optional xapp option array or object
	 * @return XApp_Bootstrap
	 */
	public static function instance($options = null)
	{
		if (self::$_instance === null) {
			self::$_instance = new self($options);
		}

		return self::$_instance;
	}

	/***
	 * run xapp to init your application and make use of all in build features such as
	 * debuging, autoloading, error logging. xapp can only be initialized with this method
	 * expecting the optional xapp conf array which can also be set outside of xapp with
	 * the generic function xapp_conf.
	 */
	private function setupXApp($conf)
	{

		if ($conf == null) {
			$conf = array
			(
				XAPP_CONF_DEBUG_MODE => null,
				XAPP_CONF_AUTOLOAD => false,
				XAPP_CONF_DEV_MODE => true,
				XAPP_CONF_HANDLE_BUFFER => false,
				XAPP_CONF_HANDLE_SHUTDOWN => false,
				XAPP_CONF_HTTP_GZIP => false,
				XAPP_CONF_CONSOLE => false,
				XAPP_CONF_HANDLE_ERROR => false,
				XAPP_CONF_HANDLE_EXCEPTION => false
			);


		}
		Xapp::run($conf);
	}

	/***
	 * Setup a JSON-RPC server, creates a JSON or JSONP server
	 */
	private function setupRPC()
	{

		/***
		 * We support JSONP for all services
		 */
		$isJSONP = false;
		$hasJSONP = true;

		$method = $_SERVER['REQUEST_METHOD'];
		if ($method === 'POST') {
			$hasJSONP = false;
		}

		/***
		 * Filtered methods
		 */
		$ignoredRPCMethods = array(
			'load',
			'getObject',
			'init',
			'setup',
			'log',
			'onBeforeCall',
			'onAfterCall',
			'dumpObject',
			'applyFilter',
			'getLastJSONError',
			'cleanUrl',
			'rootUrl',
			'siteUrl',
			'getXCOption',
			'getIndexer',
			'getIndexOptions',
			'getIndexOptions',
			'indexDocument',
			'onBeforeSearch',
			'toDSURL',
			'searchTest'
		);

		$server = null;
		if ($hasJSONP && $isJSONP) {

			//Options for SMD based JSONP-RPC classes
			$opt = array
			(
				Xapp_Rpc_Smd::IGNORE_METHODS => $ignoredRPCMethods,
				Xapp_Rpc_Smd::IGNORE_PREFIXES => array('_', '__')
			);
			$smd = new Xapp_Rpc_Smd_Jsonp($opt);

			//Options for RPC server
			$opt = array
			(
				Xapp_Rpc_Server::ALLOW_FUNCTIONS => true,
				Xapp_Rpc_Server::APPLICATION_ERROR => false,
				Xapp_Rpc_Server::DEBUG => true,
				Xapp_Rpc_Server::SMD => $smd
			);
			$server = Xapp_Rpc::server('jsonp');

		} else {

			//Options for SMD based RPC classes
			$opt = array
			(
				Xapp_Rpc_Smd_Json::IGNORE_METHODS => $ignoredRPCMethods,
				Xapp_Rpc_Smd_Json::IGNORE_PREFIXES => array('_', '__'),
				Xapp_Rpc_Smd_Json::SERVICE_OVER_GET => true,
				Xapp_Rpc_Smd_Json::TARGET => xapp_get_option(self::RPC_TARGET, $this)
			);
			$smd = new Xapp_Rpc_Smd_Json($opt);


			//Options for RPC server
			$opt = array
			(
				Xapp_Rpc_Server::ALLOW_FUNCTIONS => true,
				Xapp_Rpc_Server::APPLICATION_ERROR => false,
				Xapp_Rpc_Server::ALLOW_BATCHED_REQUESTS =>true,
				Xapp_Rpc_Server::SERVICE_OVER_GET => true,
				Xapp_Rpc_Server::DEBUG => true,
				Xapp_Rpc_Server::SMD => $smd
			);
			$server = Xapp_Rpc::server('json', $opt);
		}

		if ($server) {
			xapp_set_option(self::RPC_SERVER, $server, $this);
		}

	}

	/***
	 * @param $storeConf
	 */
	public function setupStore($storeConf)
	{
		return new XApp_Store($storeConf);
	}

	/**
	 * @param $message
	 * @param string $prefix
	 * @param bool $stdError
	 * @return null
	 */
	public function log($message, $prefix = '', $stdError = true)
	{

		if (function_exists('xp_log')) {
			xp_log('XCom-Bootstrap : ' . $message);
		}

		if ($stdError) {
			error_log('XCom-Bootstrap : ' . $message);
		}

		return null;
	}

	/***
	 * @param $serviceList Array
	 * @param $rpcServer Xapp_Rpc_Server
	 */
	public function registerServices($serviceList, $rpcServer, $logger = null)
	{

		$logger = $logger ?: xapp_get_option(XApp_Bootstrap::LOGGER, $bootstrap);

		$shareLogger = in_array(XAPP_LOG_SHARED_LOGGER_SERVICES, xo_get(self::LOGGING_FLAGS));


		foreach ($serviceList as &$serviceConf) {

			$instance = $serviceConf[XApp_Service::XAPP_SERVICE_INSTANCE];
			$className = $serviceConf[XApp_Service::XAPP_SERVICE_CLASS];
			$classConf = $serviceConf[XApp_Service::XAPP_SERVICE_CONF];
			//no instance yet, create one
			if ($instance == null) {

				if (!class_exists($className)) {
					$this->log('service class : ' . $className . ' doesnt exists');
					continue;
				}

				if (array_key_exists(XApp_Service::PUBLISH_METHODS, $classConf)) {
					//determine we have 'publish methods'
					$publishedMethods = $classConf[XApp_Service::PUBLISH_METHODS];
					//if we have published methods, we need to use the Class mixer to auto-wire
					//the service and the managed class all together
					if (count($publishedMethods)) {
						xapp_import('xapp.Commons.ClassMixer');
						xapp_import('xapp.Commons.Mixins');
					}
				}

				//mixin logger instance
				if ($shareLogger === true && $logger !== null) {
					$serviceConf[XApp_Service::LOGGER] = $logger;
				}
				$instance = new $className($serviceConf[XApp_Service::XAPP_SERVICE_CONF]);
				$serviceConf[XApp_Service::XAPP_SERVICE_INSTANCE] = $instance;
			}

			//share logger;
			if ($shareLogger === true && $logger !== null) {
				$instance->logger = $logger;

				if (method_exists($instance, 'getObject')) {

					$serviceObject = $instance->getObject();
					if ($serviceObject) {
						$serviceObject->logger = $logger;
					}
				}
			}
			$rpcServer->register($instance);
		}

		return $serviceList;
	}

	/**
	 * @param $key
	 * @param $opt
	 */
	protected function setGatewayOptionArray($key, &$opt)
	{

		if (xapp_has_option($key, $opt) && is_array(xapp_get_option($key, $opt))) {

		} else {
			unset($opt[$key]);
		}
	}

	////////////////////////////////////////////////////////////////////////////
	//
	//  Auth helpers
	//
	/////////////////////////////////////////////////////////////////////////////

	public static function loadJSONTools()
	{
		if (!class_exists('XApp_Utils_JSONUtils')) {
			xapp_import('xapp.Utils.JSONUtils');
		}
	}

	/***
	 * Include XApp-JSON-Store Files
	 */
	public static function loadXAppJSONStoreClasses()
	{

		if (!class_exists('Xapp_Util_JsonStorage')) {

			/***
			 * Import JSON-Store classes from 'xapp/Util'
			 */
			xapp_import('xapp.Util.Storage');

			if (!class_exists('Xapp_Util_Std')) {
				xapp_import('xapp.Util.Std.Std');
				xapp_import('xapp.Util.Std.Query');
				xapp_import('xapp.Util.Std.Store');
				xapp_import('xapp.Util.Json.Json');
				xapp_import('xapp.Util.Json.Query');
				xapp_import('xapp.Util.Json.Store');
			}
		}
	}

}
