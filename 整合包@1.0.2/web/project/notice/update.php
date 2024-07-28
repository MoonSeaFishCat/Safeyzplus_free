<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:notice:alter');

#公告数据
$saveData['soft_id'] = intval($arr['softId']);
$saveData['notice_top'] = $arr['noticeTop'];
$saveData['notice_title'] = $arr['noticeTitle'];
$saveData['notice_info'] = $arr['noticeInfo'];
$saveData['notice_type'] = $arr['noticeType'];

$db->update('soft_notice',$saveData,['notice_id'=>$arr['noticeId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');