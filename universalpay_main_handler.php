<?php
/**
 * universalpay_main_handler.php callback handler for universalpay notifications
 *
 * @package paymentMethod
 */
//set session id
if (!$_POST['merchantTxId']) {
    exit();
}
$sid = substr($_REQUEST['merchantTxId'], 10);
session_id($sid);
define('IS_ADMIN_FLAG', false);
/**
 * integer saves the time at which the script started.
 */
define('PAGE_PARSE_START_TIME', microtime());
@ini_set("arg_separator.output", "&");
@ini_set("html_errors", "0");
/**
 * Set the local configuration parameters - mainly for developers
 */
if (file_exists('includes/local/configure.php')) {
    /**
     * load any local(user created) configure file.
     */
    include('includes/local/configure.php');
}
/**
 * boolean if true the autoloader scripts will be parsed and their output shown. For debugging purposes only.
 */
define('DEBUG_AUTOLOAD', false);
/**
 * set the level of error reporting
 *
 * Note STRICT_ERROR_REPORTING should never be set to true on a production site. <br />
 * It is mainly there to show php warnings during testing/bug fixing phases.<br />
 */
if (DEBUG_AUTOLOAD || (defined('STRICT_ERROR_REPORTING') && STRICT_ERROR_REPORTING == true)) {
    @ini_set('display_errors', TRUE);
    error_reporting(version_compare(PHP_VERSION, 5.3, '>=') ? E_ALL & ~E_DEPRECATED & ~E_NOTICE : (version_compare(PHP_VERSION, 5.4, '>=') ? E_ALL & ~E_DEPRECATED & ~E_NOTICE & ~E_STRICT : E_ALL & ~E_NOTICE));
} else {
    error_reporting(0);
}
/*
 * turn off magic-quotes support, for both runtime and sybase, as both will cause problems if enabled
 */
if (version_compare(PHP_VERSION, 5.3, '<') && function_exists('set_magic_quotes_runtime')) set_magic_quotes_runtime(0);
if (version_compare(PHP_VERSION, 5.4, '<') && @ini_get('magic_quotes_sybase') != 0) @ini_set('magic_quotes_sybase', 0);
/*
 * Get time zone info from PHP config
 */
if (version_compare(PHP_VERSION, 5.3, '>=')) {
    @date_default_timezone_set(date_default_timezone_get());
}
/**
 * check for and include load application parameters
 */
if (file_exists('includes/configure.php')) {
    /**
     * load the main configure file.
     */
    include('includes/configure.php');
} else if (!defined('DIR_FS_CATALOG') && !defined('HTTP_SERVER') && !defined('DIR_WS_CATALOG') && !defined('DIR_WS_INCLUDES')) {
    $problemString = 'includes/configure.php not found';
    require('includes/templates/template_default/templates/tpl_zc_install_suggested_default.php');
    exit;
}

/**
 * if main configure file doesn't contain valid info (ie: is dummy or doesn't match filestructure, display assistance page to suggest running the installer)
 */
if (!defined('DIR_FS_CATALOG') || !is_dir(DIR_FS_CATALOG . '/includes/classes')) {
    $problemString = 'includes/configure.php file contents invalid.  ie: DIR_FS_CATALOG not valid or not set';
    require('includes/templates/template_default/templates/tpl_zc_install_suggested_default.php');
    exit;
}
/**
 * check for and load system defined path constants
 */
if (file_exists('includes/defined_paths.php')) {
    /**
     * load the system-defined path constants
     */
    require('includes/defined_paths.php');
} else {
    die('ERROR: /includes/defined_paths.php file not found. Cannot continue.');
    exit;
}
/**
 * include the list of extra configure files
 */
