<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');
include('../../sysFunc.php');

#检测访问权限
@checkPower('pjc:soft:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$name = filterArr($_GET['softName']);
if($name)$where['soft_name']=$name;

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
    $datainfo['softKey'] = $value['soft_key'];                      //软件密钥

    #反序列化软件扩展数据
    $softExtend = unserialize($value['soft_extend']);
    $datainfo['softStatus'] = getDictionaryTagName('soft_status',$softExtend['soft_status']);           //运营状态 0正常 1维护 2停运
    $datainfo['softStatus_style'] = getDictionaryTagColor('soft_status',$softExtend['soft_status']);
    $datainfo['softJump'] = $softExtend['soft_jump'];               //心跳周期(单位:秒)
    $datainfo['regType'] = getDictionaryTagName('soft_reg_type',$softExtend['reg_type']);                 //注册方式 0关闭注册 1完全开放 2卡密注册 3特征限制
    $datainfo['regType_style'] = getDictionaryTagColor('soft_reg_type',$softExtend['reg_type']);
    $datainfo['loginType'] = getDictionaryTagName('soft_login_type',$softExtend['login_type']);             //登录方式 0账号 1卡串 2混合
    $datainfo['loginType_style'] = getDictionaryTagColor('soft_login_type',$softExtend['login_type']);
    $datainfo['chargeType'] = getDictionaryTagName('soft_charge_type',$softExtend['charge_type']);           //计费方式 0免费 1计时收费 2计点收费 3混合收费
    $datainfo['chargeType_style'] = getDictionaryTagColor('soft_charge_type',$softExtend['charge_type']);
    $datainfo['endataType'] = getDictionaryTagName('soft_endata_type',$softExtend['endata_type']);           //数据加密 0明文 1rc4 2base64 3rsa2
    $datainfo['endataType_style'] = getDictionaryTagColor('soft_endata_type',$softExtend['endata_type']);
    $datainfo['signType'] = getDictionaryTagName('soft_sign_type',$softExtend['sign_type']);               //签名校验 0关闭 1开启
    $datainfo['signType_style'] = getDictionaryTagColor('soft_sign_type',$softExtend['sign_type']);
    //$datainfo['loginForceType'] = getDictionaryTagName('soft_login_force_type',$softExtend['login_force_type']);   //顶号登录 0关闭 1开启
    //$datainfo['loginForceType_style'] = getDictionaryTagColor('soft_login_force_type',$softExtend['login_force_type']);

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>