<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:role:alter');

$saveData['role_name'] = $arr['roleName'];
$saveData['role_code'] = $arr['roleCode'];
$saveData['comments'] = $arr['comments'];

$db->update('role',$saveData,['role_id'=>$arr['roleId']]);

exJson(0,'操作成功');