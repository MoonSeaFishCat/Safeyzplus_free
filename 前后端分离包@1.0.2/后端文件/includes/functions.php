<?php
/**
 * 过滤参数
 * @param string $str 接受的参数
 * @return string
 */
function filterWords($str)
{
    $farr = array(
        "/<(\\/?)(script|i?frame|style|html|body|title|link|meta|object|\\?|\\%)([^>]*?)>/isU",
        "/(<[^>]*)on[a-zA-Z]+\s*=([^>]*>)/isU",
        "/select |alter |create |insert |update |delete |count |db.config|pdo.class|include|require|\'|\/\*|\*|\.\.\/|\.\/|union|into|load_file|outfile|dump/is"
    );
    $str = preg_replace($farr,'',$str);
    return $str;
}

/**
 * 过滤接受的参数或者数组,如$_GET,$_POST
 * @param array|string $arr 接受的参数或者数组
 * @return array|string
 */
function filterArr($arr)
{
    //编码转换成UTF8
    $encode = mb_detect_encoding($arr,array("ASCII","UTF-8","GB2312","GBK","BIG5"));
    if($encode != 'UTF-8'){
        $arr = iconv($encode,'UTF-8',$arr);
    }
    if(is_array($arr)){
        foreach($arr as $k => $v){
            $arr[$k] = filterWords($v);
        }
    }else{
        $arr = filterWords($arr);
    }
    return $arr;
}

/**
 * 过滤接受的参数或者数组,如$_GET,$_POST
 * @param array|string $arr 接受的参数或者数组
 * @return array|string
 */
function purge($arr)
{
    //编码转换成UTF8
    $encode = mb_detect_encoding($arr,array("ASCII","UTF-8","GB2312","GBK","BIG5"));
    if($encode != 'UTF-8'){
        $arr = iconv($encode,'UTF-8',$arr);
    }
    if(is_array($arr)){
        foreach($arr as $k => $v){
            $arr[$k] = filterWords($v);
        }
    }else{
        $arr = filterWords($arr);
    }
    return $arr;
}

#数组过滤为where条件
function whereStr($key)
{
    $nums = 1;
    $str = '';
    if(is_array($key)){
        $count_key = count($key);
        foreach($key as $k=>$v){
            if($count_key == $nums){
                $str .= "$k ='$v'";
            }else{
                $str .= "$k ='$v'".' '.'and'.' ';
            }
            $nums++;
        }
        if($str != ''){
            $str = ' where '.$str;
        }
    }
    return $str;
}

#自定义加密算法
function enCode($pass)
{
    $str = substr(md5($pass),7,8);
    $str2 = substr(hash('sha256',$pass),12,24);
    return $str.'.'.$str2;
}

#密码加密
function pass_mi($pass)
{
    $str = substr(md5($pass),7,8);
    $str2 = base64_encode(substr(hash('sha256',$pass),12,24));
    return '$2a$01$'.$str.'.'.$str2;
}

#时间戳转换到时间
function timetostr($time = null)
{
    if($time)return date("Y-m-d H:i:s",$time);
    return date("Y-m-d H:i:s");
}

#获取来源IP地址
function getIp() {
    if(isset($_SERVER)){
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])){
            $arr = explode(',',$_SERVER['HTTP_X_FORWARDED_FOR']);
            foreach ($arr as $ip){
                $ip = trim($ip);
                if ($ip != 'unknown'){$realip = $ip; break;}
            }
        }elseif(isset($_SERVER['HTTP_CLIENT_IP'])){
            $realip = $_SERVER['HTTP_CLIENT_IP'];
        }else{
            if (isset($_SERVER['REMOTE_ADDR'])){
                $realip = $_SERVER['REMOTE_ADDR'];
            }else{
                $realip = '0.0.0.0';
            }
        }
    }else{
        if (getenv('HTTP_X_FORWARDED_FOR')){
            $realip = getenv('HTTP_X_FORWARDED_FOR');
        }elseif (getenv('HTTP_CLIENT_IP')){
            $realip = getenv('HTTP_CLIENT_IP');
        }else{
            $realip = getenv('REMOTE_ADDR');
        }
    }
    preg_match("/[\d\.]{7,15}/",$realip,$onlineip);
    $realip = !empty($onlineip[0]) ? $onlineip[0] : '0.0.0.0';
    return $realip;
}

#DZ论坛经典加解密
function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) 
{
    $ckey_length = 4;
    $key = md5($key);
    $keya = md5(substr($key, 0, 16));
    $keyb = md5(substr($key, 16, 16));
    $keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
    $cryptkey = $keya.md5($keya.$keyc);
    $key_length = strlen($cryptkey);
    $string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
    $string_length = strlen($string);
    $result = '';
    $box = range(0, 255);
    $rndkey = array();
    for($i = 0; $i <= 255; $i++) {
        $rndkey[$i] = ord($cryptkey[$i % $key_length]);
    }
    for($j = $i = 0; $i < 256; $i++) {
        $j = ($j + $box[$i] + $rndkey[$i]) % 256;
        $tmp = $box[$i];
        $box[$i] = $box[$j];
        $box[$j] = $tmp;
    }
    for($a = $j = $i = 0; $i < $string_length; $i++) {
        $a = ($a + 1) % 256;
        $j = ($j + $box[$a]) % 256;
        $tmp = $box[$a];
        $box[$a] = $box[$j];
        $box[$j] = $tmp;
        $result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
    }
    if($operation == 'DECODE') {
        if(((int)substr($result, 0, 10) == 0 || (int)substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
            return substr($result, 26);
        } else {
            return '';
        }
    } else {
        return $keyc.str_replace('=', '', base64_encode($result));
    }
}

#Json格式化返回(0正常 401登录状态失效)
function exJson(int $code,string $msg,$data = null)
{
    if($data==null){
        exit(json_encode(['code'=>$code,'message'=>$msg], JSON_UNESCAPED_SLASHES));
    }
    exit(json_encode(['code'=>$code,'message'=>$msg,'data'=>$data], JSON_UNESCAPED_SLASHES));
}

?>