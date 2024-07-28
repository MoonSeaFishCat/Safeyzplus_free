<?php
/**
 * 自动作业
 * 更新于：2024-02-05 13:39
 */

include('./common.php');

$token = filterArr($_GET['skey']);

if($token!=enCode($_SERVER['HTTP_HOST'])){
    exJson(-1,'error');
}

#检测心跳过期
$res = $db->findAll('soft_cookie','*');
foreach ($res as $value){
    if(!$value['soft_jump']){
        $db->delete('soft_cookie',['cookie_id'=>$value['cookie_id']]);
    }
    $newt = strtotime($value['heart_time']) + $value['soft_jump'];
    if($newt < time()){
        $db->delete('soft_cookie',['cookie_id'=>$value['cookie_id']]);
    }
}

exJson(0,'success');
?>