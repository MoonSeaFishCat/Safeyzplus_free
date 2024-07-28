<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:notice:save');

#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

#公告数据
$saveData['soft_id'] = intval($arr['softId']);
$saveData['notice_top'] = $arr['noticeTop'];
$saveData['notice_title'] = $arr['noticeTitle'];
$saveData['notice_info'] = $arr['noticeInfo'];
$saveData['notice_type'] = $arr['noticeType'];

$db->insert('soft_notice',$saveData);

exJson(0,'操作成功');
?>