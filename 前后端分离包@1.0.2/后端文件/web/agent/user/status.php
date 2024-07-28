<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:agent:alter');

$saveData['status'] = intval($arr['status']);

#修改用户信息
$db->update('user',$saveData,['user_id'=>$arr['userId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');