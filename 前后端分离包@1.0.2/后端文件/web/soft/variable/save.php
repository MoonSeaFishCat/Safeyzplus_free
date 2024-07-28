<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:variable:save');

#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

#检测变量是否存在
$row = $db->find('soft_variable','*',['create_user_id'=>$user_info['user_id'],'v_key'=>$arr['vKey'],'soft_id'=>intval($arr['softId'])]);
if($row)exJson(1,'该变量已存在');

#基础数据
$saveData['soft_id'] = intval($arr['softId']);
$saveData['v_key'] = $arr['vKey'];
$saveData['v_value'] = $arr['vValue'];
$saveData['v_type'] = intval($arr['vType']);
$saveData['v_del'] = intval($arr['vDel']);
$saveData['v_alter'] = intval($arr['vAlter']);

$db->insert('soft_variable',$saveData);

exJson(0,'操作成功');
?>