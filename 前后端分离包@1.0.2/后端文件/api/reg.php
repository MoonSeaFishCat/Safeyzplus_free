<?php
/**
 * explain:注册
 * time:2024/01/25 12:58
 * author:樱島奈子
 */
require './includes/core.php';

$account_pass = isset($data_arr['account_pass']) ? purge($data_arr['account_pass']) : '';
$carmi = isset($data_arr['carmi']) ? purge($data_arr['carmi']) : '';

if(!$account)retOut(status: 'success', code: 300, msg: '账号不可为空,请重新输入', soft: $soft);
if(!$account_pass)retOut(status: 'success', code: 301, msg: '密码不可为空,请重新输入', soft: $soft);

$userInfo = getUserAccount(userAccount: $account, needPass: false);
if($userInfo)retOut(status: 'success', code: 321, msg: '该账号已被注册,请换个账号进行注册', soft: $soft);

$regGive = 1;
$regGiveCount = $db->count('soft_user',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'reg_feature'=>$feature,'user_type'=>0]);
if($regGiveCount>=$soft['reg_give_feature'])$regGive=0;

switch ($soft['reg_type']){
    case 0:
        //关闭注册
        retOut(status: 'success', code: 320, msg: '软件关闭了注册功能,请等待开放', soft: $soft);
        break;
    case 1:
        //开放注册
        break;
    case 2:
        //卡号注册
        if(!$carmi)retOut(status: 'success', code: 310, msg: '注册账户需要充值卡,请输入充值卡号', soft: $soft);
        $carmiInfo = getCarmiInfo(carmi: $carmi);
        if(!$carmiInfo)retOut(status: 'success', code: 303, msg: '充值卡号错误,请重新输入', soft: $soft);
        if($carmiInfo['carmi_status']==2)retOut(status: 'success', code: 311, msg: '该充值卡已被使用', soft: $soft);
        if($carmiInfo['carmi_status']==3)retOut(status: 'success', code: 312, msg: '该充值卡已失效', soft: $soft);
        if($carmiInfo['carmi_status']==4)retOut(status: 'success', code: 313, msg: '该充值卡已被锁定', soft: $soft);
        break;
    case 3:
        //特征限制(自定义次数)
        $count = $db->count('soft_user',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'reg_feature'=>$feature,'user_type'=>0]);
        if($count>=$soft['reg_type_sl'])retOut(status: 'success', code: 325, msg: '该特征注册已达上限,无法注册', soft: $soft);
        break;
    case 4:
        //IP限制(自定义次数)
        $count = $db->count('soft_user',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'reg_ip'=>$ip,'user_type'=>0]);
        if($count>=$soft['reg_type_sl'])retOut(status: 'success', code: 326, msg: '该IP注册已达上限,无法注册', soft: $soft);
        break;
    case 5:
        //设备限制(自定义次数)
        $count = $db->count('soft_user',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'reg_mac'=>$mac,'user_type'=>0]);
        if($count>=$soft['reg_type_sl'])retOut(status: 'success', code: 327, msg: '该设备注册已达上限,无法注册', soft: $soft);
        break;
}

if($regGive){
    $regGiveTime = $soft['reg_give_time'] * 60;
    $regGivePoint = $soft['reg_give_point'];
}

//生成用户数据
if($carmiInfo){
    $soft_user_info['create_user_id'] = $soft['create_user_id'];
    $soft_user_info['soft_id'] = $soft['soft_id'];
    $soft_user_info['user_type'] = 0;
    $soft_user_info['user_account'] = $account;
    $soft_user_info['user_pass'] = pass_mi($account_pass);
    $endtime = time() + $carmiInfo['carmi_time'] * 60 + $regGiveTime;
    $soft_user_info['endtime'] = timetostr($endtime);
    $soft_user_info['point'] = $carmiInfo['carmi_point'] + $regGivePoint;
    $soft_user_info['opening'] = $carmiInfo['carmi_opening'];
    $soft_user_info['bind'] = $carmiInfo['carmi_bind'];
    $soft_user_info['unbind'] = $carmiInfo['carmi_unbind'];
    $soft_user_info['data_extra'] = $carmiInfo['carmi_data_extra'];
    $soft_user_info['reg_ip'] = $ip;
    $soft_user_info['reg_mac'] = $mac;
    $soft_user_info['reg_feature'] = $feature;
    $row = $db->insert('soft_user',$soft_user_info);
}else{
    $soft_user_info['create_user_id'] = $soft['create_user_id'];
    $soft_user_info['soft_id'] = $soft['soft_id'];
    $soft_user_info['user_type'] = 0;
    $soft_user_info['user_account'] = $account;
    $soft_user_info['user_pass'] = pass_mi($account_pass);
    $endtime = time() + $regGiveTime;
    $soft_user_info['endtime'] = timetostr($endtime);
    $soft_user_info['point'] = $regGivePoint;
    $soft_user_info['reg_ip'] = $ip;
    $soft_user_info['reg_mac'] = $mac;
    $soft_user_info['reg_feature'] = $feature;
    $row = $db->insert('soft_user',$soft_user_info);
}
if(!$row)retOut(status: 'success', code: 328, msg: '注册失败,请稍后再试', soft: $soft);
retOut(status: 'success', code: 200, msg: '注册成功!', soft: $soft);
?>