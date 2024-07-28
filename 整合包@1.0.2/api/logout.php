<?php
/**
 * explain:注销
 * time:2024/01/24 13:21
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);
deleteCookie(user_id: $row_cookie['user_id'], feature: '', cookie: $cookie);
retOut(status: 'success', code: 200, msg: '注销成功!', soft: $soft);
?>