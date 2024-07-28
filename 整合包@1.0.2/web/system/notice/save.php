<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:notice:save');

#公告数据
$saveData['notice_type'] = $arr['noticeType'];
$saveData['notice_title'] = $arr['noticeTitle'];
$saveData['notice_info'] = $arr['noticeInfo'];

$db->insert('notice',$saveData);

exJson(0,'操作成功');
?>