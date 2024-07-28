<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('soft:user:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId)$where['soft_id']=$softId;
$userAccount = filterArr($_GET['userAccount']);
if($userAccount)$where['user_account']=$userAccount;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select * from (select b.soft_name,a.*,UNIX_TIMESTAMP(a.endtime) as endtime_s from pre_soft_user as a left join pre_soft as b on a.soft_id=b.soft_id) as a".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select * from (select b.soft_name,a.*,UNIX_TIMESTAMP(a.endtime) as endtime_s from pre_soft_user as a left join pre_soft as b on a.soft_id=b.soft_id) as a".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['userId'] = $value['user_id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['agentId'] = $value['agent_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['userType'] = getDictionaryTagName('soft_user_type',$value['user_type']);
    $datainfo['userType_style'] = getDictionaryTagColor('soft_user_type',$value['user_type']);
    $datainfo['userAccount'] = $value['user_account'];
    $datainfo['userPass'] = $value['user_pass'];
    $datainfo['userStatus'] = getDictionaryTagName('soft_user_status',$value['user_status']);
    $datainfo['userStatus_style'] = getDictionaryTagColor('soft_user_status',$value['user_status']);
    $datainfo['endtime'] = $value['endtime'];
    $datainfo['endtime_s'] = $value['endtime_s'];

    #计算未到期的用户的剩余天数
    if(strtotime($value['endtime'])>time()){
        $startDate = new DateTime($value['endtime']);
        $endDate = new DateTime(date("Y-m-d H:i:s", time()));
        $interval = $startDate->diff($endDate);
        $datainfo['endtime_sl'] = intval($interval->days);
        $datainfo['endtime_sl_s'] = intval($interval->h);
    }else{
        $datainfo['endtime_sl'] = 0;
    }
    
    $datainfo['point'] = $value['point'];
    $datainfo['opening'] = $value['opening'];
    $datainfo['bind'] = $value['bind'];
    $datainfo['unbind'] = $value['unbind'];
    $datainfo['dataExtra'] = $value['data_extra'];
    $datainfo['dataCloud'] = $value['data_cloud'];
    $datainfo['regIp'] = $value['reg_ip'];
    $datainfo['regMac'] = $value['reg_mac'];
    $datainfo['regTime'] = $value['reg_time'];
    $datainfo['loginTime'] = $value['login_time'];
    $datainfo['abnormalTime'] = $value['abnormal_time'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>