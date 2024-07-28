<?php
/** 查询子代[时间范围内]激活的充值卡 */

include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');


#需要查询的代理(只可查询自己下级代理)
$agentId = filterArr($_GET['agentId']);
if(!$agentId)exJson(1,'请输入要查询的代理账户');

$carmiStatus = filterArr($_GET['carmiStatus']);
$startTime = filterArr($_GET['startTime']);
$endTime = filterArr($_GET['endTime']);
if($startTime){
    if(!$endTime){
        $endTime = date('Y-m-d H:i:s');
    }
    if(strtotime($startTime)>strtotime($endTime)){
        exJson(1,'时间范围选择错误');
    }
    switch ($carmiStatus){
        case 0:
            $fieldName = 'create_time';
            break;
        case 1:
            $fieldName = 'update_time';
            break;
        case 2:
            $fieldName = 'use_time';
            break;
        case 3:
            $fieldName = 'update_time';
            break;
        case 4:
            $fieldName = 'update_time';
            break;
        default:
            $fieldName = 'create_time';
    }
    $timeWhere = " and ({$fieldName} BETWEEN '{$startTime}' AND '{$endTime}')";
}
if($carmiStatus>=0){
    $statusWhere = " and carmi_status={$carmiStatus}";
}

#检查是否自己下级代理
$row = $db->find('user','*',['create_user_id'=>$user_info['create_user_id'],'user_id'=>$agentId]);
if(!$row)exJson(1,'查询失败');
if($row['agent_id']!=$user_info['user_id'])exJson(1,'查询失败');

$where['a.create_user_id'] = $user_info['create_user_id'];

#按条件查询充值卡表
$resCarmi = $db->getAll("select c.user_id,c.agent_id,a.*,b.soft_name from pre_soft_carmi as a left join pre_soft as b on a.soft_id=b.soft_id left join pre_user as c on a.making_user_id=c.user_id".whereStr($where)."{$statusWhere}{$timeWhere} order by a.carmi_id");

#查询该子代激活的卡
function getCarmi($carmiList, $user_id) {
    $subs = array();     // 充值卡表
    foreach ($carmiList as $carmi) {
        if ($carmi['user_id'] == $user_id) {
            $subs[] = $carmi['carmi_str'];
        }
    }
    return $subs;
}

#查询该子代的下级激活的卡
function getCarmiNew($carmiList, $agentId) {
    $subs = array();     // 充值卡表
    $user_id = array();  // 已检索代理id,防止重复
    foreach ($carmiList as $carmi) {
        if ($carmi['agent_id'] == $agentId) {
            $subs[] = $carmi['carmi_str'];
            if(!in_array($carmi['user_id'],$user_id)){
                $subs = array_merge($subs, getCarmiNew($carmiList, $carmi['user_id']));
                array_push($user_id,$carmi['user_id']);
            }
        }
    }
    return $subs;
}

$arr_1 = getCarmi($resCarmi,$agentId);
$arr_2 = getCarmiNew($resCarmi,$agentId);
$arrNew = array_merge($arr_1,$arr_2);
exJson(0,'操作成功',$arrNew);
?>