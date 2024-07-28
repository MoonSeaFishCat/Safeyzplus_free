<?php
include('../common.php');
include('../checkLogin.php');
include('../checkPower.php');

#检测访问权限
@checkPower('sys:auth:charge');

$sl =  filterArr($arr['data']);

$res = $db->find('website','*',['web_key'=>'soft_charge']);
if(!$res['web_value'])exJson(1,'站长暂时未配置充电比例');

$money = $sl  / $res['web_value'];
$money = round($money, 2);

if($user_info['money']<$money)exJson(1,'当前账户余额不足,无法充电');

$saveData['money'] = $user_info['money'] - $money;
$saveData['consume'] = $user_info['consume'] + $money;
$saveData['money_2'] = $user_info['money_2'] + $sl;

$db->update('user',$saveData,['user_id'=>$user_info['user_id']]);

exJson(0,'充值成功');