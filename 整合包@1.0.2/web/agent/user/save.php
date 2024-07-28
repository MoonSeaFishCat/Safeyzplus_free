<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:agent:save');

#查询网站设置的代理角色组
$row_web = $db->find('website','web_value',['web_key'=>'role_id_agent']);
if(!$row_web['web_value']){
    $datalist_ret['count'] = 0;
    $datalist_ret['list'] = [];
    exJson(1,'站长未设置代理角色组',$datalist_ret);
}

#检查账户是否已存在
$row = $db->find('user','*',['username'=>$arr['username'],'create_user_id'=>$user_info['user_id']]);
if($row){
    exJson(1,'该账号已存在，请换个账号');
}

#保存基础信息
$saveData['create_user_id'] = $user_info['user_id'];
$saveData['username'] = $arr['username'];
$saveData['nickname'] = $arr['nickname'];
$saveData['sex'] = intval($arr['sex']);
$saveData['open_agent'] = intval($arr['openAgent']);
$saveData['email'] = $arr['email'];
$saveData['phone'] = $arr['phone'];
$saveData['password'] = pass_mi($arr['password']);
$saveData['introduction'] = $arr['introduction'];
$saveData['birthday'] = $arr['birthday'];
$saveData['money'] = $arr['money'] ? $arr['money'] : '0.00';
$saveData['consume'] = $arr['consume'] ? $arr['consume'] : '0.00';

#新增用户信息,并且返回新增用户id
$userId = $db->insert('user',$saveData);

#进行角色组绑定
$addData['user_id'] = $userId;
$addData['role_id'] = $row_web['web_value'];
$db->insert('user_role',$addData);

exJson(0,'操作成功');
?>