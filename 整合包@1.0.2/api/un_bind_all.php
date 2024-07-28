<?php
/**
 * explain:解绑(所有)
 * time:2024/01/28 23:15
 * author:樱島奈子
 */
//只能在原特征上解绑：只解绑当前设备的特征
//可在任意特征上解绑：会解绑所有已绑定特征
require './includes/core.php';
if(!$soft['bind_type']){
    retOut(status: 'success', code: 239, msg: '软件未开启绑定限制', soft: $soft);
}
if(!$soft['unbind_type']){
    retOut(status: 'success', code: 240, msg: '软件未开启解绑功能', soft: $soft);
}
if(!$account)retOut(status: 'success', code: 304, msg: '账号/卡号不可为空', soft: $soft);
$userPass = isset($data_arr['account_pass']) ? purge($data_arr['account_pass']) : '';
$userInfo = getUserAccount(userAccount: $account, userPass: $userPass);
if(!$userInfo)retOut(status: 'success', code: 304, msg: '账号/卡号错误,请重新输入', soft: $soft);
if($soft['unbinds_switch_2']==1){
    //原特征上解绑
    $unFeature = isset($data_arr['feature']) ? purge($data_arr['feature']) : '';
    if(!$unFeature)retOut(status: 'success', code: 202, msg: '客户端特征信息不可为空', soft: $soft);
}elseif($soft['unbinds_switch_2']==0){
    retOut(status: 'success', code: 339, msg: '该解绑接口已关闭!', soft: $soft);
}
//检查是否还有解绑次数
checkUnBind(user_id: $userInfo['user_id'], unbind: $userInfo['unbind']);
//0成功 或 1失败(账户剩余时间或点数不足) 2不存在此特征信息 3没有绑定任何特征信息
if($soft['unbinds_switch_2']==1){
    //检查是否已绑定
    $row = checkBindFeature(userId: $userInfo['user_id'],feature: $unFeature);
    if(!$row)retOut(status: 'success', code: 251, msg: '当前特征信息未绑定', soft: $soft);
    $u = unBindFeature(userInfo: $userInfo, feature: $unFeature);
}else{
    $u = unBindFeature(userInfo: $userInfo);
}
if($u==1)retOut(status: 'success', code: 342, msg: '账户点数或时间不足,无法解绑', soft: $soft);
if($u==3)retOut(status: 'success', code: 259, msg: '当前用户未绑定任何特征信息', soft: $soft);
retOut(status: 'success', code: 200, msg: '解绑成功!', soft: $soft);