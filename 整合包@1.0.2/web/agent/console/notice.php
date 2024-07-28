<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['create_user_id'];

$count = $db->count('agent_notice',$where);
if(!$count){
    exJson(0,'操作成功',[]);
}

$res = $db->findAll('agent_notice','*',$where,'create_time desc');
foreach ($res as $value){
    $datainfo = array();
    $datainfo['noticeId'] = $value['notice_id'];
    $datainfo['noticeTitle'] = $value['notice_title'];
    $datainfo['noticeInfo'] = $value['notice_info'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>