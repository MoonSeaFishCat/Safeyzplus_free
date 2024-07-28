<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:edition:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $db->delete('soft_version',['version_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    exJson(0,'操作成功');
}

#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $db->delete('soft_version',['version_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
}
exJson(0,'操作成功');