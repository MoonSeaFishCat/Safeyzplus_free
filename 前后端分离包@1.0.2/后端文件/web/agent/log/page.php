<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('pjc:agent:log');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];
$where1['a.create_user_id'] = $user_info['user_id'];

$count = $db->count('agent_log',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select a.*,b.username,b.rebate from pre_agent_log as a left join pre_user as b on a.agent_id=b.user_id".whereStr($where1)." order by a.log_id desc limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['logId'] = $value['log_id'];
    $datainfo['username'] = $value['username'];
    $datainfo['rebate'] = $value['rebate'];
    $datainfo['ip'] = $value['ip'];
    $datainfo['logType'] = getDictionaryTagName('agent_log_type',$value['log_type']);
    $datainfo['logType_style'] = getDictionaryTagColor('agent_log_type',$value['log_type']);
    $datainfo['log'] = $value['log'];
    $datainfo['money'] = $value['money'];
    $datainfo['consume'] = $value['consume'];
    $datainfo['createTime'] = $value['create_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>