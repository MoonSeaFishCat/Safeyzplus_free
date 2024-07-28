<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:edition:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId)$where['a.soft_id']=$softId;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select b.soft_name,a.* from pre_soft_version as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select b.soft_name,a.* from pre_soft_version as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['versionId'] = $value['version_id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['version'] = $value['version'];
    $datainfo['md5'] = $value['md5'];
    $datainfo['url'] = $value['url'];
    $datainfo['log'] = $value['log'];
    $datainfo['nversion'] = $value['nversion'];
    $datainfo['gxfs'] = $value['gxfs'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>