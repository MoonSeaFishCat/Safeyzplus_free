<?php
/**
 * explain:登录
 * time:2024/01/23 16:01
 * author:樱島奈子
 */
include './includes/core.php';

//用户密码(卡号登录时默认为空)
$account_pass = isset($data_arr['account_pass']) ? purge($data_arr['account_pass']) : '';
switch ($soft['login_type']){
    case 0:
        //账号登录
        if(!$account)retOut(status: 'success', code: 300, msg: '登录账号不可为空', soft: $soft);
        if(!$account_pass)retOut(status: 'success', code: 301, msg: '登录密码不可为空', soft: $soft);
        //读取用户信息
        $userInfo = getUserAccount(userAccount: $account, userPass: $account_pass);
        if(!$userInfo)retOut(status: 'success', code: 302, msg: '账号或密码错误,请重新输入', soft: $soft);
        break;
    case 1:
        //卡号登录
        if(!$account)retOut(status: 'success', code: 300, msg: '登录卡号不可为空', soft: $soft);
        //读取用户信息
        $userInfo = getUserAccount(userAccount: $account);
        if(!$userInfo){
            //读取失败进行卡号检测是否能激活
            $carmiInfo = getCarmiInfo(carmi: $account);
            //未检测到卡号
            if($carmiInfo)retOut(status: 'success',code: 303, msg: '卡号错误,请重新输入', soft: $soft);
            //检测到卡号但已被使用状态
            if($carmiInfo['carmi_status']!=0 && $carmiInfo['carmi_status']!=1)retOut(status: 'success', code: 303, msg: '卡号错误,请重新输入', soft: $soft);
            //卡状态正常 则进行充值卡号激活并返回用户数据
            $userInfo = insertUserCarmi(carmiInfo: $carmiInfo);
        }
        if(!$userInfo)retOut(status: 'success', code: 303, msg: '卡号错误,请重新输入', soft: $soft);
        break;
    case 2:
        //混合登录
        if(!$account)retOut(status: 'success',code: 300,msg: '登录账号/卡号不可为空',soft: $soft);
        //读取用户信息
        $userInfo = getUserAccount(userAccount: $account, userPass: $account_pass);
        if(!$userInfo){
            //读取失败进行卡号检测是否能激活
            $carmiInfo = getCarmiInfo(carmi: $account);
            //未检测到卡号
            if(!$carmiInfo)retOut(status: 'success', code: 303, msg: '账号/卡号错误,请重新输入', soft: $soft);
            //检测到卡号但已被使用状态
            if($carmiInfo['carmi_status']!=0 && $carmiInfo['carmi_status']!=1)retOut(status: 'success', code: 303, msg: '账号/卡号错误,请重新输入', soft: $soft);
            //卡状态正常 则进行充值卡号激活并返回用户数据
            $userInfo = insertUserCarmi(carmiInfo: $carmiInfo);
        }
        if(!$userInfo)retOut(status: 'success', code: 304, msg: '账号/卡号错误,请重新输入', soft: $soft);
        break;
}

//验证用户状态
$u = checkUserStatus(userInfo: $userInfo);
if($u==1){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,用户已被封禁)');
    retOut(status: 'success', code: 253, msg: '用户已被封禁,无法登录', soft: $soft);
}
if($u==2){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,用户已被冻结)');
    retOut(status: 'success', code: 254, msg: '用户已被冻结,无法登录', soft: $soft);
}

//验证是否到期
$u = checkUserExpire(userInfo: $userInfo);
if($u==1){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,用户已过期)');
    retOut(status: 'success', code: 255, msg: '用户已过期,请充值后登录', soft: $soft);
}
if($u==2){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,用户点数不足)');
    retOut(status: 'success', code: 256, msg: '用户点数不足,请充值后登录', soft: $soft);
}
if($u==3){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,用户已到期或点数不足)');
    retOut(status: 'success', code: 257, msg: '用户已到期或点数不足,请充值后登录', soft: $soft);
}

//验证用户绑定
if(!checkBindFeature(userId: $userInfo['user_id'], feature: $feature)){
    //未绑定进行绑定操作
    $s = bindFeature(userInfo: $userInfo, feature: $feature);
    if($s==3)retOut(status: 'success', code: 259, msg: '特征信息为空,无法登录', soft: $soft);
    //绑定特征信息达到上限,无法登录
    if($s==1){
        //检测软件是否开启了登录自动解绑
        if($soft['unbinds_switch']==1){
            //检查是否还有解绑次数
            checkUnBind(user_id: $userInfo['user_id'], unbind: $userInfo['unbind']);
            $u = unBindFeature(userInfo: $userInfo);
            if($u==1)retOut(status: 'success', code: 342, msg: '账户点数或时间不足,无法自动解绑', soft: $soft);
            //自动解绑后再次进行绑定
            bindFeature(userInfo: $userInfo, feature: $feature);
        }else{
            insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,绑定特征信息达到上限)');
            retOut(status: 'success', code: 260, msg: '绑定特征信息达到上限,无法登录', soft: $soft);
        }
    }
}
//进行通道检测
if(!checkOpening(userInfo: $userInfo)){
    //达到通道上限
    if($soft['login_force_type']){
        //进行强制下线
        if(!deleteCookie(user_id: $userInfo['user_id'], feature: $feature, cookie: ''))retOut(status: 'success',code: 260,msg: '登录通道已达到上限,无法登录',soft: $soft);
    }else{
        insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录失败,通道达到上限)');
        retOut(status: 'success', code: 260, msg: '登录通道已达到上限,无法登录', soft: $soft);
    }
}
//进行作者账户余额判断
checkAuthorSurplus(authorId: $admin_id, userInfo: $userInfo);

//验证通过 进行登录 添加cookie凭据
$row_cookie = insertCookie(userInfo: $userInfo);
if(!$row_cookie)retOut(status: 'success', code: 305, msg: '登录失败,请稍后再试', soft: $soft);
$rowCookie['softVersion'] = $row_cookie['soft_version'];
$rowCookie['loginAccount'] = $row_cookie['login_account'];
if($account_pass)$rowCookie['loginAccountPass'] = $account_pass;
$rowCookie['loginCookie'] = $row_cookie['login_cookie'];
$rowCookie['clientOs'] = $row_cookie['client_os'];
$rowCookie['loginTime'] = $row_cookie['login_time'];
$rowCookie['heartTime'] = $row_cookie['heart_time'];
$db->update('soft_user',['login_time'=>$row_cookie['login_time'],'heart_time'=>$row_cookie['heart_time']],['user_id'=>$userInfo['user_id']]);
insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '登录了软件(登录成功)');
retOut(status: 'success', code: 200, msg: '登录成功!', soft: $soft, result: $rowCookie);
?>