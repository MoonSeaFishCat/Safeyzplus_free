<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('soft:carmit:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId)$where['a.soft_id']=$softId;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select b.soft_name,a.* from pre_soft_carmit as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select b.soft_name,a.* from pre_soft_carmit as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['carmitId'] = $value['carmit_id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['carmitName'] = $value['carmit_name'];
    $datainfo['carmitTime'] = $value['carmit_time'];
    $datainfo['carmitPoint'] = $value['carmit_point'];
    $datainfo['carmitOpening'] = $value['carmit_opening'];
    $datainfo['carmitBind'] = $value['carmit_bind'];
    $datainfo['carmitUnbind'] = $value['carmit_unbind'];
    $datainfo['carmitLength'] = $value['carmit_length'];
    $datainfo['carmitPrefix'] = $value['carmit_prefix'];
    $datainfo['carmitDataExtra'] = $value['carmit_data_extra'];
    $datainfo['carmitNotes'] = $value['carmit_notes'];
    $datainfo['carmitMoney'] = $value['carmit_money'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>