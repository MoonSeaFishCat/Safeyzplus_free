<?php
/**
 * explain:心跳
 * time:2024/01/24 00:23
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);
$heartTime = timetostr(time());
$db->update('soft_cookie',['heart_time'=>$heartTime],['cookie_id'=>$row_cookie['cookie_id']]);
$rowCookie['loginCookie'] = $row_cookie['login_cookie'];
$rowCookie['heartTime'] = $heartTime;
$db->update('soft_user',['heart_time'=>$heartTime],['user_id'=>$row_cookie['user_id']]);
retOut(status: 'success', code: 200, msg: '心跳成功!', soft: $soft, result: $rowCookie);
?>