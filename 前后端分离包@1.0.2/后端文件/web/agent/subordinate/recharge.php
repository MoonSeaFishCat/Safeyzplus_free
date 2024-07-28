<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('agent:subordinate:recharge');

#检查该代理是否属于自身子代
$row_agent = $db->find('user','*',['user_id'=>$arr['userId'],'agent_id'=>$user_info['user_id'],'create_user_id'=>$user_info['create_user_id']]);
if(!$row_agent)exJson(1,'该代理不是你的下属代理');

if($user_info['money'] < $arr['money'])exJson(1,'账户余额不足,无法给下属代理转账余额');

#我的账户变动
$saveDataUser['money'] = $user_info['money'] - $arr['money'];
$saveDataUser['consume'] = $user_info['consume'] + $arr['money'];
$rows = $db->update('user',$saveDataUser,['user_id'=>$user_info['user_id']]);
if(!$rows)exJson(1,'转账失败,请稍后再试');

#子代账户余额
$saveData['money'] = $row_agent['money'] + $arr['money'];
$db->update('user',$saveData,['user_id'=>$row_agent['user_id']]);

#记录代理日志
$log = "给下级子代[{$row_agent['username']}]手动转账{$arr['money']}元";
insertAgentLog($user_info['create_user_id'],$user_info['user_id'],$saveDataUser['money'],$saveDataUser['consume'],0,$log);
$log = "上级代理[{$user_info['username']}]手动转账{$arr['money']}元";
insertAgentLog($user_info['create_user_id'],$row_agent['user_id'],$saveData['money'],$row_agent['consume'],3,$log);

exJson(0,'操作成功');