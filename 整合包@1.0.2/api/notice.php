<?php
/**
 * explain:获取公告
 * time:2024/01/28 21:20
 * author:樱島奈子
 */
require './includes/core.php';
$res = $db->findAll('soft_notice','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id']],'notice_top desc');
foreach ($res as $value){
    $datainfo = array();
    $datainfo['id'] = $value['notice_id'];
    $datainfo['top'] = $value['notice_top'];
    $datainfo['title'] = $value['notice_title'];
    $datainfo['info'] = $value['notice_info'];
    $datainfo['createTime'] = $value['create_time'];
    $datalist[] = $datainfo;
}
retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft, result: $datalist);
?>