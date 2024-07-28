<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:file:upfile');

$uper = new UpFiles('file','../../../upload/files/'.$user_info['username']);
$allowType = 'image/png,image/jpeg,image/pjpeg,image/x-png,image/gif';
$allowExeName = 'jpg,gif,png,jpeg';
$allowSize = 4096;
$uper->setAllow($allowType,$allowExeName,$allowSize);
$uploadedFile = $uper->upload($db,$user_info['user_id']);
if(!$uploadedFile){
    exJson(1,'上传失败:'.$uper->error);
}else{
    $url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $url .= "://" . $_SERVER['HTTP_HOST'];
    $newStr = $url.'/d/'.md5($uper->fileName);
    exJson(0,'上传成功',['file_url'=>$newStr,'file_name'=>$uper->fileName]);
}
?>