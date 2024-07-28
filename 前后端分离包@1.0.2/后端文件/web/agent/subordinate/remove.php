<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:subordinate:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $row = $db->delete('user',['user_id'=>$id,'create_user_id'=>$user_info['create_user_id'],'agent_id'=>$user_info['user_id']]);
    if($row){
        #删除关联的绑定角色
        $db->delete('user_role',['user_id'=>$id]);
    }
    exJson(0,'操作成功');
}

#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $row = $db->delete('user',['user_id'=>$arr[$i],'create_user_id'=>$user_info['create_user_id'],'agent_id'=>$user_info['user_id']]);
    if($row){
        #删除关联的绑定角色
        $db->delete('user_role',['user_id'=>$arr[$i]]);
    }
}
exJson(0,'操作成功');