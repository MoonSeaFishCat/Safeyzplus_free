<?php
include('../common.php');

$softCode = filterArr($_GET['soft']);
if($softCode)$where['b.soft_code']=$softCode;

$count = $db->getCount("select b.soft_name,a.* from pre_soft_notice as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where));
if(!$count){
    exJson(0,'暂无公告');
}

$res = $db->getAll("select b.soft_name,a.* from pre_soft_notice as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where).' order by a.notice_id desc');
foreach ($res as $value){
    $datainfo = array();
    $datainfo['noticeId'] = $value['notice_id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['noticeTitle'] = $value['notice_title'];
    $datainfo['noticeInfo'] = $value['notice_info'];
    $datainfo['noticeType'] = $value['notice_type'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);
?>