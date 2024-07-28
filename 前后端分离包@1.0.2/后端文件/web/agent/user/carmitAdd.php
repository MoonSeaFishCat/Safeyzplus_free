<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:agent:carmit');

#检查卡种是否存在
$row = $db->find('soft_carmit','carmit_id',['create_user_id'=>$user_info['user_id'],'carmit_id'=>$arr['carmitId']]);
if(!$row)exJson(1,'不存在此卡种');

#检查是否已经添加卡种
$row = $db->find('agent_carmit','*',['create_user_id'=>$user_info['user_id'],'agent_id'=>$arr['userId'],'carmit_id'=>$arr['carmitId']]);
if($row)exJson(1,'该卡种已经分配了');

#保存基础信息
$saveData['create_user_id'] = $user_info['user_id'];
$saveData['agent_id'] = $arr['userId'];
$saveData['carmit_id'] = $arr['carmitId'];
$saveData['carmit_money'] = $arr['carmitMoney'] ? $arr['carmitMoney'] : '0.00';
$saveData['notes'] = $arr['notes'];

$db->insert('agent_carmit',$saveData);

exJson(0,'操作成功');
?>