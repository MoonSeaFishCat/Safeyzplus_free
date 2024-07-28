<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:user:save');

if($arr['userType']==1 && !$arr['createId']){
    exJson(0,'新建失败，请选择归属作者');
}

#检查账户是否已存在
if($arr['userType']==1){
    $row = $db->getRow("select * from pre_user where username={$arr['username']} and user_type={$arr['userType']} and create_user_id={$arr['createId']}");
}else{
    $row = $db->getRow("select * from pre_user where username={$arr['username']} and user_type={$arr['userType']}");
}
if($row){
    exJson(1,'该账号已存在，请换个账号'); 
}

function generate($length=12) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for($i=0;$i<$length;$i++)
    {
        $password .= $chars[mt_rand(0,strlen($chars)-1)];
    }
    return $password;
}

#保存基础信息
$saveData['user_type'] = $arr['userType'];
$saveData['username'] = $arr['username'];
$saveData['nickname'] = $arr['nickname'];
$saveData['sex'] = intval($arr['sex']) ? intval($arr['sex']) : 1;
$saveData['email'] = $arr['email'];
$saveData['phone'] = $arr['phone'];
$saveData['password'] = pass_mi($arr['password']);
$saveData['introduction'] = $arr['introduction'];
$saveData['birthday'] = $arr['birthday'];
$saveData['money'] = $arr['money'] ? $arr['money'] : '0.00';
$saveData['consume'] = $arr['consume'] ? $arr['consume'] : '0.00';
$saveData['money_2'] = $arr['money2'] ? $arr['money2'] : '0.00';

#账户识别码
$saveData['author_code'] = generate();

#新增用户信息,并且返回新增用户id
$row = $db->insert('user',$saveData);

#绑定归属ID
if($arr['userType']==0){
    $db->update('user',['create_user_id'=>$row],['user_id'=>$row]);
}else{
    if(!$arr['createId'])exJson(0,'新建失败，请选择归属作者');
    $db->update('user',['create_user_id'=>$arr['createId']],['user_id'=>$row]);
}

#进行角色组绑定
foreach ($arr['roles'] as $value){
    $addData['user_id'] = $row;
    $addData['role_id'] = $value['roleId'];
    $db->insert('user_role',$addData);
}

exJson(0,'操作成功');
?>