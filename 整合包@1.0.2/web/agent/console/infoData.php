<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

$datainfo['userMoney'] = $user_info['money'];
$datainfo['userConsume'] = $user_info['consume'];
$datainfo['userRebate'] = $user_info['rebate'];

/** 统计充值卡库存 */
$where['create_user_id'] = $user_info['create_user_id'];
$where['making_user_id'] = $user_info['user_id'];
#代理总卡密数量
$count = $db->count('soft_carmi',$where);
$datainfo['carmiCount'] = $count;
#未充值卡密数量
$where['carmi_status'] = 0;
$count = $db->count('soft_carmi',$where);
$datainfo['carmiNotUse'] = $count;
#已充值/出售/锁卡等卡密数量
unset($where['carmi_status']);
$count = $db->getCount("select * from pre_soft_carmi ".whereStr($where)." and carmi_status!=0");
$datainfo['carmiUse'] = $count;
if(intval($datainfo['carmiCount'])>0)$num = intval($datainfo['carmiUse']) / intval($datainfo['carmiCount']) * 100;
$datainfo['carmiRatio'] = $num ? round($num,0) : 0;

exJson(0,'操作成功',$datainfo);
?>