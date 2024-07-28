<?php
/**
 * explain:删除变量
 * time:2024/02/01 12:03
 * author:樱島奈子
 */
require './includes/core.php';
$v_key = isset($data_arr['key']) ? purge($data_arr['key']) : '';
if(!$v_key)retOut(status: 'success', code: 360, msg: '变量名不可为空!', soft: $soft);

$res = $db->find('soft_variable','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id'],'v_key'=>$v_key]);
if(!$res)retOut(status: 'success', code: 361, msg: '变量不存在!', soft: $soft);
if(!$res['v_del'])retOut(status: 'success', code: 363, msg: '该变量不可删除!', soft: $soft);
if($res['v_type']==1){
    checkOnlie(userAccount: $account, cookie: $cookie);
}
$res = $db->delete('soft_variable',['id'=>$res['id']]);
if(!$res)retOut(status: 'success', code: 362, msg: '变量删除失败!', soft: $soft);
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft);
?>