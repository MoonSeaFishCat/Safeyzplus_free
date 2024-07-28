<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$dictDataName = filterArr($_GET['dictDataName']);
$dictDataCode = filterArr($_GET['dictDataCode']);
$dictId = filterArr($_GET['dictId']);
if($dictDataName)$where['a.dict_data_name']=$dictDataName;
if($dictDataCode)$where['a.dict_data_code']=$dictDataCode;
if($dictId)$where['a.dict_id']=$dictId;
$count = $db->getCount("select b.dict_code,b.dict_name,a.* from pre_dictionary_data as a left join pre_dictionary as b on a.dict_id=b.dict_id ".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}
$res = $db->getAll("select b.dict_code,b.dict_name,a.* from pre_dictionary_data as a left join pre_dictionary as b on a.dict_id=b.dict_id ".whereStr($where)." order by sort_number limit ".($page - 1) * $pageSize.",".$pageSize);
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
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>