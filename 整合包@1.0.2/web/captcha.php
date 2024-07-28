<?php
header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *'); // 允许所有来源的跨域请求
header('Access-Control-Allow-Methods: *'); // 允许所有HTTP方法的跨域请求
header('Access-Control-Allow-Headers: *'); // 允许所有的请求头
define('ROOT',str_replace('\\','/',realpath(dirname(__FILE__).'/../')));//定义站点目录
include(ROOT.'/includes/functions.php');
include(ROOT.'/includes/ValidateCode.class.php');
$_vc = new ValidateCode();
$retData['base64'] = $_vc->doimg();
$retData['text'] = $_vc->getCode();
exJson(0,'操作成功',$retData);
?>