<?php
include('../common.php');

$path = filterArr($_GET['path']);
$url_upload  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$url_upload .= "://" . $_SERVER['SERVER_NAME'];
$path_new = $url_upload.$path;
$where['path'] = $path;
$row = $db->find('file_record','*',$where);
if(!$row){
    exJson(1,'文件不存在');
}
#office文件处理
$office = array(
    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
    'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
    'application/pdf'
);
if(in_array($row['content_type'],$office)){
    header("location:https://view.officeapps.live.com/op/view.aspx?src={$path_new}");
}
header("location:{$path_new}");
?>