<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:carmi:list');

$id = filterArr($_GET['id']);
if($id)$where['user_id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$res = $db->find('soft_carmi','*',$where,'user_id');
if(!$res)exJson(1,'卡密不存在');
$value = $res;
$datainfo['carmiId'] = $value['carmi_id'];
$datainfo['softId'] = $value['soft_id'];
$where['soft_id'] = $value['soft_id'];
$row = $db->find('soft','*',$where);
$datainfo['softName'] = $row['soft_name'];
$datainfo['carmiStatus'] = $value['carmi_status'];
$datainfo['carmiStr'] = $value['carmi_str'];
$datainfo['carmiName'] = $value['carmi_name'];
$datainfo['carmiTime'] = $value['carmi_time'];
$datainfo['carmiPoint'] = $value['carmi_point'];
$datainfo['carmiOpening'] = $value['carmi_opening'];
$datainfo['carmiBind'] = $value['carmi_bind'];
$datainfo['carmiUnbind'] = $value['carmi_unbind'];
$datainfo['carmiNotes'] = $value['carmi_notes'];
$datainfo['carmiPch'] = $value['carmi_pch'];

#制卡信息
unset($where['soft_id']);
if($value['use_soft_user_id']){
    $where['user_id'] = $value['making_user_id'];
    $row = $db->find('user','*',$where);
}
$datainfo['makingUser'] = $row['username'] ? $row['username'] : '';
$datainfo['makingMoney'] = $value['making_money'];

#充值信息
if($value['use_soft_user_id']){
    $where['user_id'] = $value['use_soft_user_id'];
    $row = $db->find('soft_user','*',$where);
}
$datainfo['useUser'] = $row['user_account'] ? $row['user_account'] : '';
$datainfo['useTime'] = $value['use_time'];

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>