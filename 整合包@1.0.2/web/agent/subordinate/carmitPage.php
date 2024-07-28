<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('agent:subordinate:carmit');

$type = filterArr($_GET['type']);
$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$agentId = filterArr($_GET['agentId']);

if($type==1){
    $where['a.agent_id'] = $user_info['user_id'];
    $where['a.create_user_id'] = $user_info['create_user_id'];
}else{
    #检查该代理是否属于自身子代
    $row_agent = $db->find('user','*',['user_id'=>$agentId,'agent_id'=>$user_info['user_id'],'create_user_id'=>$user_info['create_user_id']]);
    if(!$row_agent)exJson(1,'该代理不是你的下属代理');
    $where['a.agent_id'] = $agentId;
    $where['a.create_user_id'] = $user_info['create_user_id'];
}

$count = $db->getCount("select a.* from pre_agent_carmit as a left join pre_soft_carmit as b on a.carmit_id=b.carmit_id left join pre_soft as c on b.soft_id=c.soft_id".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}
$res = $db->getAll("select a.*,c.soft_name,b.carmit_name,b.carmit_time,b.carmit_point,b.carmit_opening,b.carmit_bind from pre_agent_carmit as a left join pre_soft_carmit as b on a.carmit_id=b.carmit_id left join pre_soft as c on b.soft_id=c.soft_id".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['id'] = $value['id'];
    $datainfo['carmitId'] = $value['carmit_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['carmitMoney'] = $value['carmit_money'];
    $datainfo['notes'] = $value['notes'];
    $datainfo['carmitName'] = $value['carmit_name'];
    $datainfo['carmitTime'] = $value['carmit_time'];
    $datainfo['carmitPoint'] = $value['carmit_point'];
    $datainfo['carmitOpening'] = $value['carmit_opening'];
    $datainfo['carmitBind'] = $value['carmit_bind'];
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];

    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>