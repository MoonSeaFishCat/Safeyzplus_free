<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:menu:save');

$saveData['parent_id'] = $arr['parentId'];
$saveData['title'] = $arr['title'];
$saveData['menu_type'] = $arr['menuType'];
$saveData['icon'] = $arr['icon'];
$saveData['path'] = $arr['path'];
$saveData['component'] = $arr['component'];
$saveData['authority'] = $arr['authority'];
$saveData['sort_number'] = $arr['sortNumber'];
$saveData['hide'] = $arr['hide'];
$saveData['meta'] = $arr['meta'];

$db->insert('menu',$saveData);

exJson(0,'操作成功');