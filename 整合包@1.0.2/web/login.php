<?php
include('./common.php');

$where['username'] = $arr['username'];
$where['password'] = pass_mi($arr['password']);

#判断是否作者名下账户
if($arr['authorId']){
    $row = $db->find('user','*',['author_code'=>$arr['authorId']]);
    if($row){
        $where['create_user_id'] = $row['user_id'];
    }
}

$result = $db->find('user','*',$where);
if($result){
    if($result['user_type']!=0 && !$arr['authorId']){
        exJson(1,'登录失败，账号或密码错误');
    }
    if($result['status']==1){
        exJson(1,'登录失败，账户已被冻结，请联系客服处理。');
    }
    $session = md5($arr['username'].'v2Rose'.pass_mi($arr['password']).time());
    $cookie = authcode("{$result['user_id']}\t{$arr['username']}\t{$session}", 'ENCODE', SYS_KEY);
    $db->update('user',['login_cookie'=>$session,'login_time'=>date('Y-m-d h:i:s')],['user_id'=>$result['user_id']]);
    $retData['access_token'] = $cookie;
    exJson(0,'登录成功',$retData);
}else{
    exJson(1,'登录失败，账号或密码错误');
}

?>