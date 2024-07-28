<?php
$datalist_menu = array();

#查询用户角色路由(多角色组合路由)
$user_role = $db->findAll('user_role','*',['user_id'=>$user_info['user_id']]);
foreach ($user_role as $value_user_role){
    $res = $db->getAll("select b.* from pre_role_menu as a left join pre_menu as b on a.menu_id=b.menu_id where a.role_id=".$value_user_role['role_id']);
    foreach ($res as $value){
        unset($index);
        #查询菜单id是否存已存在,存在返回索引
        $index = array_search($value['menu_id'], array_column($datalist_menu, 'menuId'));
        
        if(!$index && $index!==0){
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
            $datalist_menu[] = $datainfo;
        }
    }
}

function checkPower(string $authority) {
    global $datalist_menu;
    $index = array_search($authority, array_column($datalist_menu, 'authority'));
    if(!$index && $index!==0){
        exJson(403,'没有访问权限');
    }
}

unset($datainfo);

?>