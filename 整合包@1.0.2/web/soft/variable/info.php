<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:variable:list');

$id = filterArr($_GET['id']);
if($id)$where['id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$res = $db->find('soft_variable','*',$where,'id');
if(!$res)exJson(1,'变量不存在');
$value = $res;
$datainfo['id'] = $value['id'];
$datainfo['softId'] = $value['soft_id'];

$where['soft_id'] = $value['soft_id'];
$row = $db->find('soft','*',$where);

$datainfo['softName'] = $row['soft_name'];
$datainfo['vKey'] = $value['v_key'];
$datainfo['vValue'] = $value['v_value'];
$datainfo['vType'] = $value['v_type'];
$datainfo['vDel'] = $value['v_del'];
$datainfo['vAlter'] = $value['v_alter'];
$datainfo['vRead'] = $value['v_read'];
$datainfo['vWrite'] = $value['v_write'];
$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>