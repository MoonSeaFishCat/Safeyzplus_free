<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:carmi:alter');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $row = $db->find('soft_carmi','*',['carmi_id'=>$id,'create_user_id'=>$user_info['create_user_id'],'making_user_id'=>$user_info['user_id']]);
    if($row['carmi_status']!=0)exJson(0,'只能售出未使用的充值卡');
    if($row['carmi_status']==1)exJson(0,'该充值卡已经被售出');
    $db->update('soft_carmi',['carmi_status'=>1],['carmi_id'=>$id,'create_user_id'=>$user_info['create_user_id'],'making_user_id'=>$user_info['user_id']]);
    exJson(0,'操作成功');
}

#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $row = $db->find('soft_carmi','*',['carmi_id'=>$arr[$i],'create_user_id'=>$user_info['create_user_id'],'making_user_id'=>$user_info['user_id']]);
    if($row['carmi_status']==0){
        $db->update('soft_carmi',['carmi_status'=>1],['carmi_id'=>$arr[$i],'create_user_id'=>$user_info['create_user_id'],'making_user_id'=>$user_info['user_id']]);
    }
}
exJson(0,'操作成功');