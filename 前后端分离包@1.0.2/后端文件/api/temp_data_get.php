<?php
/**
 * explain:临时数据读
 * time:2024/02/14 20:36
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);

$result['temp_data'] = $row_cookie['temp_data'];
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft, result: $result);
?>