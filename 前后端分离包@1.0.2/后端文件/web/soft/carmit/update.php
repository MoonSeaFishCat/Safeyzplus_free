<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:carmit:alter');

#卡种数据
$saveData['soft_id'] = intval($arr['softId']);
$saveData['carmit_name'] = $arr['carmitName'];
$saveData['carmit_time'] = $arr['carmitTime'] ? $arr['carmitTime'] : 0;
$saveData['carmit_point'] = $arr['carmitPoint'] ? $arr['carmitPoint'] : 0;
$saveData['carmit_opening'] = $arr['carmitOpening'] ? $arr['carmitOpening'] : 1;
$saveData['carmit_bind'] = $arr['carmitBind'] ? $arr['carmitBind'] : 1;
$saveData['carmit_unbind'] = $arr['carmitUnbind'] ? $arr['carmitUnbind'] : '-1|-1|-1|-1';
$saveData['carmit_length'] = intval($arr['carmitLength']);
$saveData['carmit_prefix'] = $arr['carmitPrefix'];
$saveData['carmit_data_extra'] = $arr['carmitDataExtra'];
$saveData['carmit_notes'] = $arr['carmitNotes'];
$saveData['carmit_money'] = $arr['carmitMoney'] ? $arr['carmitMoney'] : '0.00';

$db->update('soft_carmit',$saveData,['carmit_id'=>$arr['carmitId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');