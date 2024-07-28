<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('soft:apilog:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId){
    $where['soft_id']=$softId;
    $where1['a.soft_id']=$softId;
}

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];
$where1['a.create_user_id'] = $user_info['user_id'];

$count = $db->count('soft_api_log',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select a.*,b.soft_name,c.user_account,c.user_type from pre_soft_api_log as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_soft_user as c on a.soft_user_id=c.user_id".whereStr($where1)." order by a.log_id desc limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['logId'] = $value['log_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['apiName'] = $value['api_name'];
    $datainfo['apiUrl'] = $value['api_url'];

    if($value['user_account']){
        $datainfo['userAccount'] = $value['user_account'];
        $datainfo['userType'] = getDictionaryTagName('soft_user_type',$value['user_type']);
        $datainfo['userType_style'] = getDictionaryTagColor('soft_user_type',$value['user_type']);
    }

    $datainfo['encInfo'] = unserialize($value['enc_info']);
    $datainfo['decrInfo'] = unserialize($value['decr_info']);
    
    $datainfo['fromVer'] = $value['from_ver'];
    $datainfo['fromIp'] = $value['from_ip'];
    $datainfo['fromMac'] = $value['from_mac'];
    $datainfo['createTime'] = $value['create_time'];
    $datalist[] = $datainfo;
}

$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>