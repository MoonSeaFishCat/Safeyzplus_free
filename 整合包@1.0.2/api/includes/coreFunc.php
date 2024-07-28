<?php
/**
 * explain:客户端核心函数,可在任何接口调用,已引入core文件内
 * time:2024/01/19 13:13
 * author:樱島奈子
 */

/**
 * 生成随机码
 */
function createStr($length = 25,$lx = 0,$lx2 = 0){
    if($lx == 0){
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    }elseif($lx == 1){
        $str = 'abcdefghijklmnopqrstuvwxyz0123456789';
    }elseif($lx == 2){
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    }elseif($lx == 9){
        $str = '0123456789';
    }else{
        $str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    }
    $len = strlen($str)-1;
    $randstr = '';
    for ($i=0;$i<$length;$i++) {
        $num = mt_rand(0,$len);
        $randstr .= $str[$num];
        if (!(($i+1) % 5) && $i && ($i+1)<$length && $lx2){
            $randstr .= '-';
        }
    }
    return $randstr;
}

/**
 * 特殊状态返回数据
 */
function out_e($status = 'success',$msg = null) {
    $data['status'] = $status;
    $data['msg'] = $msg;
    echo json_encode($data);
    exit;
}

/**
 * 客户端数据签名
 */
function str_sign($str,$key){
    $newdata = str_replace('[data]',$str,$key['sign_client']);
    $newdata = str_replace('[key]',$key['soft_key'],$newdata);
    return md5($newdata);
}

/**
 * 文本转数组
 */
function txt_arr($txt){
    $arr = explode('&', $txt);
    $array = [];
    foreach($arr as $value){
        $tmp_arr = explode('=',$value);
        if(is_array($tmp_arr) && count($tmp_arr) == 2){
            $array = array_merge($array,[$tmp_arr[0]=>$tmp_arr[1]]);
        }
    }
    return $array;
}

/**
 * 数组签名
 */
function arr_sign($arr,$key){
    unset($arr['sign']);
    unset($arr['soft']);
    $sign = '';
    foreach ($arr as $k => $v) {
        $sign = $sign.$k.'='.$v.'&';
    }
    $newdata = substr($sign,0,strlen($sign)-1);
    $newdata = str_replace('[data]',$newdata,$key['a_kh_qm']);
    $newdata = str_replace('[key]',$key['softkey'],$newdata);
    return md5($newdata);
}

/**
 * RC4解密函数
 */
function rc4_encode($str,$turn = 0){//turn=0,utf8转gbk,1=gbk转utf8
    if(is_array($str)){
        foreach($str as $k => $v){
            $str[$k] = array_iconv($v);
        }
        return $str;
    }else{
        if(is_string($str) && $turn == 0){
            return mb_convert_encoding($str,'GBK','UTF-8');
        }elseif(is_string($str) && $turn == 1){
            return mb_convert_encoding($str,'UTF-8','GBK');
        }else{
            return $str;
        }
    }
}

/**
 * RC4加解密
 * @param string $data 待加密字符串或密文
 * @param string $softkey RC4密钥
 * @param int $t t=0加密，1=解密
 * @return string 已加密密文或解密后的明文
 */
