<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:subordinate:carmit');

#检查该代理是否属于自身子代
$row_agent = $db->find('user','*',['user_id'=>$arr['userId'],'agent_id'=>$user_info['user_id'],'create_user_id'=>$user_info['create_user_id']]);
if(!$row_agent)exJson(1,'该代理不是你的下属代理,无法添加');

#检查代理自身是否有此卡制卡权限
$row_carmit = $db->find('agent_carmit','*',['agent_id'=>$user_info['user_id'],'carmit_id'=>$arr['carmitId']]);
if(!$row_carmit)exJson(1,'此卡种不存在,无法添加');

#检查是否已经添加卡类
$row = $db->find('agent_carmit','*',['create_user_id'=>$user_info['create_user_id'],'agent_id'=>$arr['userId'],'carmit_id'=>$arr['carmitId']]);
if($row){
    exJson(1,'该卡种已经分配了');
}

#检查设置的子代制卡价格是否低于自身
if($row_carmit['carmit_money']>$arr['carmitMoney']){
    exJson(1,'子代制卡价格不能低于你的制卡价格');
}

#保存基础信息
$saveData['create_user_id'] = $user_info['create_user_id'];
$saveData['agent_id'] = $arr['userId'];
$saveData['carmit_id'] = $arr['carmitId'];
$saveData['carmit_money'] = $arr['carmitMoney'] ? $arr['carmitMoney'] : '0.00';
$saveData['notes'] = $arr['notes'];

$db->insert('agent_carmit',$saveData);

exJson(0,'操作成功');
?>