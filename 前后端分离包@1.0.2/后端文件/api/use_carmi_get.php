<?php
/**
 * explain:历史充值卡_查询
 * time:2024/02/03 21:13
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);

$res = $db->findAll('soft_carmi','*',['create_user_id'=>$admin_id,'soft_id'=>$soft_id,'carmi_status'=>2,'use_soft_user_id'=>$row_cookie['user_id']]);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['carmi'] = $value['carmi_str'];
    $datainfo['carmiName'] = $value['carmi_name'];
    $datainfo['carmiTime'] = $value['carmi_time'];
    $datainfo['carmiPoint'] = $value['carmi_point'];
    $datainfo['carmiNotes'] = $value['carmi_notes'];
    $datainfo['useTime'] = $value['use_time'];
    $datainfo['endtime'] = $value['use_endtime'];
    $datainfo['point'] = $value['use_point'];
    $rowCarmi[] = $datainfo;
}
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft, result: $rowCarmi);
?>