function str_rc4($data,$softkey,$t=0) {
    $cipher = '';
    $key[] = "";
    $box[] = "";
    $softkey = rc4_encode($softkey);
    $data = rc4_encode($data);
    $softkey_length = strlen($softkey);
    if($t == 1){
        $data = hex2bin($data);
    }
    $data_length = strlen($data);
    for ($i = 0; $i < 256; $i++) {
        $key[$i] = ord($softkey[$i % $softkey_length]);
        $box[$i] = $i;
    }
    for ($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $key[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for ($a = $j = $i = 0; $i < $data_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $k = $box[(($box[$a] + $box[$j]) % 256)];
        $cipher .= chr(ord($data[$i]) ^ $k);
    }
    if($t == 1){
        return $cipher;
    }else{
        return bin2hex($cipher);
    }
}

/**
 * RSA2加解密
 * @param string $data 待加密字符串或密文
 * @param string $key RSA2公钥或私钥(解密用客户端公钥,加密用服务端私钥)
 * @param int $t t=0加密，1=解密
 * @return string 已加密密文或解密后的明文
 */
function str_rsa2($data,$key,$t=0) {
    require_once '../includes/rsa2.php';
    if(!$t){
        $mi_data = Rsa::privateEncrypt($data,$key);
    }else{
        $mi_data = Rsa::publicDecrypt($data,$key);
    }
    return $mi_data;
}

/**
 * 客户端数据解密
 * @return array 成功返回数组 失败拦截返回
 */
function str_decode(){
    global $soft,$data,$sign,$content_type;
    if($soft['endata_type'] == 0){//明文
        if($content_type)$data = $_REQUEST;//将POST或GET数据移交给data_arr
        if(!$data)retOut(status: 'success', code: 220, msg: '数据为空', soft: $soft);//数据为空
        if($soft['sign_type'] == 1){//数据签名
            if($sign=='')retOut(status: 'success', code: 221, msg: '数据签名为空', soft: $soft);//签名为空
            $s = $content_type ? arr_sign($data,$soft) : str_sign(json_encode($data),$soft);//生成数据签名
            if($s!=strtolower($sign))retOut(status: 'success', code: 222, msg: '数据签名错误', soft: $soft);
        }
        return $data;
    }else if($soft['endata_type'] == 1){//RC4加密
        if(!$data)retOut(status: 'success', code: 220, msg: '数据为空', soft: $soft);//数据为空
        if($soft['sign_type'] == 1){//数据签名
            if($sign=='')retOut( status: 'success', code: 221, msg: '数据签名为空', soft: $soft);//签名为空
            $s = str_sign($data,$soft);//生成数据签名
            if($s!=strtolower($sign))retOut(status: 'success', code: 222, msg: '数据签名错误', soft: $soft);
        }

        $de_data_info = str_rc4($data,$soft['rc4_key'],1);//RC4解密
        $de_data = $content_type ? txt_arr($de_data_info) : json_decode($de_data_info,true);
        if(!is_array($de_data)){
            out_e(status: 'error.data', msg: '数据解密失败');
        }
        
        return $de_data;//将解密后的数据转为数组移交给data
    }else if($soft['endata_type'] == 3){//RSA2加密
        if(!$data)retOut(status: 'success', code: 220, msg: '数据为空', soft: $soft);//数据为空
        if($soft['sign_type'] == 1){//数据签名
            if($sign=='')retOut(status: 'success', code: 221, msg: '数据签名为空', soft: $soft);//签名为空
            $s = str_sign($data,$soft);//生成数据签名
            if($s!=strtolower($sign))retOut(status: 'success', code: 222, msg: '数据签名错误', soft: $soft);
        }

        $de_data_info = str_rsa2($data,$soft['rsa2_pluginkey'],1);//RSA公钥解密
        $de_data = $content_type ? txt_arr($de_data_info) : json_decode($de_data_info,true);
        if(!is_array($de_data)){
            out_e(status: 'error.data', msg: '数据解密失败');
        }
        
        return $de_data;//将解密后的数据转为数组移交给data
    }else if($soft['endata_type'] == 2){//base64加密
        if(!$data)retOut(status: 'success', code: 220, msg: '数据为空', soft: $soft);//数据为空

        if($soft['sign_type'] == 1){//数据签名
            if($sign=='')retOut('success',221,'数据签名为空',$soft);//签名为空
            $s = str_sign($data,$soft);//生成数据签名
            if($s!=strtolower($sign))retOut(status: 'success', code: 222, msg: '数据签名错误', soft: $soft);
        }

        $de_data_info = base64_decode($data);//base64解密
        $de_data = $content_type ? txt_arr($de_data_info) : json_decode($de_data_info,true);
        if(!is_array($de_data)){
            out_e(status: 'error.data', msg: '数据解密失败');
        }

        return $de_data;//将解密后的数据转为数组移交给data
    }
}

/**
 * 服务端数据返回
 * @param string $status 接口执行状态(success正常 error未找到软件)
 * @param int $code 接口返回状态码(根据状态码表)
 * @param string $msg 返回信息
 * @param array $soft 软件信息数组
 * @param array $result 返回数据数组
 * @return array 成功返回数组 失败拦截返回
 */
function retOut(string $status,int $code = 200,?string $msg = null,?array $soft = [],?array $result = null) {
    global $khd_uuid,$khd_token,$param,$admin_id,$db;
    $time = time();
    $new_token = md5($khd_token.$time);
    if(!$soft){
        $data = array('status'=>$status,'code'=>$code,'msg'=>$msg,'result'=>$result,'param'=>$param,'uuid'=>$khd_uuid,'token'=>$new_token,'t'=>$time);
        echo json_encode($data);
        exit;
    }else{
        $jdata = array('code'=>$code,'msg'=>$msg,'result'=>$result,'param'=>$param,'uuid'=>$khd_uuid,'token'=>$new_token,'t'=>$time);
        $data = json_encode($jdata);
        if(is_array($soft) && isset($soft['endata_type'])){
            if($soft['endata_type']==1){
                $data = str_rc4($data,$soft['rc4_key']);
            }elseif($soft['endata_type']==3){
                $data = str_rsa2($data,$soft['rsa2_privatekey'],0); //私钥加密
            }elseif($soft['endata_type']==2){
                $data = base64_encode($data);
            }else{
                $data = array('code'=>$code,'msg'=>$msg,'result'=>$result,'param'=>$param,'uuid'=>$khd_uuid,'token'=>$new_token,'t'=>$time);
            }
        }else{
            $data = array('code'=>$code,'msg'=>$msg,'result'=>$result,'param'=>$param,'uuid'=>$khd_uuid,'token'=>$new_token,'t'=>$time);
        }
        if(is_array($data)){
            $qm = json_encode($data);
        }else{
            $qm = $data;
        }
        if($soft['sign_type'] == 1){
            $sign = str_replace('[data]',$qm,$soft['sign_server']);
            $sign = str_replace('[key]',$soft['soft_key'],$sign);
            $sign = md5($sign);
            $rets = array('status'=>$status,'data'=>$data,'sign'=>$sign);
        }else{
            $rets = array('status'=>$status,'data'=>$data);
        }
        echo json_encode($rets);
        exit;
    }
    exit;
}

/**
 * 向数据库插入一条接口日志
 */
function insertApilog(){
    global $db,$soft,$data_arr,$khd_data,$softCode,$sign;
    $dataApiLog['create_user_id'] = $soft['create_user_id'];
    $dataApiLog['soft_id'] = $soft['soft_id'];
    $dataApiLog['api_url'] = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $dataApiLog['api_name'] = basename($dataApiLog['api_url']);
    $dataApiLog['enc_info'] = serialize(json_decode($khd_data,true));
    $decr_info['soft'] = $softCode;
    $decr_info['sign'] = $sign;
    $decr_info['data'] = $data_arr;
    $dataApiLog['decr_info'] = serialize($decr_info);
    $dataApiLog['from_ip'] = getIp();
    $dataApiLog['from_mac'] = purge($data_arr['mac']);
    $dataApiLog['from_ver'] = purge($data_arr['version']);
    if($data_arr['account']){
        $userInfo = $db->find('soft_user','*',['create_user_id'=>$soft['create_user_id'],'soft_id'=>$soft['soft_id'],'user_account'=>$data_arr['account']]);
        if($userInfo)$dataApiLog['soft_user_id'] = $userInfo['user_id'];
    }
    $db->insert('soft_api_log',$dataApiLog);
}

/**
 * 种信息校验(包括软件状态)
 */
function checkInfo(){
    global $soft,$clientid,$mac,$ip,$feature,$version,$khd_uuid,$khd_token;
    if($clientid == ''){
        retOut(status: 'success', code: 201, msg: '客户端id不可为空', soft: $soft);
    }
    if($khd_uuid == ''){
        retOut(status: 'success', code: 206, msg: '客户端封包数据uuid不可为空', soft: $soft);
    }
    if($khd_token == ''){
        retOut(status: 'success', code: 207, msg: '客户端封包数据token不可为空', soft: $soft);
    }
    if($mac == ''){
        retOut(status: 'success', code: 203, msg: '客户端机器码不可为空', soft: $soft);
    }
    if($ip == ''){
        retOut(status: 'success', code: 204, msg: '客户端IP地址不可为空', soft: $soft);
    }
    if($feature == ''){
        retOut(status: 'success', code: 202, msg: '客户端特征信息不可为空', soft: $soft);
    }
    if($version == ''){
        retOut(status: 'success', code: 205, msg: '客户端版本不可为空', soft: $soft);
    }
    if($soft['soft_status']==1){
        retOut(status: 'success', code: 210, msg: $soft['soft_whgg'], soft: $soft);
    }elseif($soft['soft_status']==2){
        retOut(status: 'success', code: 211, msg: $soft['soft_whgg'], soft: $soft);
    }
}

?>