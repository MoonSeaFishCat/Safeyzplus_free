<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

$row = $db->find('website','*',['web_key'=>'weburl']);
$https = $row['web_value'].'/';
$datainfo['authorUrl'] = $https.'login?sid='.$user_info['author_code'];

exJson(0,'操作成功',$datainfo);
?>