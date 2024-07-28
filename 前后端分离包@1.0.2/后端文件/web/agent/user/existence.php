<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:agent:list');

$id = filterArr($_GET['id']);
$field = filterArr($_GET['field']);
$value = filterArr($_GET['value']);
$type = filterArr($_GET['type']); //1修改 0保存
$where['create_user_id'] = $user_info['user_id'];
$where[$field] = $value;

$row = $db->find('user','*',$where);
if($row){
    if(!$type) {
        exJson(0, '已存在此用户');
    }
}
exJson(1,'不存在');
