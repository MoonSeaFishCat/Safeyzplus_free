<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:save');

$saveData['dict_data_name'] = $arr['dictDataName'];
$saveData['dict_data_code'] = $arr['dictDataCode'];
$saveData['sort_number'] = $arr['sortNumber'];
$saveData['tag_color'] = $arr['tagColor'];
if($arr['tagDictDataName']){
    $saveData['tag_dict_data_name'] = $arr['tagDictDataName'];
}else{
    $saveData['tag_dict_data_name'] = $arr['dictDataName'];
}
$saveData['comments'] = $arr['comments'];
$saveData['dict_id'] = $arr['dictId'];

$db->insert('dictionary_data',$saveData);

exJson(0,'操作成功');