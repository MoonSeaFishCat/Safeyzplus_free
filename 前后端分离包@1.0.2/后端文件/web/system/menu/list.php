<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:menu:list');

$title = filterArr($_GET['title']);
$path = filterArr($_GET['path']);
$authority = filterArr($_GET['authority']);
if($title)$where['title']=$title;
if($path)$where['path']=$path;
if($authority)$where['authority']=$authority;

$datalist = array();

#查询菜单
$menu = $db->findAll('menu','*',$where,'sort_number');
foreach ($menu as $value){
    $datainfo = array();
    $datainfo['menuId'] = $value['menu_id'];
    $datainfo['parentId'] = $value['parent_id'];
    $datainfo['title'] = $value['title'];
    $datainfo['path'] = $value['path'];
    $datainfo['component'] = $value['component'];
    $datainfo['menuType'] = $value['menu_type'];
    $datainfo['sortNumber'] = $value['sort_number'];
    $datainfo['authority'] = $value['authority'];
    $datainfo['icon'] = $value['icon'];
    $datainfo['hide'] = $value['hide'];
    $datainfo['meta'] = $value['meta'];
    $datainfo['deleted'] = $value['deleted'];
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>