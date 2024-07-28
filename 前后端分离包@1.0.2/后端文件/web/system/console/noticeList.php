<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

$count = $db->count('notice',$where);
if(!$count){
    exJson(0,'操作成功',[]);
}

$res = $db->findAll('notice','*',$where,'create_time desc');
foreach ($res as $value){
    $datainfo = array();
    $datainfo['noticeId'] = $value['notice_id'];
    $datainfo['noticeType'] = $value['notice_type'];
    $datainfo['noticeTitle'] = $value['notice_title'];
    $datainfo['noticeInfo'] = $value['notice_info'];

    $datainfo['createTimeX'] = date('Y-m-d',strtotime($value['create_time']));
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>