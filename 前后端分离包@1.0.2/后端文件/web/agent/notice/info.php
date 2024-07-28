<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:notice:list');

$id = filterArr($_GET['id']);
if($id)$where['notice_id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$res = $db->find('agent_notice','*',$where,'notice_id');
if(!$res)exJson(1,'公告不存在');
$value = $res;
$datainfo['noticeId'] = $value['notice_id'];
$datainfo['noticeTitle'] = $value['notice_title'];
$datainfo['noticeInfo'] = $value['notice_info'];

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>