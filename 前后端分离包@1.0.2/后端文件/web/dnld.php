<?php
require_once './common.php';
require_once '../includes/download.php';

$file_path = filterArr($_GET['file']);
$where['path'] = $file_path;
$dnld = new download();

$row = $db->find('file_record','*',$where);
if($row){
    $path_new = '../upload/files/'.$file_path;
    if(file_exists($path_new)){
        echo file_exists($path_new);
        exit();
        $dnld->dload($path_new,$row['name']);
    }
    exJson(1,'no files');
}
exJson(1,'no files');