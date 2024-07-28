<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:role:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $db->delete('role',['role_id'=>$id]);
    #删除关联的角色菜单和用户角色
    $db->delete('role_menu',['role_id'=>$id]);
    $db->delete('user_role',['role_id'=>$id]);
    exJson(0,'操作成功');
}

#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $db->delete('role',['role_id'=>$arr[$i]]);
    #删除关联的角色菜单和用户角色
    $db->delete('role_menu',['role_id'=>$arr[$i]]);
    $db->delete('user_role',['role_id'=>$arr[$i]]);
}
exJson(0,'操作成功');