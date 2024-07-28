<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:menu:remove');

$id = filterArr($_GET['id']);
if(!$id){
    exJson(1,'操作失败');
}

$db->delete('menu',['menu_id'=>$id]);
$db->delete('role_menu',['menu_id'=>$id]);

exJson(0,'操作成功');