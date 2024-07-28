<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('sys:dict:remove');

#单个删除
$id = filterArr($_GET['id']);
if($id){
    $db->delete('dictionary',['dict_id'=>$id]);
    #删除关联的字典数据
    $db->delete('dictionary_data',['dict_id'=>$id]);
    exJson(0,'操作成功');
}
exJson(1,'操作失败');