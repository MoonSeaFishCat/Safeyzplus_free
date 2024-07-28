<?php
/**
 * explain:初始化
 * time:2024/01/23 16:01
 * author:樱島奈子
 */
require './includes/core.php';

$retData['softName'] = $soft['soft_name'];
switch ($soft['soft_status']){
    case 0:
        $retData['softStatus'] = '正常';
        break;
    case 1:
        $retData['softStatus'] = '维护';
        $retData['softWhgg'] = $soft['soft_whgg'];
        break;
    case 2:
        $retData['softStatus'] = '停运';
        $retData['softWhgg'] = $soft['soft_whgg'];
        break;
}
$retData['softJump'] = $soft['soft_jump'];
$retData['softNotice'] = $soft['soft_notice'];
$retData['unbindTime'] = $soft['unbind_time'];
$retData['unbindPoints'] = $soft['unbind_points'];
retOut(status: 'success', code: 200, msg: '初始化成功!', soft: $soft, result: $retData);
?>