<?php
/**
 * explain:客户端核心,可在任何接口调用
 * time:2024/01/19 16:30
 * author:樱島奈子
 */
header("Content-Type: application/json; charset=utf-8");
define('SYS_KEY','SafeYzPlus-20240209');
define('ROOT',str_replace('\\','/',realpath(dirname(__FILE__).'/../../')));//定义站点目录
error_reporting(0);
date_default_timezone_set('PRC');

require ROOT.'/includes/pdo.class.php';
require ROOT.'/includes/db.config.php';
require ROOT.'/includes/functions.php';
require ROOT.'/api/includes/coreFunc.php';
require ROOT.'/api/includes/extendFunc.php';

$db = new PdoHelper($dbconfig);

if((purge($_SERVER["CONTENT_TYPE"])!='application/json; charset=utf-8') && (purge($_SERVER["CONTENT_TYPE"])!='application/json; charset=UTF-8') && (purge($_SERVER["CONTENT_TYPE"])!='application/x-www-form-urlencoded; charset=utf-8') && (purge($_SERVER["CONTENT_TYPE"])!='application/x-www-form-urlencoded; charset=UTF-8')){
    out_e(status: 'error.content', msg: '请求标头错误,应为(application/json; charset=utf-8)或(application/x-www-form-urlencoded; charset=utf-8)');
}

if((purge($_SERVER["CONTENT_TYPE"])=='application/json; charset=utf-8') || (purge($_SERVER["CONTENT_TYPE"])=='application/json; charset=UTF-8')){
    $content_type = 0;
}elseif((purge($_SERVER["CONTENT_TYPE"])=='application/x-www-form-urlencoded; charset=utf-8') || (purge($_SERVER["CONTENT_TYPE"])!='application/x-www-form-urlencoded; charset=UTF-8')){
    $content_type = 1;
}

if(!$content_type){
    $khd_data = purge(file_get_contents('php://input')); //获取POST数据并且检测是否安全
    $data_arr = json_decode($khd_data,true);
    $softCode = $data_arr['soft'] ? $data_arr['soft'] : '';  //软件识别码
    $sign = $data_arr['sign'] ? $data_arr['sign'] : '';  //数据签名
    $data = $data_arr['data'] ? $data_arr['data'] : '';  //加密数据
}else{
    $softCode = isset($_POST['soft']) ? (purge($_POST['soft'])) : (isset($_GET['soft']) ? purge($_GET['soft']) : 0);//软件识别码
    $sign = isset($_POST['sign']) ? (purge($_POST['sign'])) : (isset($_GET['sign']) ? purge($_GET['sign']) : '');//数据签名 POST或GET
    $data = isset($_POST['data']) ? (purge($_POST['data'])) : (isset($_GET['data']) ? purge($_GET['data']) : '');//加密数据 POST或GET
    $khd_data = json_encode(['soft'=>$softCode,'data'=>$data,'sign'=>$sign]);
}

#取出软件信息
$soft = $db->find('soft','*',['soft_code'=>$softCode]);
if(!$soft){
    out_e(status: 'error.soft', msg: '未找到此软件');
}
#反序列化软件扩展数据
$softExtend = unserialize($soft['soft_extend']);
#合并软件扩展数据并删除扩展字段
$soft = array_merge($soft,$softExtend);
unset($soft['soft_extend']);

#解密客户端数据并且进行赋值
$data_arr = str_decode();

$khd_uuid = isset($data_arr['uuid']) ? purge($data_arr['uuid']) : '';  //客户端uuid
$khd_token = isset($data_arr['token']) ? purge($data_arr['token']) : '';  //客户端token
$clientid = isset($data_arr['clientid']) ? purge($data_arr['clientid']) : ''; //客户端ID
$clientos = isset($data_arr['clientos']) ? purge($data_arr['clientos']) : ''; //客户端系统
$account = isset($data_arr['account']) ? purge($data_arr['account']) : '';  //用户账号
$ver = isset($data_arr['version']) ? purge($data_arr['version']) : '';  //版本号
$version = isset($data_arr['version']) ? purge($data_arr['version']) : '';  //版本号
$mac = isset($data_arr['mac']) ? purge($data_arr['mac']) : '';  //机器码
$feature = isset($data_arr['feature']) ? purge($data_arr['feature']) : '';  //特征信息
$ip = getIp(); //来源IP地址
$md5 = isset($data_arr['md5']) ? purge($data_arr['md5']) : '';  //软件MD5
$cookie = isset($data_arr['cookie']) ? purge($data_arr['cookie']) : '';  //登录cookie
$param = isset($data_arr['param']) ? purge($data_arr['param']) : '';  //业务扩展参数

#赋值该作者的id和软件id
$soft_id = $soft['soft_id'];
$admin_id = $soft['create_user_id'];

#新增日志
insertApilog();

#调用_基础信息校验(维护检测,参数完整检测)
checkInfo();

#调用_软件md5校验(如果软件开启版本摘要校验)
checkMd5();

?>