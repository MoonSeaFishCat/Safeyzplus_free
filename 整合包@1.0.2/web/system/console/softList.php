<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$count = $db->count('soft',$where);
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

$res = $db->findAll('soft','*',$where,'soft_id',$limit);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];                    //软件名称
    $datainfo['softCode'] = $value['soft_code'];                    //软件识别码

    #反序列化软件扩展数据
    $softExtend = unserialize($value['soft_extend']);
    $datainfo['softStatus'] = getDictionaryTagName('soft_status',$softExtend['soft_status']);           //运营状态 0正常 1维护 2停运
    $datainfo['softStatus_style'] = getDictionaryTagColor('soft_status',$softExtend['soft_status']);
    $datainfo['loginType'] = getDictionaryTagName('soft_login_type',$softExtend['login_type']);             //登录方式 0账号 1卡串 2混合
    $datainfo['loginType_style'] = getDictionaryTagColor('soft_login_type',$softExtend['login_type']);
    $datainfo['chargeType'] = getDictionaryTagName('soft_charge_type',$softExtend['charge_type']);           //计费方式 0免费 1计时收费 2计点收费 3混合收费
    $datainfo['chargeType_style'] = getDictionaryTagColor('soft_charge_type',$softExtend['charge_type']);

    $where['soft_id'] = $value['soft_id'];
    $datainfo['userCount'] = $db->count('soft_user',$where);

    $datainfo['carmiZT'] = $db->count('soft_carmi',$where);
    $where['carmi_status'] = 0;
    $datainfo['carmiZT0'] = $db->count('soft_carmi',$where);
    $where['carmi_status'] = 1;
    $datainfo['carmiZT1'] = $db->count('soft_carmi',$where);
    $where['carmi_status'] = 2;
    $datainfo['carmiZT2'] = $db->count('soft_carmi',$where);
    $where['carmi_status'] = 3;
    $datainfo['carmiZT3'] = $db->count('soft_carmi',$where);
    $where['carmi_status'] = 4;
    $datainfo['carmiZT4'] = $db->count('soft_carmi',$where);
    unset($where['carmi_status']);

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>