<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('pjc:notice:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId)$where['a.soft_id']=$softId;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select b.soft_name,a.* from pre_soft_notice as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select b.soft_name,a.* from pre_soft_notice as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where)." order by a.notice_id desc limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['noticeId'] = $value['notice_id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['noticeTop'] = $value['notice_top'];
    $datainfo['noticeTopType'] = getDictionaryTagName('top',$value['notice_top']);
    $datainfo['noticeTop_style'] = getDictionaryTagColor('top',$value['notice_top']);
    $datainfo['noticeTitle'] = $value['notice_title'];
    $datainfo['noticeInfo'] = strval($value['notice_info']);
    $datainfo['noticeType'] = $value['notice_type'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);
?>