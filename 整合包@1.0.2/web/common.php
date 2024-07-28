<?php
header("Content-Type: application/json; charset=utf-8");
header('Access-Control-Allow-Origin: *'); // 允许所有来源的跨域请求
header('Access-Control-Allow-Methods: *'); // 允许所有HTTP方法的跨域请求
header('Access-Control-Allow-Headers: *'); // 允许所有的请求头
define('SYS_KEY','SafeYzPlus-20240209');
define('ROOT',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));//定义站点目录
error_reporting(0);
date_default_timezone_set('PRC');

require ROOT.'/includes/pdo.class.php';
require ROOT.'/includes/db.config.php';
require ROOT.'/includes/functions.php';
require ROOT.'/includes/upfile.class.php';

$db = new PdoHelper($dbconfig);

$data = filterArr(file_get_contents('php://input'));
$arr = json_decode($data,true);
?>