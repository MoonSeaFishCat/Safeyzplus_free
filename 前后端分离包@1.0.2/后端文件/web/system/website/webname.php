<?php
include('../../common.php');

$res = $db->find('website','web_value',['web_key'=>'webname']);
$webinfos['webname'] = $res['web_value'];
exJson(0,'操作成功',$webinfos);
?>