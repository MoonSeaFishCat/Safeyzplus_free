<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:user:list');

$id = filterArr($_GET['id']);
if($id)$where['user_id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$res = $db->find('soft_user','*',$where,'user_id');
if(!$res)exJson(1,'用户不存在');
$value = $res;
$datainfo['userId'] = $value['user_id'];
$datainfo['softId'] = $value['soft_id'];
$datainfo['agentId'] = $value['agent_id'];
$datainfo['userType'] = strval($value['user_type']);
$datainfo['userAccount'] = $value['user_account'];
$datainfo['userStatus'] = strval($value['user_status']);
$datainfo['endtime'] = $value['endtime'];
$datainfo['point'] = $value['point'];
$datainfo['opening'] = $value['opening'];
$datainfo['bind'] = $value['bind'];
$datainfo['unbind'] = $value['unbind'];
$datainfo['dataExtra'] = $value['data_extra'];
$datainfo['dataCloud'] = $value['data_cloud'];
$datainfo['regIp'] = $value['reg_ip'];
$datainfo['regMac'] = $value['reg_mac'];
$datainfo['regTime'] = $value['reg_time'];
$datainfo['loginTime'] = $value['login_time'];
$datainfo['abnormalTime'] = $value['abnormal_time'];

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>