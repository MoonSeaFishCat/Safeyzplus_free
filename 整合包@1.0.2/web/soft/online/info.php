<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:online:list');

$id = filterArr($_GET['id']);
if($id)$where['a.user_id']=$id;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$res = $db->getAll("select a.*,b.soft_name,c.user_account,c.endtime,c.point from pre_soft_cookie as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_soft_user as c on a.user_id=c.user_id ".whereStr($where));
if(!$res)exJson(1,'在线数据不存在');
$value = $res;
$datainfo['cookieId'] = $value['cookie_id'];
$datainfo['softId'] = $value['soft_id'];
$datainfo['userId'] = $value['soft_user_id'];
$datainfo['softName'] = $value['soft_name'];
$datainfo['userAccount'] = $value['user_account'] ? $value['user_account'] : '未知';
$datainfo['userEndtime'] = $value['endtime'] ? $value['endtime'] : date("Y-m-d H:i:s",time());
$datainfo['userPoint'] = $value['point'] ? $value['point'] : 0;
$datainfo['softVersion'] = $value['soft_version'];
$datainfo['loginType'] = getDictionaryTagName('soft_user_type',$value['login_type']);
$datainfo['loginType_style'] = getDictionaryTagColor('soft_user_type',$value['login_type']);
$datainfo['loginCookie'] = $value['login_cookie'];
$datainfo['loginFeature'] = $value['login_feature'];
$datainfo['loginIp'] = $value['login_ip'];
$datainfo['loginMac'] = $value['login_mac'];
$datainfo['clientID'] = $value['client_id'];
$datainfo['clientOS'] = $value['client_os'];
$datainfo['createTime'] = $value['login_time'];
$datainfo['updateTime'] = $value['heart_time'];

exJson(0,'操作成功',$datainfo);
?>