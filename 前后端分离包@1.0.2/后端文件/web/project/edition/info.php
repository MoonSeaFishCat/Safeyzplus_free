<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:edition:list');

$id = filterArr($_GET['id']);
if($id)$where['version_id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$res = $db->find('soft_version','*',$where,'version_id');
if(!$res)exJson(1,'版本不存在');
$value = $res;
$datainfo['versionId'] = $value['version_id'];
$datainfo['softId'] = $value['soft_id'];
$datainfo['version'] = $value['version'];
$datainfo['md5'] = $value['md5'];
$datainfo['url'] = $value['url'];
$datainfo['log'] = $value['log'];
$datainfo['nversion'] = $value['nversion'];
$datainfo['gxfs'] = strval($value['gxfs']);

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>