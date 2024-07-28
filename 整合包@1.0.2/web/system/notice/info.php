<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:notice:list');

$id = filterArr($_GET['id']);
if($id)$where['notice_id']=$id;

$res = $db->find('notice','*',$where,'notice_id');
if(!$res)exJson(1,'公告不存在');
$value = $res;
$datainfo['noticeId'] = $value['notice_id'];
$datainfo['noticeType'] = $value['notice_type'];
$datainfo['noticeTitle'] = $value['notice_title'];
$datainfo['noticeInfo'] = $value['notice_info'];

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>