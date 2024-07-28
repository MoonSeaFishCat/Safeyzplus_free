<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:notice:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$count = $db->count('agent_notice',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->findAll('agent_notice','*',$where,'',$limit);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['noticeId'] = $value['notice_id'];
    $datainfo['noticeTitle'] = $value['notice_title'];
    $datainfo['noticeInfo'] = $value['notice_info'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>