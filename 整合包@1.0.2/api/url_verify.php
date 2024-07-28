<?
/**
 * explain:域名验证
 * time:2024/02/15 11:02
 * author:樱島奈子
 */
include './includes/core.php';

if(!$account)retOut(status: 'success', code: 801, msg: '域名验证失败', soft: $soft);
$userInfo = getUserAccount(userAccount: $account);

//验证用户状态
$u = checkUserStatus(userInfo: $userInfo);
if($u==1){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '验证了域名(验证失败,用户已被封禁)');
    retOut(status: 'success', code: 253, msg: '授权已被封禁', soft: $soft);
}
if($u==2){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '验证了域名(验证失败,用户已被冻结)');
    retOut(status: 'success', code: 254, msg: '授权已被冻结', soft: $soft);
}

//验证是否到期
$u = checkUserExpire(userInfo: $userInfo);
if($u==1){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '验证了域名(验证失败,授权已过期)');
    retOut(status: 'success', code: 255, msg: '授权已过期,请及时充值', soft: $soft);
}
if($u==2){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '验证了域名(验证失败,授权点数不足)');
    retOut(status: 'success', code: 256, msg: '授权点数不足,请及时充值', soft: $soft);
}
if($u==3){
    insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '验证了域名(验证失败,授权已到期或点数不足)');
    retOut(status: 'success', code: 257, msg: '授权已到期或点数不足,请及时充值', soft: $soft);
}
insertUserLog(user_id: $userInfo['user_id'], type: 0,logData: '验证了域名(验证成功)');

unset($userInfo['user_pass']);
unset($userInfo['user_id']);

retOut(status: 'success', code: 200, msg: 'ok!', soft: $soft, result: $userInfo);
?>