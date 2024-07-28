<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:soft:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $db->delete('soft',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_api_log',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_carmi',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_carmit',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_cookie',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_notice',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_user',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_user_feature',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_user_log',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_variable',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_version',['soft_id'=>$id,'create_user_id'=>$user_info['user_id']]);
    exJson(0,'操作成功');
}

#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $db->delete('soft',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_api_log',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_carmi',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_carmit',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_cookie',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_notice',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_user',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_user_feature',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_user_log',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_variable',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
    $db->delete('soft_version',['soft_id'=>$arr[$i],'create_user_id'=>$user_info['user_id']]);
}
exJson(0,'操作成功');