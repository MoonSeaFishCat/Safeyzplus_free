<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:subordinate:alter');

$saveData['password'] = pass_mi($arr['password']);

$db->update('user',$saveData,['user_id'=>$arr['userId'],'create_user_id'=>$user_info['create_user_id'],'agent_id'=>$user_info['user_id']]);

exJson(0,'操作成功');