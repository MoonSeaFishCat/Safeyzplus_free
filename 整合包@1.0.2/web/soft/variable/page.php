<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('soft:variable:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$softId = filterArr($_GET['softId']);
if($softId)$where['a.soft_id']=$softId;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$count = $db->getCount("select b.soft_name,a.* from pre_soft_variable as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->getAll("select b.soft_name,a.* from pre_soft_variable as a left join pre_soft as b on a.soft_id=b.soft_id ".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();

    $datainfo['id'] = $value['id'];
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];
    $datainfo['vKey'] = $value['v_key'];
    $datainfo['vValue'] = $value['v_value'];
    $datainfo['vType'] = strval($value['v_type']);
    $datainfo['vTypes'] = getDictionaryTagName('soft_variable_type',$value['v_type']);
    $datainfo['vType_style'] = getDictionaryTagColor('soft_variable_type',$value['v_type']);
    $datainfo['vDel'] = strval($value['v_del']);
    $datainfo['vDels'] = getDictionaryTagName('soft_variable_del_type',$value['v_del']);
    $datainfo['vDel_style'] = getDictionaryTagColor('soft_variable_del_type',$value['v_del']);
    $datainfo['vAlter'] = strval($value['v_alter']);
    $datainfo['vAlters'] = getDictionaryTagName('soft_variable_alter_type',$value['v_alter']);
    $datainfo['vAlter_style'] = getDictionaryTagColor('soft_variable_alter_type',$value['v_alter']);
    $datainfo['vRead'] = $value['v_read'];
    $datainfo['vWrite'] = $value['v_write'];

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];

    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>