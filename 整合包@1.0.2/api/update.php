<?php
/**
 * explain:检测更新
 * time:2024/01/25 19:48
 * author:樱島奈子
 */

require './includes/core.php';

$row_ver = $db->find('soft_version','*',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'version'=>$version]);
if(!$row_ver)retOut(status: 'success', code: 330, msg: '暂无更新!', soft: $soft);
$row_ver = $db->find('soft_version','*',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'nversion'=>$version]);
if(!$row_ver)retOut(status: 'success', code: 331, msg: '暂无更新!', soft: $soft);
$row_vers['url'] = $row_ver['url'];
$row_vers['log'] = $row_ver['log'];
$row_vers['updateType'] = $row_ver['gxfs'];
$row_vers['releaseTime'] = $row_ver['create_time'];
retOut(status: 'success', code: 200, msg: '检测到新版本!', soft: $soft, result: $row_vers);
?>