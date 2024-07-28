<?php
class Aes{
    public $iv;
    public $keys;

    public function __construct($key,$iv){
		$this->keys = $key;//32位
        $this->iv = $iv;//16位
    }

    /**
     * 加密
     * @param string $data　明文
     * @return string　返回密文(已base64加密的密文)
     */
    public function encode($data){
		$strEncode = bin2hex(openssl_encrypt($data, 'AES-128-CBC',$this->keys, OPENSSL_RAW_DATA ,$this->iv));   # AES-256-CBC
        return $strEncode;
    }

    /**
     * 解密
     * @param string $data 密文(已base64加密的密文)
     * @return string　明文
     */
    public function decode($data){
		$strdecode = openssl_decrypt(hex2bin($data), 'AES-128-CBC', $this->keys, OPENSSL_RAW_DATA, $this->iv);
        return  $strdecode;
    }
}

?>