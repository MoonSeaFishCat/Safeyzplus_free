<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:role:alter');

$id = filterArr($_GET['id']);

$res = $db->getAll("select a.*,b.id from b2_menu as a left join (select * from pre_role_menu where role_id=".$id.") as b on a.menu_id=b.menu_id order by a.sort_number");
foreach ($res as $value){
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
    $datainfo['checked'] = $value['id'] ? true : false;
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>