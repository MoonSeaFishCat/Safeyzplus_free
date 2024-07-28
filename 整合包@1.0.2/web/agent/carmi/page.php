<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('agent:carmi:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$name = filterArr($_GET['softName']);
if($name)$where['b.soft_name']=$name;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['create_user_id'];
#添加代理id
$where['a.making_user_id'] = $user_info['user_id'];

$count = $db->getCount("select b.soft_name,c.username,d.user_account,a.* from pre_soft_carmi as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_user as c on a.making_user_id=c.user_id left join pre_soft_user as d on a.use_soft_user_id=d.user_id".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select b.soft_name,c.username,d.user_account,a.* from pre_soft_carmi as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_user as c on a.making_user_id=c.user_id left join pre_soft_user as d on a.use_soft_user_id=d.user_id".whereStr($where)." order by a.carmi_id limit ".($page - 1) * $pageSize.",".$pageSize);
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