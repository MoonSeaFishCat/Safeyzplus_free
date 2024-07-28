<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:role:list');

$res = $db->findAll('role','*','','role_id');
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
exJson(0,'操作成功',$datalist);

?>