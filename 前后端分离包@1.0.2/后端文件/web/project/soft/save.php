<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:soft:save');

#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

#软件基础数据
$saveData['soft_name'] = $arr['softName'];                    //软件名称
$saveData['soft_code'] = $arr['softCode'];                    //软件识别码
$saveData['soft_key'] = $arr['softKey'];                      //软件密钥

#序列化软件扩展数据
$saveData_['soft_status'] = intval($arr['softStatus']);           //运营状态 0正常 1维护 2停运
$saveData_['soft_whgg'] = $arr['softWhgg'];               //停运&维护公告
$saveData_['soft_notice'] = $arr['softNotice'];           //软件公告
$saveData_['login_type'] = intval($arr['loginType']);             //登录方式 0账号 1卡密 2混合
$saveData_['charge_type'] = intval($arr['chargeType']);           //计费方式 0免费 1计时收费 2计点收费 3混合收费
$saveData_['login_force_type'] = intval($arr['loginForceType']);

#通讯配置
$saveData_['soft_jump'] = intval($arr['softJump']);               //心跳周期(单位:秒)
$saveData_['endata_type'] = intval($arr['endataType']);           //数据加密 0明文 1rc4 2base64 3rsa2
$saveData_['sign_type'] = intval($arr['signType']);               //签名校验 0关闭 1开启
$saveData_['sign_client'] = $arr['signClient'];           //签名模板 客户端
$saveData_['sign_server'] = $arr['signServer'];           //签名模板 服务端
$saveData_['md5_type'] = intval($arr['md5Type']);                 //摘要校验 0关闭 1开启
$saveData_['rsa2_pluginkey'] = $arr['rsa2Pluginkey'];     //rsa2公钥
$saveData_['rsa2_privatekey'] = $arr['rsa2Privatekey'];   //rsa2私钥
$saveData_['rc4_key'] = $arr['rc4Key'];                   //rc4密钥

#注册配置
$saveData_['reg_type'] = intval($arr['regType']);                 //注册方式 0关闭注册 1完全开放 2卡密注册 3IP限制 4机器码限制
$saveData_['reg_type_sl'] = $arr['regTypeSl'];            //IP或机器码限制时 IP和机器码注册数量
$saveData_['reg_give'] = intval($arr['regGive']);                 //注册赠送 0关闭 1开启
$saveData_['reg_give_time'] = $arr['regGiveTime'];        //赠送时间 单位:分钟
$saveData_['reg_give_point'] = $arr['regGivePoint'];    //赠送点数
$saveData_['reg_give_limit'] = intval($arr['regGiveLimit']);      //赠送限制 0关闭 1开启
$saveData_['reg_give_feature'] = $arr['regGiveFeature']; //每个特征注册赠送次数

#试用配置
$saveData_['trial_type'] = intval($arr['trialType']);                 //试用开关 0关闭 1开启
$saveData_['trial_time'] = intval($arr['trialTime']);                 //试用时间 单位:分钟
$saveData_['trial_point'] = $arr['trialPoint'];             //试用点数

#绑定&多开
$saveData_['bind_type'] = intval($arr['bindType']);               //绑定方式 0不绑定 1IP地址 2机器码
$saveData_['unbind_type'] = intval($arr['unbindType']);           //解绑方式 0禁止解绑 1可以解绑
$saveData_['unbinds_switch'] = intval($arr['unbindSwitch']);
$saveData_['unbinds_switch_1'] = intval($arr['unbindSwitch1']);
$saveData_['unbinds_switch_2'] = intval($arr['unbindSwitch2']);
$saveData_['unbind_time'] = $arr['unbindTime'];           //解绑扣时
$saveData_['unbind_point'] = $arr['unbindPoint'];           //解绑扣点
$saveData_['open_type'] = intval($arr['openType']);               //0单绑定多开 1总多开

#序列化扩展数据
$saveData['soft_extend'] = serialize($saveData_);

$db->insert('soft',$saveData);

exJson(0,'操作成功');
?>