<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:user:alter');

$saveData['status'] = intval($arr['status']);

#修改用户信息
$db->update('user',$saveData,['user_id'=>$arr['userId']]);

exJson(0,'操作成功');