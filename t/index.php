<?php
#include("../../PHPIDS/phpids.php");
#require_once __DIR__.'/../../PHPIDS/vendor/autoload.php';
set_include_path(
   get_include_path()
   . PATH_SEPARATOR
   . '/home/eldar/PHPIDS/lib'
  );

require_once 'IDS/Init.php';
require_once('IDS/Monitor.php');
require_once('IDS/Filter.php');
require_once('IDS/Filter/Storage.php');
require_once('IDS/Caching/CacheFactory.php');
require_once('IDS/Caching/CacheInterface.php');
require_once('IDS/Report.php');
require_once('IDS/Converter.php');
require_once('IDS/Event.php');
#require_once('IDS/Log/CompositeLogger.php');
#require_once('IDS/Log/FileLogger.php');

use IDS\Init;
use IDS\Monitor;
use IDS\Filter;

$init = Init::init(dirname(__FILE__) . '/../../PHPIDS/lib/IDS/Config/Config.ini.php');

$request = array(
    'REQUEST' => $_REQUEST,
    'GET' => $_GET,
    'POST' => $_POST,
    'COOKIE' => $_COOKIE
);

$ids = new Monitor($init);

$result = $ids->run($request);

echo "Typy typy, but is it worky worky?\nTEST = ".print_r($request);
?>
