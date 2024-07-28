<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('sys:role:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$roleName = filterArr($_GET['roleName']);
$roleCode = filterArr($_GET['roleCode']);
if($roleName)$where['role_name']=$roleName;
if($roleCode)$where['role_code']=$roleCode;
$where['deleted'] = 0;
$count = $db->count('role',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}
$res = $db->findAll('role','*',$where,'role_id',$limit);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['roleId'] = $value['role_id'];
    $datainfo['roleName'] = $value['role_name'];
    $datainfo['roleCode'] = $value['role_code'];
    $datainfo['comments'] = $value['comments'];
    $datainfo['deleted'] = $value['deleted'];
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>