<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:edition:alter');

#版本数据
$saveData['soft_id'] = intval($arr['softId']);
$saveData['version'] = $arr['version'];
$saveData['md5'] = $arr['md5'];
$saveData['url'] = $arr['url'];
$saveData['log'] = $arr['log'];
$saveData['nversion'] = $arr['nversion'];
$saveData['gxfs'] = intval($arr['gxfs']);

$db->update('soft_version',$saveData,['version_id'=>$arr['versionId'],'create_user_id'=>$user_info['user_id']]);

exJson(0,'操作成功');