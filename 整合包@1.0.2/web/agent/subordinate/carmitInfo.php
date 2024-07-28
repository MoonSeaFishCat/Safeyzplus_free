<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:subordinate:carmit');

$id = filterArr($_GET['id']);
if($id)$where['carmit_id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['create_user_id'];

#检查代理自身是否有此卡制卡权限
$row_carmit = $db->find('agent_carmit','*',['agent_id'=>$user_info['user_id'],'create_user_id'=>$user_info['create_user_id'],'carmit_id'=>$id]);
if(!$row_carmit)exJson(1,'卡种不存在');

$res = $db->find('soft_carmit','*',$where,'carmit_id');
if(!$res)exJson(1,'卡种不存在');
$value = $res;
$datainfo['carmitId'] = $value['carmit_id'];
$datainfo['softId'] = $value['soft_id'];
unset($where['carmit_id']);
$where['soft_id'] = $value['soft_id'];
$row = $db->find('soft','*',$where);
$datainfo['softName'] = $row['soft_name'];
$datainfo['carmitName'] = $value['carmit_name'];
$datainfo['carmitTime'] = $value['carmit_time'];
$datainfo['carmitPoint'] = $value['carmit_point'];
$datainfo['carmitOpening'] = $value['carmit_opening'];
$datainfo['carmitBind'] = $value['carmit_bind'];
$datainfo['carmitUnbind'] = $value['carmit_unbind'];
$datainfo['carmitLength'] = $value['carmit_length'];
$datainfo['carmitPrefix'] = $value['carmit_prefix'];
$datainfo['carmitDataExtra'] = $value['carmit_data_extra'];
$datainfo['carmitNotes'] = $value['carmit_notes'];
$datainfo['carmitMoney'] = $row_carmit['carmit_money'];

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>