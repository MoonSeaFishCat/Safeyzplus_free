<?php
/**
 * explain:临时数据写
 * time:2024/02/14 20:36
 * author:樱島奈子
 */
require './includes/core.php';
$row_cookie = checkOnlie(userAccount: $account, cookie: $cookie);

$temp_data = isset($data_arr['temp_data']) ? purge($data_arr['temp_data']) : '';
$db->update('soft_cookie',['temp_data'=>$temp_data],['cookie_id'=>$row_cookie['cookie_id']]);
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft);
?>