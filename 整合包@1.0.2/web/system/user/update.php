<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:user:alter');

$saveData['user_type'] = $arr['userType'];
$saveData['nickname'] = $arr['nickname'];
$saveData['sex'] = intval($arr['sex']);
$saveData['birthday'] = $arr['birthday'];
$saveData['email'] = $arr['email'];
$saveData['phone'] = $arr['phone'];
$saveData['introduction'] = $arr['introduction'];
$saveData['money'] = $arr['money'];
$saveData['consume'] = $arr['consume'];
$saveData['money_2'] = $arr['money2'];

#绑定归属ID
if($arr['userType']==0){
    $db->exec("update pre_user set create_user_id=NULL where user_id={$arr['userId']}");
}else{
    if(!$arr['createId'])exJson(0,'新建失败，请选择归属作者');
    $db->exec("update pre_user set create_user_id={$arr['createId']} where user_id={$arr['userId']}");
}

#修改用户信息
$db->update('user',$saveData,['user_id'=>$arr['userId']]);

#清空用户绑定角色组然后重新进行绑定
$db->delete('user_role',['user_id'=>$arr['userId']]);
foreach ($arr['roles'] as $value){
    $addData['user_id'] = $arr['userId'];
    $addData['role_id'] = $value['roleId'];
    $db->insert('user_role',$addData);
}

exJson(0,'操作成功');