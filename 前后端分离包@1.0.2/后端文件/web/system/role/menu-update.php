<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:role:alter');

$id = filterArr($_GET['id']);
if(count($arr)<=0){
    exJson(1,'操作失败');
}

#先删空该角色的所有路由
$db->delete('role_menu',['role_id'=>$id]);
#重新添加新的路由
for($i=0;$i<count($arr);$i++) {
    $saveData['role_id'] = $id;
    $saveData['menu_id'] = $arr[$i];
    $db->insert('role_menu',$saveData);
}

exJson(0,'操作成功');