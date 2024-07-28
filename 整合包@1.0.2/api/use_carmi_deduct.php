<?php
/**
 * explain:历史充值卡_扣除
 * time:2024/02/03 21:13
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);

//0扣点 1扣时
$type = isset($data_arr['type']) ? purge($data_arr['type']) : 0;
$carmi = isset($data_arr['carmi']) ? purge($data_arr['carmi']) : '';
$number = isset($data_arr['number']) ? purge($data_arr['number']) : 1;
$reason = isset($data_arr['reason']) ? purge($data_arr['reason']) : null;

if(!$carmi)retOut(status: 'success', code: 310, msg: '请输入充值卡号.', soft: $soft);

$row = $db->find('soft_carmi','*',['create_user_id'=>$admin_id,'soft_id'=>$soft_id,'carmi_status'=>2,'use_soft_user_id'=>$row_cookie['user_id'],'carmi_str'=>$carmi]);
if(!$row)retOut(status: 'success', code: 345, msg: '该历史充值卡不存在!', soft: $soft);
if($type==0){
    //扣除点数
    $newPoint = $row['use_point'] - $number;
    if($newPoint<0)retOut(status: 'success', code: 340, msg: '点数不足,无法扣除!', soft: $soft);
    $row = $db->update('soft_carmi',['use_point'=>$newPoint],['carmi_id'=>$row['carmi_id']]);
    if(!$row)retOut(status: 'success', code: 340, msg: '点数不足,无法扣除!', soft: $soft);
    if($reason)$reason = "(理由:{$reason})";
    insertUserLog(user_id: $row_cookie['user_id'], type: 4,logData: "历史充值卡[{$carmi}],扣除了{$number}点数,剩余点数:{$newPoint}{$reason}");
}elseif($type==1){
    //扣除时间
    $newEndtime = strtotime($row['use_endtime']) - ($number*60);
    if($newEndtime<time())retOut(status: 'success', code: 341, msg: '时间不足,无法扣除!', soft: $soft);
    $newEndtime = timetostr($newEndtime);
    $row = $db->update('soft_carmi',['use_endtime'=>$newEndtime],['carmi_id'=>$row['carmi_id']]);
    if(!$row)retOut(status: 'success', code: 341, msg: '时间不足,无法扣除!', soft: $soft);
    if($reason)$reason = "(理由:{$reason})";
    insertUserLog(user_id: $row_cookie['user_id'], type: 4,logData: "历史充值卡[{$carmi}],扣除了{$number}分钟时间,剩余到期时间:{$newEndtime}{$reason}");
}

retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft);
?>