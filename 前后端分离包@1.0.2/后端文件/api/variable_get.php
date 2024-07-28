<?php
/**
 * explain:获取变量
 * time:2024/01/31 22:12
 * author:樱島奈子
 */
require './includes/core.php';
$v_key = isset($data_arr['key']) ? purge($data_arr['key']) : '';
if(!$v_key)retOut(status: 'success', code: 360, msg: '变量名不可为空!', soft: $soft);

$res = $db->find('soft_variable','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id'],'v_key'=>$v_key]);
if(!$res)retOut(status: 'success', code: 361, msg: '变量不存在!', soft: $soft);
$newRead = $res['v_read'] + 1;
$db->update('soft_variable',['v_read'=>$newRead],['id'=>$res['id']]);
if($res['v_type']==1){
    checkOnlie(userAccount: $account, cookie: $cookie);
}
$result['key'] = $res['v_key'];
$result['value'] = $res['v_value'];
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft, result: $result);
?>