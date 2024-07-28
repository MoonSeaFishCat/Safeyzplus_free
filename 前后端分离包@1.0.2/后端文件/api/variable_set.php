<?php
/**
 * explain:新增/修改变量
 * time:2024/02/02 18:25
 * author:樱島奈子
 */
require './includes/core.php';
$v_key = isset($data_arr['key']) ? purge($data_arr['key']) : '';
$v_value = isset($data_arr['value']) ? purge($data_arr['value']) : '';
if(!$v_key)retOut(status: 'success', code: 360, msg: '变量名不可为空!', soft: $soft);
if(!$v_value)retOut(status: 'success', code: 365, msg: '变量值不可为空!', soft: $soft);
$res = $db->find('soft_variable','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id'],'v_key'=>$v_key]);
if(!$res){
    $v_alter = isset($data_arr['v_alter']) ? purge($data_arr['v_alter']) : '';
    $v_del = isset($data_arr['v_del']) ? purge($data_arr['v_del']) : '';
    $v_type = isset($data_arr['v_type']) ? purge($data_arr['v_type']) : '';
    if($v_alter=='' || $v_del=='' || $v_type==''){
        retOut(status: 'success', code: 368, msg: '新增变量的参数不完整!', soft: $soft);
    }
    $res = $db->insert('soft_variable',['create_user_id'=>$admin_id,'soft_id'=>$soft_id,'v_key'=>$v_key,'v_value'=>$v_value,'v_alter'=>$v_alter,'v_del'=>$v_del,'v_type'=>$v_type]);
    if(!$res)retOut(status: 'success', code: 367, msg: '变量新增失败!', soft: $soft);
    retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft);
}
if($res['v_type']==1){
    checkOnlie(userAccount: $account, cookie: $cookie);
}
if(!$res['v_alter'])retOut(status: 'success', code: 364, msg: '该变量不可修改!', soft: $soft);
$newWrite = $res['v_write'] + 1;
$res = $db->update('soft_variable',['v_value'=>$v_value,'v_write'=>$newWrite],['id'=>$res['id']]);
if(!$res)retOut(status: 'success', code: 366, msg: '变量修改失败!', soft: $soft);
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft);
?>