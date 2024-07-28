<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:notice:alter');

#公告数据
$saveData['notice_title'] = $arr['noticeTitle'];
$saveData['notice_info'] = $arr['noticeInfo'];

$db->update('agent_notice',$saveData,['notice_id'=>$arr['noticeId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');