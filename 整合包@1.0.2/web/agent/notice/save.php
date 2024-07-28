<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:notice:save');

#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

#公告数据
$saveData['notice_title'] = $arr['noticeTitle'];
$saveData['notice_info'] = $arr['noticeInfo'];

$db->insert('agent_notice',$saveData);

exJson(0,'操作成功');
?>