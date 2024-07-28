<?php
include('../common.php');
include('../checkLogin.php');
include('../checkPower.php');

#检测访问权限
@checkPower('sys:auth:save');

#保存基础信息
$saveData['nickname'] = $arr['nickname'];
$saveData['sex'] = intval($arr['sex']);
$saveData['email'] = $arr['email'];
$saveData['introduction'] = $arr['introduction'];
$saveData['address'] = $arr['address'];
$saveData['tell'] = intval($arr['tell']);
$saveData['tell_pre'] = intval($arr['tellPre']);

#新增用户信息,并且返回新增用户id
$db->update('user',$saveData,['user_id'=>$user_info['user_id']]);

exJson(0,'保存成功',$saveData);
?>