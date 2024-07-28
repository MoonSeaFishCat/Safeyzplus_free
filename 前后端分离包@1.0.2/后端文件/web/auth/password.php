<?php
include('../common.php');
include('../checkLogin.php');
include('../checkPower.php');

#检测访问权限
@checkPower('sys:auth:password');

$oldPassword = filterArr($arr['oldPassword']);
$password = filterArr($arr['password']);
$password2 = filterArr($arr['password2']);

if($password!=$password2){
    exJson(1,'两次密码输入不一致');
}

$oldPassword = pass_mi($oldPassword);
$row = $db->find('user','*',['username'=>$user_info['username'],'password'=>$oldPassword]);
if(!$row){
    exJson(1,'旧密码输入错误');
}

$saveData['password'] = pass_mi($password);

$db->update('user',$saveData,['user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');