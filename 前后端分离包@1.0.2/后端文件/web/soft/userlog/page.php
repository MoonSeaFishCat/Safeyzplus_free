<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('soft:userlog:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
$logType = filterArr($_GET['logType']);
$userAccount = filterArr($_GET['userAccount']);
if($softId){
    $where['a.soft_id']=$softId;
}
if($logType!=''){
    $where['a.log_type']=$logType;
}
if($userAccount){
    $where['c.user_account']=$userAccount;
}

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select a.*,b.soft_name,c.user_account,c.user_type from pre_soft_user_log as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_soft_user as c on a.user_id=c.user_id".whereStr($where)." order by a.log_id desc limit ".($page - 1) * $pageSize.",".$pageSize);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select a.*,b.soft_name,c.user_account,c.user_type from pre_soft_user_log as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_soft_user as c on a.user_id=c.user_id".whereStr($where)." order by a.log_id desc limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['logId'] = $value['log_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['userEndtime'] = $value['user_endtime'];
    $datainfo['userPoint'] = $value['user_point'];

    if($value['user_account']){
        $datainfo['userAccount'] = $value['user_account'];
        $datainfo['userType'] = getDictionaryTagName('soft_user_type',$value['user_type']);
        $datainfo['userType_style'] = getDictionaryTagColor('soft_user_type',$value['user_type']);
    }
    $datainfo['logType'] = getDictionaryTagName('soft_user_log_type',$value['log_type']);
    $datainfo['logType_style'] = getDictionaryTagColor('soft_user_log_type',$value['log_type']);
    $datainfo['softVer'] = $value['soft_ver'];
    $datainfo['logIp'] = $value['log_ip'];
    $datainfo['logMac'] = $value['log_mac'];
    $datainfo['logInfo'] = $value['log_data'];
    $datainfo['createTime'] = $value['create_time'];
    $datalist[] = $datainfo;
}

$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>