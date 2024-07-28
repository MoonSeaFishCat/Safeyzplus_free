<?php
/**
 * explain:充值
 * time:2024/01/24 21:05
 * author:樱島奈子
 */
require './includes/core.php';

$carmi = isset($data_arr['carmi']) ? purge($data_arr['carmi']) : '';
if(!$carmi)retOut(status: 'success', code: 310, msg: '请输入充值卡号', soft: $soft);

$userInfo = getUserAccount(userAccount: $account, needPass: false);
if(!$userInfo)retOut(status: 'success', code: 304, msg: '账号/卡号错误,请重新输入', soft: $soft);

//验证用户状态
$u = checkUserStatus(userInfo: $userInfo);
if($u==1)retOut(status: 'success', code: 253, msg: '用户已被封禁,无法充值', soft: $soft);
if($u==2)retOut(status: 'success', code: 254, msg: '用户已被冻结,无法充值', soft: $soft);

$carmiInfo = getCarmiInfo($carmi);
if(!$carmiInfo)retOut(status: 'success', code: 303, msg: '充值卡号错误,请重新输入', soft: $soft);
if($carmiInfo['carmi_status']==2)retOut(status: 'success', code: 311, msg: '该充值卡已被使用', soft: $soft);
if($carmiInfo['carmi_status']==3)retOut(status: 'success', code: 312, msg: '该充值卡已失效', soft: $soft);
if($carmiInfo['carmi_status']==4)retOut(status: 'success', code: 313, msg: '该充值卡已被锁定', soft: $soft);

$row = rechargeUserCarmi(userInfo: $userInfo, carmiInfo: $carmiInfo);
if(!$row){
    retOut(status: 'success', code: 314, msg: '充值失败,请稍后再试!', soft: $soft);
}
retOut(status: 'success', code: 200, msg: '充值成功!', soft: $soft);
?>