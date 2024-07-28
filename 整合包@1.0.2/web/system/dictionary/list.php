<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:list');

$res = $db->findAll('dictionary','*','','sort_number');
foreach ($res as $value){
    $datainfo = array();
    $datainfo['dictId'] = $value['dict_id'];
    $datainfo['dictCode'] = $value['dict_code'];
    $datainfo['dictName'] = $value['dict_name'];
    $datainfo['sortNumber'] = $value['sort_number'];
    $datainfo['comments'] = $value['comments'];
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>