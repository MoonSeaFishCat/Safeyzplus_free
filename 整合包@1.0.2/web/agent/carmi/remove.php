<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('agent:carmi:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    #查询充值卡信息
    $row_carmi = $db->find('soft_carmi','*',['carmi_id'=>$id,'create_user_id'=>$user_info['create_user_id'],'making_user_id'=>$user_info['user_id']]);
    #检测是否有上级
    if($row_carmi['making_rebate_agent']){
        #检测上级代理账户余额是否足够
        $making_agent_info = $db->find('user','*',['user_id'=>$row_carmi['making_rebate_agent']]);
        #如果上级代理账户余额不足扣除则无法退卡
        if($making_agent_info['money'] < $row_carmi['making_rebate'])exJson(1,'退卡失败，原因:上级代理账户余额不足,无法扣除获得的提成');
        $makingAgentMoney = $making_agent_info['money'] - $row_carmi['making_rebate'];
        $makingAgentRebate = $making_agent_info['rebate'] - $row_carmi['making_rebate'];
        #进行上级代理账户余额减扣
        $db->update('user',['money'=>$makingAgentMoney,'rebate'=>$makingAgentRebate],['user_id'=>$row_carmi['making_rebate_agent']]);
        #进行代理日志记录
        $log = "下级代理[{$user_info['nickname']}]，进行退卡[{$row_carmi['carmi_str']}]，扣除该卡获得提成{$row_carmi['making_rebate']}元。";
        insertAgentLog($making_agent_info['create_user_id'],$making_agent_info['user_id'],$makingAgentMoney,$making_agent_info['consume'],2,$log,$makingAgentRebate);
    }
    if($row_carmi['making_money']){
        $userNewMoney = $user_info['money'] + $row_carmi['making_money'];
        $userNewConsume = $user_info['consume'] - $row_carmi['making_money'];
        $db->update('user',['money'=>$userNewMoney,'consume'=>$userNewConsume],['user_id'=>$user_info['user_id']]);
        #进行代理日志记录
        $log = "进行退卡[{$row_carmi['carmi_str']}]，返还该卡制卡金额{$row_carmi['making_money']}元。";
        insertAgentLog($user_info['create_user_id'],$user_info['user_id'],$userNewMoney,$userNewConsume,2,$log);
    }
    $db->update('soft_carmi',['carmi_status'=>3],['carmi_id'=>$id,'create_user_id'=>$user_info['create_user_id'],'making_user_id'=>$user_info['user_id']]);
    exJson(0,'操作成功');
}