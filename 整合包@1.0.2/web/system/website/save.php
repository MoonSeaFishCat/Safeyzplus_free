<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:web:save');

#循环修改
foreach($arr as $key => $value){
    $row = $db->find('website','create_time',['web_key'=>$key]);
    if($row){
        $db->update('website',['web_value'=>$value],['web_key'=>$key]);
    }else{
        $db->insert('website',['web_value'=>$value,'web_key'=>$key]);
    }
}
exJson(0,'操作成功');
?>