<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('pjc:agent:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);

$username = filterArr($_GET['username']);
$nickname = filterArr($_GET['nickname']);
$sex = filterArr($_GET['sex']);
if($username)$where['b.username']=$username;
if($nickname)$where['b.nickname']=$nickname;
if($sex)$where['b.sex']=$sex;
$where['b.create_user_id'] = $user_info['user_id'];

#查询网站设置的代理角色组
$row = $db->find('website','web_value',['web_key'=>'role_id_agent']);
if(!$row){
    $datalist_ret['count'] = 0;
    $datalist_ret['list'] = [];
    exJson(1,'站长未设置代理角色组',$datalist_ret);
}
$where['a.role_id'] = $row['web_value'];

$count = $db->getCount("select b.* from pre_user_role as a left join pre_user as b on a.user_id=b.user_id".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}
$res = $db->getAll("select b.* from pre_user_role as a left join pre_user as b on a.user_id=b.user_id".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['userId'] = $value['user_id'];
    $datainfo['openAgent'] = strval($value['open_agent']);
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
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datainfo['loginTime'] = $value['login_time'];
    $datainfo['introduction'] = $value['introduction'];
    $datainfo['money'] = $value['money'];
    $datainfo['consume'] = $value['consume'];

    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>