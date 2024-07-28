<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:file:upfile');

#获取用户网盘容量
$row = $db->getRow("select sum(length) as length from pre_file_record where create_user_id={$user_info['user_id']}");
$pan_size = round($row['length']  / 1024 / 1024,2);

$res = $db->findAll('website','*');
$datainfo = array();
foreach ($res as $value){
    switch ($value['web_key']){
        case 'pan_file_max_size':
            $pan_size_max = $value['web_value'];
            break;
        case 'pan_file_type':
            $pan_file_type = $value['web_value'];
            break;
        case 'pan_file_exename':
            $pan_file_exename = $value['web_value'];
            break;
        case 'pan_file_size':
            $pan_file_size = $value['web_value'];
            break;
        default:
            break;
    }
}

$row = $db->find('website','*',['web_key'=>'pan_file_max_size']);
$pan_size_max = $row['web_value'];

$file_size = $_FILES['file']['size'];
$file_size = $file_size / 1024 / 1024;
if($file_size<=0.01)$file_size=0.01;
if($pan_size>=$pan_size_max)exJson(1,'上传失败:网盘容量已达上限');
if($file_size+$pan_size>$pan_size_max)exJson(1,'上传失败:网盘剩余容量不足以上传该文件');

$uper = new UpFiles('file','../../../upload/files/'.$user_info['username']);
$allowType = $pan_file_type;
$allowExeName = $pan_file_exename;
$allowSize = $pan_file_size * 1024;
$uper->setAllow($allowType,$allowExeName,$allowSize);
$uploadedFile = $uper->upload($db,$user_info['user_id']);
if(!$uploadedFile){
    exJson(1,'上传失败:'.$uper->error);
}else{
    $url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $url .= "://" . $_SERVER['HTTP_HOST'];
    $newStr = $url.$uploadedFile;
    exJson(0,'上传成功',['url'=>$newStr,'file_name'=>$uper->fileName]);
}
?>