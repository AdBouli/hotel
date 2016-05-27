<?php 

//ROUTES
define('WEBROOT', str_replace('index.php', '', $_SERVER['SCRIPT_NAME']));
define('ROOT', str_replace('index.php', '', $_SERVER['SCRIPT_FILENAME']));
// 
define('CORE', ROOT.'Core/');
define('ADDN', CORE.'Addons/');
define('CTRL', ROOT.'Controllers/');
define('MODL', ROOT.'Models/');
define('VIEW', ROOT.'Views/');
define('CONF', ROOT.'conf/');
//
define('IMG' , WEBROOT.'webroot/img/');
define('CSS' , WEBROOT.'webroot/css/');
define('JS'  , WEBROOT.'webroot/js/');

?>