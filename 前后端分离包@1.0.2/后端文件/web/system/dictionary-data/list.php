<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:list');

$id = filterArr($_GET['dictCode']);
$res = $db->getAll("select b.dict_code,b.dict_name,a.* from pre_dictionary_data as a left join pre_dictionary as b on a.dict_id=b.dict_id where b.dict_code='".$id."' order by sort_number");
foreach ($res as $value){
    $datainfo = array();
    $datainfo['dictDataId'] = $value['dict_data_id'];
    $datainfo['dictId'] = $value['dict_id'];
    $datainfo['dictDataCode'] = $value['dict_data_code'];
    $datainfo['dictDataName'] = $value['dict_data_name'];
    $datainfo['dictCode'] = $value['dict_code'];
    $datainfo['dictName'] = $value['dict_name'];
    $datainfo['sortNumber'] = $value['sort_number'];
    $datainfo['tagColor'] = $value['tag_color'];
    $datainfo['tagDictDataName'] = $value['tag_dict_data_name'];
    $datainfo['comments'] = $value['comments'];
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>