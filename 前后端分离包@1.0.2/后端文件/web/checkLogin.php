<?php
//获取用户token
$token = $_SERVER['HTTP_AUTHORIZATION'];
if(isset($token)){
    $token = authcode(addslashes($token), 'DECODE', SYS_KEY);
    list($uid, $user, $sid) = explode("\t", $token);
    if($uid && $user && $sid){
        $user_info = $db->find('user','*',['user_id'=>$uid,'username'=>$user,'login_cookie'=>$sid]);
    }
}else{
    exJson(401,'未登录');
}
if(!$user_info){
    exJson(401,'未登录');
}