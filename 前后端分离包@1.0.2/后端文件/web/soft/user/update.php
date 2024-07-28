<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:user:alter');

#用户数据
$saveData['soft_id'] = intval($arr['softId']);
$saveData['agent_id'] = $arr['agentId'];
$saveData['user_type'] = intval($arr['userType']);
if($arr['userPass'] && intval($arr['userType'])==0){
    $saveData['user_pass'] = pass_mi($arr['userPass']);
}
$saveData['user_status'] = intval($arr['userStatus']);
$saveData['endtime'] = $arr['endtime'] ? $arr['endtime'] : date("Y-m-d H:i:s",time());
$saveData['point'] = $arr['point'] ? $arr['point'] : 0;
$saveData['opening'] = $arr['opening'] ? $arr['opening'] : 1;
$saveData['bind'] = $arr['bind'] ? $arr['bind'] : 1;
$saveData['unbind'] = $arr['unbind'] ? $arr['unbind'] : '-1|-1|-1|-1';
$saveData['data_extra'] = $arr['dataExtra'];
$saveData['data_cloud'] = $arr['dataCloud'];
$saveData['reg_ip'] = $arr['regIp'];
$saveData['reg_mac'] = $arr['regMac'];
$saveData['reg_time'] = $arr['regTime'] ? $arr['regTime'] : date("Y-m-d H:i:s",time());
$saveData['abnormal_time'] = $arr['user_status'] ? date("Y-m-d H:i:s",time()) : NULL;

$db->update('soft_user',$saveData,['user_id'=>$arr['userId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');