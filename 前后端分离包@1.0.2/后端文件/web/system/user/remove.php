<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:user:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $db->delete('user',['user_id'=>$id]);
    #删除关联的绑定角色
    $db->delete('user_role',['user_id'=>$id]);
    exJson(0,'操作成功');
}

#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $db->delete('user',['user_id'=>$arr[$i]]);
    #删除关联的绑定角色
    $db->delete('user_role',['user_id'=>$arr[$i]]);
}
exJson(0,'操作成功');