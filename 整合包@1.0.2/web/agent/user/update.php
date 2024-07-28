<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:agent:alter');

$saveData['nickname'] = $arr['nickname'];
$saveData['sex'] = intval($arr['sex']);
$saveData['open_agent'] = intval($arr['openAgent']);
$saveData['birthday'] = $arr['birthday'];
$saveData['email'] = $arr['email'];
$saveData['phone'] = $arr['phone'];
$saveData['introduction'] = $arr['introduction'];
$saveData['money'] = $arr['money'];
$saveData['consume'] = $arr['consume'];

#修改用户信息
$db->update('user',$saveData,['user_id'=>$arr['userId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');