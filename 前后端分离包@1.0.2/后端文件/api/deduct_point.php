<?php
/**
 * explain:扣除点数
 * time:2024/01/28 21:45
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);
$row_user = getUserId(userId: $row_cookie['user_id']);
if(!$row_user){
    retOut(status: 'success', code: 252, msg: '用户信息不存在!', soft: $soft);
}
$number = isset($data_arr['number']) ? purge($data_arr['number']) : 1;
$reason = isset($data_arr['reason']) ? purge($data_arr['reason']) : null;
$row = deductUserData(type: 0, userInfo: $row_user, number: $number, reason: $reason);
if(!$row){
    retOut(status: 'success', code: 340, msg: '点数不足,无法扣除!', soft: $soft);
}
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft);