<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:alter');

$saveData['dict_name'] = $arr['dictName'];
$saveData['dict_code'] = $arr['dictCode'];
$saveData['sort_number'] = $arr['sortNumber'];
$saveData['comments'] = $arr['comments'];

$db->update('dictionary',$saveData,['dict_id'=>$arr['dictId']]);

exJson(0,'操作成功');