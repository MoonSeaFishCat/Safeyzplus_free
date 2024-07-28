<?php
include('./common.php');

#查询网站是否开放注册作者
$row_web = $db->find('website','web_value',['web_key'=>'reg_author']);
if(!$row_web['web_value']){
    exJson(1,'站点未开放注册作者');
}

#查询网站设置的作者角色组
$row_web = $db->find('website','web_value',['web_key'=>'role_id_author']);
if(!$row_web['web_value']){
    exJson(1,'站长未设置作者角色组，无法注册');
}

if(pass_mi($arr['password'])!=pass_mi($arr['password_2'])){
    exJson(1, '两次输入密码不一致，请重新输入');
}

$saveData['username'] = $arr['username'];
$saveData['password'] = pass_mi($arr['password']);

$row = $db->getRow("select * from pre_user where username='{$saveData['username']}' and user_type=0");
if($row){
    exJson(1, '该账号已被注册');
}

$saveData['user_type'] = 0;
$saveData['status'] = 0;
$saveData['nickname'] = $arr['username'];
$saveData['email_verified'] = 0;
$saveData['money'] = '0.00';
$saveData['consume'] = '0.00';

function generate($length=12) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for($i=0;$i<$length;$i++)
    {
        $password .= $chars[mt_rand(0,strlen($chars)-1)];
    }
    return $password;
}

#账户识别码
$saveData['author_code'] = generate();

#新增用户信息,并且返回新增用户id
$userId = $db->insert('user',$saveData);

if($userId){
    #绑定归属ID
    $db->update('user',['create_user_id'=>$userId],['user_id'=>$userId]);

    #进行角色组绑定
    $addData['user_id'] = $userId;
    $addData['role_id'] = $row_web['web_value'];
    $db->insert('user_role',$addData);

    exJson(0,'注册成功，您可以进行登录啦');
}
exJson(1, '注册失败，请稍后再试');

?>