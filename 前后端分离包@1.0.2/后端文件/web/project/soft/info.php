<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:soft:list');

$id = filterArr($_GET['id']);
if($id)$where['soft_id']=$id;

#添加归属UserId(作者id)
$where['create_user_id'] = $user_info['user_id'];

$res = $db->find('soft','*',$where,'soft_id');
if(!$res)exJson(1,'软件不存在');
$value = $res;

$datainfo['softId'] = $value['soft_id'];
$datainfo['softName'] = $value['soft_name'];                    //软件名称
$datainfo['softCode'] = $value['soft_code'];                    //软件识别码
$datainfo['softKey'] = $value['soft_key'];                      //软件秘钥

#反序列化软件扩展数据
$softExtend = unserialize($value['soft_extend']);

#基础配置
$datainfo['softStatus'] = strval($softExtend['soft_status']);           //运营状态 0正常 1维护 2停运
$datainfo['softWhgg'] = $softExtend['soft_whgg'];                       //停运&维护公告
$datainfo['softNotice'] = $softExtend['soft_notice'];                   //软件公告
$datainfo['loginType'] = strval($softExtend['login_type']);             //登录方式 0账号 1卡密
$datainfo['chargeType'] = strval($softExtend['charge_type']);           //计费方式 0免费 1计时收费 2计点收费 3混合收费
$datainfo['loginForceType'] = strval($softExtend['login_force_type']); 


#通讯配置
$datainfo['softJump'] = $softExtend['soft_jump']>=30 ? $softExtend['soft_jump'] : '180';                       //心跳周期(单位:秒)
$datainfo['endataType'] = strval($softExtend['endata_type']);           //数据加密 0明文 1rc4 2base64 3rsa2
$datainfo['signType'] = strval($softExtend['sign_type']);               //签名校验 0关闭 1开启
$datainfo['signClient'] = $softExtend['sign_client'] ? $softExtend['sign_client'] : '123[data]456[key]789';                   //签名模板 客户端
$datainfo['signServer'] = $softExtend['sign_server'] ? $softExtend['sign_server'] : '987[data]654[key]321';                   //签名模板 服务端
$datainfo['md5Type'] = strval($softExtend['md5_type']);                 //摘要校验 0关闭 1开启
$datainfo['rsa2Pluginkey'] = $softExtend['rsa2_pluginkey'];             //rsa2公钥
$datainfo['rsa2Privatekey'] = $softExtend['rsa2_privatekey'];           //rsa2私钥
$datainfo['rc4Key'] = $softExtend['rc4_key'];                           //rc4密钥

#注册配置
$datainfo['regType'] = strval($softExtend['reg_type']);                 //注册方式 0关闭注册 1完全开放 2卡密注册 3特征注册 4IP地址注册 5设备码注册
$datainfo['regTypeSl'] = $softExtend['reg_type_sl'] ? $softExtend['reg_type_sl'] : '0';                     //IP或设备码或特征信息限制时 IP地址.设备码.特征信息注册数量
$datainfo['regGive'] = strval($softExtend['reg_give']);                 //注册赠送 0关闭 1开启
$datainfo['regGiveTime'] = $softExtend['reg_give_time'] ? $softExtend['reg_give_time'] : '0';                //赠送时间 单位:分钟
$datainfo['regGivePoint'] = $softExtend['reg_give_point'] ? $softExtend['reg_give_point'] : '0';            //赠送点数
$datainfo['regGiveLimit'] = strval($softExtend['reg_give_limit']);      //赠送限制 0关闭 1开启
$datainfo['regGiveFeature'] = $softExtend['reg_give_feature'] ? $softExtend['reg_give_feature'] : '0';         //每个特征注册赠送次数

#试用配置
$datainfo['trialType'] = strval($softExtend['trial_type']);             //试用开关 0关闭 1开启
$datainfo['trialTime'] = $softExtend['trial_time'] ? $softExtend['trial_time'] : '0';                     //试用时间 单位:分钟
$datainfo['trialPoint'] = $softExtend['trial_point'] ? $softExtend['trial_point'] : '0';                 //试用点数

#绑定&多开配置
$datainfo['bindType'] = strval($softExtend['bind_type']);               //绑定方式 0不绑定 1绑定特征
$datainfo['unbindType'] = strval($softExtend['unbind_type']);           //解绑方式 0禁止解绑 1可以解绑
$datainfo['unbindSwitch'] = strval($softExtend['unbinds_switch']);
$datainfo['unbindSwitch1'] = strval($softExtend['unbinds_switch_1']);
$datainfo['unbindSwitch2'] = strval($softExtend['unbinds_switch_2']);
$datainfo['unbindTime'] = $softExtend['unbind_time'] ? $softExtend['unbind_time'] : '0';           //解绑扣时
$datainfo['unbindPoint'] = $softExtend['unbind_point'] ? $softExtend['unbind_point'] : '0';           //解绑扣点
$datainfo['openType'] = strval($softExtend['open_type']);               //通道模式 0单绑定多开 1总多开

$datainfo['createTime'] = $value['create_time'];
$datainfo['updateTime'] = $value['update_time'];

exJson(0,'操作成功',$datainfo);
?>