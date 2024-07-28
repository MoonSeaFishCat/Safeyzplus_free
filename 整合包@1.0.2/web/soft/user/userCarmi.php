<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:soft:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$userId = filterArr($_GET['userId']);
if($userId)$where['use_soft_user_id']=$userId;

$where['carmi_status'] = 2;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$count = $db->count('soft_carmi',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->findAll('soft_carmi','*',$where,'carmi_id',$limit);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['carmiStr'] = $value['carmi_str'];
    $datainfo['carmiName'] = $value['carmi_name'];
    $datainfo['carmiTime'] = $value['carmi_time'];
    $datainfo['carmiPoint'] = $value['carmi_point'];

    $datainfo['useTime'] = $value['use_time'];
    $datainfo['useEndtime'] = $value['use_endtime'];
    $datainfo['usePoint'] = $value['use_point'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>