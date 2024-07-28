<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:alter');

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

$db->update('dictionary_data',$saveData,['dict_data_id'=>$arr['dictDataId']]);

exJson(0,'操作成功');