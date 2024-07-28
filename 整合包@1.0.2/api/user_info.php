<?php
/**
 * explain:获取登录用户信息
 * time:2024/02/12 22:04
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);
$userData = getUserId(userId: $row_cookie['user_id']);

unset($userData['user_pass']);
unset($userData['user_id']);

retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft, result: $userData);
?>