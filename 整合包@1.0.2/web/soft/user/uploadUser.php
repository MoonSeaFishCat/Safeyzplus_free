<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('soft:user:save');

$file = $_FILES['file'];
if(isset($file) && isset($file['tmp_name'])){
    if($file['type']!='text/plain')exJson(-1,'只能选择 txt 文件');
    $filename = $file['tmp_name'];
    $handle = fopen($filename, "r");
    while (!feof($handle)) {
        $line = fgets($handle);
        $str = filterArr($line);
        $users[] = explode('----',$str);
    }
    fclose($handle);
    //exJson(-1,'请选择要上传的文件',$users);
}else{
    exJson(-1,'请选择要上传的文件');
}

#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

foreach ($users as $value) {
    #用户数据
    $saveData['soft_id'] = intval($value[0]);
    $saveData['user_type'] = intval($value[1]);
    $saveData['user_account'] = $value[2];
    $saveData['user_pass'] = $value[1] == 0 ? pass_mi($value[3]) : NULL;
    $saveData['user_status'] = intval($value[4]);
    $saveData['endtime'] = $value[5];
    $saveData['point'] = $value[6];
    $saveData['opening'] = $value[7];
    $saveData['bind'] = $value[8];
    $strs = str_replace("\r\n","",$value[9]);
    $saveData['unbind'] = $strs ? $strs : '-1|-1|-1|-1';

    $db->insert('soft_user', $saveData);
}


exJson(0,'操作成功',$users);
?>