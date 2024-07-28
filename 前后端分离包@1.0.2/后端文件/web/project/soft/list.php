<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:soft:list');

$name = filterArr($_GET['softName']);
if($name)$where['soft_name']=$name;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$count = $db->count('soft',$where);
if(!$count){
    exJson(0,'操作成功');
}

$res = $db->findAll('soft','*',$where,'soft_id');
foreach ($res as $value){
    $datainfo = array();
    $datainfo['softId'] = $value['soft_id'];
    $datainfo['softName'] = $value['soft_name'];                    //软件名称
    $datainfo['softCode'] = $value['soft_code'];                    //软件识别码
    $datainfo['softKey'] = $value['soft_key'];                      //软件密钥

    #反序列化软件扩展数据
    $softExtend = unserialize($value['soft_extend']);
    $datainfo['softStatus'] = $softExtend['soft_status'];           //运营状态 0正常 1维护 2停运
    $datainfo['softJump'] = $softExtend['soft_jump'];               //心跳周期(单位:秒)
    $datainfo['regType'] = $softExtend['reg_type'];                 //注册方式 0关闭注册 1完全开放 2卡密注册 3IP限制 4机器码限制
    $datainfo['loginType'] = $softExtend['login_type'];             //登录方式 0账号 1卡密 2混合
    $datainfo['chargeType'] = $softExtend['charge_type'];           //计费方式 0免费 1计时收费 2计点收费 3混合收费
    $datainfo['endataType'] = $softExtend['endata_type'];           //数据加密 0明文 1rc4 2base64 3rsa2
    $datainfo['signType'] = $softExtend['sign_type'];               //签名校验 0关闭 1开启

    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datalist[] = $datainfo;
}
exJson(0,'操作成功',$datalist);

?>