if ($za_dir = @dir(DIR_WS_INCLUDES . 'extra_configures')) {
    while ($zv_file = $za_dir->read()) {
        if (preg_match('~^[^\._].*\.php$~i', $zv_file) > 0) {
            /**
             * load any user/contribution specific configuration files.
             */
            include(DIR_WS_INCLUDES . 'extra_configures/' . $zv_file);
        }
    }
    $za_dir->close();
    unset($za_dir);
}
$autoLoadConfig = array();
if (isset($loaderPrefix)) {
    $loaderPrefix = preg_replace('/[^a-z_]/', '', $loaderPrefix);
} else {
    $loaderPrefix = 'config';
}
$loader_file = $loaderPrefix . '.core.php';
require('includes/initsystem.php');
/**
 * determine install status
 */
if (((!file_exists('includes/configure.php') && !file_exists('includes/local/configure.php'))) || (DB_TYPE == '') || (!file_exists('includes/classes/db/' . DB_TYPE . '/query_factory.php')) || !file_exists('includes/autoload_func.php')) {
    $problemString = 'includes/configure.php file empty or file not found, OR wrong DB_TYPE set, OR cannot find includes/autoload_func.php which suggests paths are wrong or files were not uploaded correctly';
    require('includes/templates/template_default/templates/tpl_zc_install_suggested_default.php');
    header('location: zc_install_33/index.php');
    exit;
}
/**
 * load the autoloader interpreter code.
 */
ksort($autoLoadConfig);
foreach ($autoLoadConfig as $actionPoint => $row) {
    foreach ($row as $entry) {
        if ($entry['loadFile'] == 'init_sanitize.php') {
            continue;
        }
        switch ($entry['autoType']) {
            case 'include':
                /**
                 * include_once a file as specified by autoloader array
                 */
                if (file_exists($entry['loadFile'])) include_once($entry['loadFile']); else $debugOutput .= 'FAILED: ';
                break;
            case 'require_once':
                /**
                 * require_once a file as specified by autoloader array
                 */
                if (file_exists($entry['loadFile'])) require_once($entry['loadFile']); else $debugOutput .= 'FAILED: ';
                break;
            case 'init_script':
                $baseDir = DIR_WS_INCLUDES . 'init_includes/';
                if (file_exists(DIR_WS_INCLUDES . 'init_includes/overrides/' . $entry['loadFile'])) {
                    $baseDir = DIR_WS_INCLUDES . 'init_includes/overrides/';
                }
                /**
                 * include_once an init_script as specified by autoloader array
                 */
                require_once($baseDir . $entry['loadFile']);
                break;
            case 'class':
                if (isset($entry['classPath'])) {
                    $classPath = $entry['classPath'];
                } else {
                    $classPath = DIR_FS_CATALOG . DIR_WS_CLASSES;
                }
                /**
                 * include_once a class definition as specified by autoloader array
                 */
                if (file_exists($classPath . $entry['loadFile'])) include_once($classPath . $entry['loadFile']); else $debugOutput .= 'FAILED: ';
                break;
            case 'classInstantiate':
                $objectName = $entry['objectName'];
                $className = $entry['className'];
                if (isset($entry['classSession']) && $entry['classSession'] === true) {
                    if (isset($entry['checkInstantiated']) && $entry['checkInstantiated'] === true) {
                        if (!isset($_SESSION[$objectName])) {
                            $_SESSION[$objectName] = new $className();
                        }
                    } else {
                        $_SESSION[$objectName] = new $className();
                    }
                } else {
                    $$objectName = new $className();
                }
                break;
            case 'objectMethod':
                $objectName = $entry['objectName'];
                $methodName = $entry['methodName'];
                if (is_object($_SESSION[$objectName])) {
                    $_SESSION[$objectName]->$methodName();
                } else {
                    ${$objectName}->$methodName();
                }
                break;
        }
    }
}

if ($_REQUEST['status'] && $_REQUEST['amount'] > 0) {
    $_SESSION['payResultType'] = 'server';
}
include_once 'includes/modules/checkout_process.php';
$payment_modules->after_process();
$_SESSION['cart']->reset(true);
// unregister session variables used during checkout
unset($_SESSION['sendto']);
unset($_SESSION['billto']);
unset($_SESSION['shipping']);
unset($_SESSION['payment']);
unset($_SESSION['comments']);
$order_total_modules->clear_posts();
unset($_SESSION['payResultType']);
