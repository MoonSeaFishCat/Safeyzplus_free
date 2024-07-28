<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('agent:subordinate:carmit');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $row = $db->find('agent_carmit','*',['id'=>$id,'create_user_id'=>$user_info['create_user_id']]);
    if(!$row)exJson(1,'删除失败');
    #检查该子代是否归属该代理
    $row = $db->find('user','*',['user_id'=>$row['agent_id'],'create_user_id'=>$user_info['create_user_id'],'agent_id'=>$user_info['user_id']]);
    if(!$row)exJson(1,'删除失败');
    $db->delete('agent_carmit',['id'=>$id,'create_user_id'=>$user_info['create_user_id']]);
    exJson(0,'操作成功');
}


#批量删除
if(count($arr)<=0){
    exJson(1,'操作失败');
}
for($i=0;$i<count($arr);$i++) {
    $row = $db->find('agent_carmit','*',['id'=>$arr[$i],'create_user_id'=>$user_info['create_user_id']]);
    if(!$row)exJson(1,'删除失败');
    #检查该子代是否归属该代理
    $row = $db->find('user','*',['user_id'=>$row['agent_id'],'create_user_id'=>$user_info['create_user_id'],'agent_id'=>$user_info['user_id']]);
    if(!$row)exJson(1,'删除失败');
    $db->delete('agent_carmit',['id'=>$arr[$i],'create_user_id'=>$user_info['create_user_id']]);
}
exJson(0,'操作成功');