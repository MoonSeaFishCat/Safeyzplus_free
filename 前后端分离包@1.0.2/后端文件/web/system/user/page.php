<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('sys:user:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$username = filterArr($_GET['username']);
$nickname = filterArr($_GET['nickname']);
$sex = filterArr($_GET['sex']);
if($username)$where['username']=$username;
if($nickname)$where['nickname']=$nickname;
if($sex)$where['sex']=$sex;
$count = $db->count('user',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}
$res = $db->findAll('user','*',$where,'user_id',$limit);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['userId'] = $value['user_id'];
    $datainfo['createId'] = $value['create_user_id'];
    $datainfo['userType'] = strval($value['user_type']);
    $datainfo['username'] = $value['username'];
    $datainfo['password'] = $value['password'];
    $datainfo['status'] = $value['status'];
    $datainfo['nickname'] = $value['nickname'];
    $datainfo['sex'] = strval($value['sex']);
    $datainfo['sexName'] = getDictionaryValue('sex',$value['sex']);
    $datainfo['phone'] = $value['phone'];
    $datainfo['email'] = $value['email'];
    $datainfo['emailVerified'] = $value['email_verified'];
    $datainfo['realName'] = $value['real_name'];
    $datainfo['idCard'] = $value['id_card'];
    $datainfo['birthday'] = $value['birthday'];
    $datainfo['loginTime'] = $value['login_time'];
    $datainfo['introduction'] = $value['introduction'];
    $datainfo['money'] = $value['money'];
    $datainfo['consume'] = $value['consume'];
    $datainfo['money2'] = $value['money_2'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];

    #读取显示用户绑定角色组
    $role = $db->getAll("select a.*,b.comments,b.deleted,b.role_code,b.role_name from pre_user_role as a left join pre_role as b on a.role_id=b.role_id where a.user_id=".$value['user_id']);
    foreach ($role as $value_role){
        $datainfo_role = array();
        $datainfo_role['userId'] = $value_role['user_id'];
        $datainfo_role['roleId'] = $value_role['role_id'];
        $datainfo_role['createTime'] = $value_role['create_time'];
        $datainfo_role['updateTime'] = $value_role['update_time'];
        $datainfo_role['comments'] = $value_role['comments'];
        $datainfo_role['deleted'] = $value_role['deleted'];
        $datainfo_role['roleCode'] = $value_role['role_code'];
        $datainfo_role['roleName'] = $value_role['role_name'];
        $datainfo['roles'][] = $datainfo_role;
    }
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>