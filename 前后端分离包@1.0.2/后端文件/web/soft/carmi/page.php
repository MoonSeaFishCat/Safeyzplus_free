<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('soft:carmi:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId)$where['a.soft_id']=$softId;

$carmiStatus = filterArr($_GET['carmiStatus']);
if($carmiStatus)$where['a.carmi_status']=$carmiStatus;

$carmiStr = filterArr($_GET['carmiStr']);
if($carmiStr)$where['a.carmi_str']=$carmiStr;

$carmiPch = filterArr($_GET['carmiPch']);
if($carmiPch)$where['a.carmi_pch']=$carmiPch;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select b.soft_name,c.username,d.user_account,a.* from pre_soft_carmi as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_user as c on a.making_user_id=c.user_id left join pre_soft_user as d on a.use_soft_user_id=d.user_id".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select b.soft_name,c.username,d.user_account,a.* from pre_soft_carmi as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_user as c on a.making_user_id=c.user_id left join pre_soft_user as d on a.use_soft_user_id=d.user_id".whereStr($where)." order by a.carmi_id desc limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['carmiId'] = $value['carmi_id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['carmiStatus'] = getDictionaryTagName('carmi_status',$value['carmi_status']);
    $datainfo['carmiStatus_style'] = getDictionaryTagColor('carmi_status',$value['carmi_status']);
    $datainfo['carmiStr'] = $value['carmi_str'];
    $datainfo['carmiName'] = $value['carmi_name'];
    $datainfo['carmiTime'] = $value['carmi_time'];
    $datainfo['carmiPoint'] = $value['carmi_point'];
    $datainfo['carmiOpening'] = $value['carmi_opening'];
    $datainfo['carmiBind'] = $value['carmi_bind'];
    $datainfo['carmiUnbind'] = $value['carmi_unbind'];
    $datainfo['carmiDataExtra'] = $value['carmi_data_extra'];
    $datainfo['carmiNotes'] = $value['carmi_notes'];
    $datainfo['carmiPch'] = $value['carmi_pch'];

    #制卡信息
    $datainfo['makingUser'] = $value['username'] ? $value['username'] : '';
    $datainfo['makingMoney'] = $value['making_money'];

    #充值信息
    $datainfo['useUser'] = $value['user_account'] ? $value['user_account'] : '';
    $datainfo['useTime'] = $value['use_time'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>