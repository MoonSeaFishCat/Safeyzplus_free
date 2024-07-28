<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

function generate($length=8) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for($i=0;$i<$length;$i++)
    {
        $password .= $chars[mt_rand(0,strlen($chars)-1)];
    }
    return $password;
}

#检测访问权限
@checkPower('agent:carmi:save');

$addsl = intval($arr['addCount']);
if($addsl<=0)$addsl = 1;

$carmiNotes = $arr['carmitNotes'];
#获取卡种id
$carmitId = intval($arr['carmitId']);

#获取卡种信息
$row_carmit = $db->find('soft_carmit','*',['carmit_id'=>$carmitId,'create_user_id'=>$user_info['create_user_id']]);
if(!$row_carmit)exJson(1,'不存在此卡种');

#检查代理自身是否有此卡制卡权限
$row_agent_carmit = $db->find('agent_carmit','*',['create_user_id'=>$user_info['create_user_id'],'agent_id'=>$user_info['user_id'],'carmit_id'=>$arr['carmitId']]);
if(!$row_agent_carmit)exJson(1,'不存在此卡种');

#查询软件信息
$soft_info = $db->find('soft','*',['soft_id'=>$row_carmit['soft_id']]);

#检查账户余额是否足够
$userMoney = $user_info['money'];
$addMoney = $row_agent_carmit['carmit_money'] * $addsl;
if($userMoney < $addMoney)exJson(1,'当前账户余额不足'.$addMoney.'元，无法生产充值卡');
$moneyNew = $user_info['money'] - $addMoney;
$consumeNew = $user_info['consume'] + $addMoney;
$u = $db->update('user',['money'=>$moneyNew,'consume'=>$consumeNew],['user_id'=>$user_info['user_id']]);
if(!$u)exJson(1,'账户余额扣除失败，请稍后重试');

#检查代理上级 并进行返利
if($user_info['agent_id']){
    $agent_info = $db->find('user','*',['user_id'=>$user_info['agent_id'],'create_user_id'=>$user_info['create_user_id']]);
    if($agent_info){
        $agent_carmit = $db->find('agent_carmit','*',['agent_id'=>$user_info['agent_id'],'create_user_id'=>$user_info['create_user_id'],'carmit_id'=>$carmitId]);
        if($agent_carmit){
            #获得单张制卡提成
            $zktc = $row_agent_carmit['carmit_money'] - $agent_carmit['carmit_money'];
            #上级制卡金额
            $zkjg = $agent_carmit['carmit_money'];
            #上级获得返利金额
            $flje = $addMoney - $zkjg * $addsl;
            if($flje>0){
                $agent_newMoney = $agent_info['money'] + $flje;
                $agent_newRebate = $agent_info['rebate'] + $flje;
                $db->update('user',['money'=>$agent_newMoney,'rebate'=>$agent_newRebate],['user_id'=>$agent_info['user_id']]);
                #记录上级代理返利日志
                $log = "下级代理[{$user_info['nickname']}]，制作[{$soft_info['soft_name']}]的充值卡[{$row_carmit['carmit_name']}]×{$addsl}张，获得提成{$flje}元。";
                insertAgentLog($agent_info['create_user_id'],$agent_info['user_id'],$agent_newMoney,$agent_info['consume'],1,$log,$agent_newRebate);
            }
        }
    }
}

#代理日志记录
$log = "制作[{$soft_info['soft_name']}]的充值卡[{$row_carmit['carmit_name']}]×{$addsl}张，扣除账户余额{$addMoney}元。";
insertAgentLog($user_info['create_user_id'],$user_info['user_id'],$moneyNew,$consumeNew,0,$log);

#添加归属UserId(作者id)和归属代理id
$saveData['create_user_id'] = $user_info['create_user_id'];

#生成卡数据
$saveData['soft_id'] = $row_carmit['soft_id'];
$saveData['carmi_name'] = $row_carmit['carmit_name'];
$saveData['carmi_time'] = $row_carmit['carmit_time'];
$saveData['carmi_point'] = $row_carmit['carmit_point'];
$saveData['carmi_opening'] = $row_carmit['carmit_opening'];
$saveData['carmi_bind'] = $row_carmit['carmit_bind'];
$saveData['carmi_unbind'] = $row_carmit['carmit_unbind'];
$saveData['carmi_data_extra'] = $row_carmit['carmit_data_extra'];
$saveData['carmi_notes'] = $carmiNotes ? $carmiNotes : $row_carmitow['carmit_notes'];
#制卡批次号
$saveData['carmi_pch'] = date("Ymd-His").mt_rand(10,99);
#卡状态
$saveData['carmi_status'] = 0;
#制卡价格
$saveData['making_money'] = $row_agent_carmit['carmit_money'];
#制卡人id
$saveData['making_user_id'] = $user_info['user_id'];
#制卡返利给上级代理的提成金额
if($user_info['agent_id']){
    $saveData['making_rebate_agent'] = $user_info['agent_id'];
    if($zktc>0){
        $saveData['making_rebate'] = $zktc;
    }
}

for($i=0; $i<$addsl; $i++){
    #生成充值卡号
    $saveData['carmi_str'] = $row_carmit['carmit_prefix'].generate($row_carmit['carmit_length']);
    $db->insert('soft_carmi',$saveData);
}

exJson(0,'操作成功');
?>