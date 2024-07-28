<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:save');

$saveData['dict_name'] = $arr['dictName'];
$saveData['dict_code'] = $arr['dictCode'];
$saveData['sort_number'] = $arr['sortNumber'];
$saveData['comments'] = $arr['comments'];

$db->insert('dictionary',$saveData);

exJson(0,'操作成功');