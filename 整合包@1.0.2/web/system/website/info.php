<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:web:info');

$res = $db->findAll('website','*');
$datainfo = array();
foreach ($res as $value){
    switch ($value['web_key']){
        case 'role_id_agent':
            $datainfo[$value['web_key']] = intval($value['web_value']);
            break;
        case 'role_id_author':
            $datainfo[$value['web_key']] = intval($value['web_value']);
            break;
        default:
            $datainfo[$value['web_key']] = $value['web_value'];
            break;
    }
}

$datainfo['skey'] = enCode($_SERVER['HTTP_HOST']);

exJson(0,'操作成功',$datainfo);
?>