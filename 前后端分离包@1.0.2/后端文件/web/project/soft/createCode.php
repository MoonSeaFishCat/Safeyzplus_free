<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

function generate($length=8) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for($i=0;$i<$length;$i++)
    {
        $password .= $chars[mt_rand(0,strlen($chars)-1)];
    }
    return $password;
}

$length = filterArr($_GET['length']);
$ret = generate($length);

exJson(0,'操作成功',$ret);
?>