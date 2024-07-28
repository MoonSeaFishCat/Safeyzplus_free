<?php
include('../common.php');
include('../checkLogin.php');

$retData['nickname'] = $user_info['nickname'];
$retData['sex'] = strval($user_info['sex']);
$retData['email'] = $user_info['email'];
$retData['introduction'] = $user_info['introduction'];
$retData['address'] = $user_info['address'];
$retData['tell'] = $user_info['tell'];
$retData['tellPre'] = $user_info['tellPre'];
$retData['money'] = $user_info['money'] ? $user_info['money'] : '0.00';
$retData['consume'] = $user_info['consume'] ? $user_info['consume'] : '0.00';
$retData['money2'] = $user_info['money_2'] ? $user_info['money_2'] : '0.00';
$retData['avatar'] = $user_info['avatar'] ? $user_info['avatar'] : 'https://q1.qlogo.cn/g?b=qq&nk=2408312005&s=100';

#获取用户网盘容量
$row = $db->getRow("select sum(length) as length from pre_file_record where create_user_id={$user_info['user_id']}");
$retData['pan_size'] = round($row['length']  / 1024 / 1024,2);

$res = $db->findAll('website','*');
$datainfo = array();
foreach ($res as $value){
    switch ($value['web_key']){
        case 'pan_file_max_size':
            $retData['pan_size_max'] = $value['web_value'];
            break;
        case 'pan_file_size':
            $retData['pan_file_size_max'] = $value['web_value'];
            break;
        case 'pan_file_type':
            $retData['pan_file_type'] = $value['web_value'];
            break;
        case 'pan_file_exename':
            $retData['pan_file_exename'] = $value['web_value'];
            break;
        case 'soft_user_usemoney':
            $retData['soft_user_usemoney'] = $value['web_value'];
            break;
        case 'soft_charge':
            $retData['soft_charge'] = $value['web_value'];
            break;
        default:
            break;
    }
}

#查询用户角色(多角色)
$user_role = $db->findAll('user_role','*',['user_id'=>$user_info['user_id']]);
foreach ($user_role as $value){
    $datainfo = array();
    $row = $db->find('role','*',['role_id'=>$value['role_id']]);
    $datainfo['roleId'] = $row['role_id'];
    $datainfo['roleCode'] = $row['role_code'];
    $datainfo['roleName'] = $row['role_name'];
    $datainfo['comments'] = $row['comments'];
    $datainfo['deleted'] = $row['deleted'];
    $datainfo['createTime'] = $row['create_time'];
    $datainfo['deleted'] = $row['deleted'];
    $datainfo['updateTime'] = $row['update_time'];
    $datalist[] = $datainfo;
}
$retData['roles'] = $datalist;

$datalist_menu = array();

#查询用户角色路由(多角色组合路由)
$user_role = $db->findAll('user_role','*',['user_id'=>$user_info['user_id']]);
foreach ($user_role as $value_user_role){
    $res = $db->getAll("select b.* from pre_role_menu as a left join pre_menu as b on a.menu_id=b.menu_id where a.role_id=".$value_user_role['role_id']." order by b.sort_number");
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
$retData['authorities'] = $datalist_menu;

exJson(0,'操作成功',$retData);
?>