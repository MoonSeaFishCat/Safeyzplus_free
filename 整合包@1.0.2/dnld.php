<?php
include('./includes/pdo.class.php');
include('./includes/db.config.php');
include('./includes/functions.php');
include('./includes/download.php');

@header("Content-Type: text/html; charset=UTF-8");
error_reporting(0);
date_default_timezone_set('PRC');

$file_name = filterArr($_GET['file']);

$db = new PdoHelper($dbconfig);
$dnld = new download();
$file_info = $db->find('file_record','*',['fmd5'=>$file_name]);
if($file_info){
    $dnld->dload('./'.$file_info['path'],$file_info['name']);
}
echo json_encode(['code'=>-1,'msg'=>'no files']);
?>