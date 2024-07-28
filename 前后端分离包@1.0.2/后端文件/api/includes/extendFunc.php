<?php
/**
 * explain:客户端扩展函数,可在任何接口调用,已引入core文件内
 * time:2024/01/19 13:13
 * author:樱島奈子
 */

/**
 * 软件版本摘要验证
 */
function checkMd5(){
    global $db,$ver,$md5,$admin_id,$soft;
    if($soft['md5_type']){
        $row = $db->find('soft_version','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'version'=>$ver]);
        if(!$row)retOut('success',223,'程序MD5验证失败',$soft);
        if($row['md5']!=$md5)retOut('success',223,'程序MD5验证失败',$soft);
    }
}

/**
 * 扣除作者CPU电量
 * @param int $authorId 作者id
 * @param array $userInfo 用户信息数组
 * @return bool 成功返回true 失败直接拦截返回
 */
function checkAuthorSurplus(int $authorId,array $userInfo){
    global $db,$soft;
    $dqrq = date("Y-m-d");
    if(!$userInfo['author_deduct_time'] || $userInfo['author_deduct_time']!=$dqrq){
        //进行扣除
        $res = $db->find('user','*',['user_id'=>$authorId]);
        if(!$res)out_e(status: 'error.balance', msg: '作者账户可用CPU电量不足');
        $website = $db->find('website','*',['web_key'=>'soft_user_usemoney']);
        if($res['money_2']<$website['web_value'])out_e(status: 'error.balance', msg: '作者账户可用CPU电量不足');
        $newValue['money_2'] = $res['money_2'] - $website['web_value'];
        $db->update('user',$newValue,['user_id'=>$authorId]);
        $db->update('soft_user',['author_deduct_time'=>$dqrq],['user_id'=>$userInfo['user_id']]);
    }
    return true;
}

/**
 * 读取充值卡信息(通过卡号查询)
 * @param string $carmi 卡号
 * @return array|bool 充值卡信息数组 失败返回false
 */
function getCarmiInfo(string $carmi){
    global $db,$admin_id,$soft;
    $row = $db->find('soft_carmi','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'carmi_str'=>$carmi]);
    if(!$row)return false;
    $carmi_info['carmi_id'] = $row['carmi_id'];
    $carmi_info['carmi_str'] = $carmi;
    $carmi_info['carmi_name'] = $row['carmi_name'];
    $carmi_info['carmi_time'] = $row['carmi_time'];
    $carmi_info['carmi_point'] = $row['carmi_point'];
    $carmi_info['carmi_opening'] = $row['carmi_opening'];
    $carmi_info['carmi_bind'] = $row['carmi_bind'];
    $carmi_info['carmi_unbind'] = $row['carmi_unbind'];
    $carmi_info['carmi_data_extra'] = $row['carmi_data_extra'];
    $carmi_info['carmi_notes'] = $row['carmi_notes'];

    $carmi_info['carmi_status'] = $row['carmi_status'];
    $carmi_info['carmi_pch'] = $row['carmi_pch'];
    $carmi_info['use_time'] = $row['use_time'];
    $carmi_info['create_time'] = $row['create_time'];
    return $carmi_info;
}

/**
 * 读取卡种信息(通过卡种id查询)
 * @param string $carmit 卡种id
 * @return array|bool 卡种信息数组 失败返回false
 */
function getCarmitInfo(string $carmit){
    global $db,$admin_id,$soft;
    $row = $db->find('soft_carmit','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'carmit_id'=>$carmit]);
    if(!$row)return false;
    $carmit_info['carmit_id'] = $carmit;
    $carmit_info['carmit_name'] = $row['carmit_name'];
    $carmit_info['carmit_time'] = $row['carmit_time'];
    $carmit_info['carmit_point'] = $row['carmit_point'];
    $carmit_info['carmit_opening'] = $row['carmit_opening'];
    $carmit_info['carmit_bind'] = $row['carmit_bind'];
    $carmit_info['carmit_unbind'] = $row['carmit_unbind'];
    $carmit_info['carmit_length'] = $row['carmit_length'];
    $carmit_info['carmit_prefix'] = $row['carmit_prefix'];
    $carmit_info['carmit_data_extra'] = $row['carmit_data_extra'];
    $carmit_info['carmit_notes'] = $row['carmit_notes'];
    $carmit_info['carmit_money'] = $row['carmit_money'];
    $carmit_info['create_time'] = $row['create_time'];
    return $carmit_info;
}

/**
 * 修改充值卡信息(通过卡种id查询)
 * @param string $carmi_id 卡号id
 * @param string $key 字段名
 * @param string $value 字段值
 */
function alterCarmiInfo(string $carmi_id,string $key,string $value){
    global $db;
    $db->update('soft_carmi',[$key=>$value],['carmi_id'=>$carmi_id]);
}

/**
 * 用户充值(通过充值卡号)
 * @param string $userInfo 用户信息数组
 * @param string $carmiInfo 充值卡信息数组
 * @return bool true(成功) false(失败)
 */
function rechargeUserCarmi(array $userInfo,array $carmiInfo){
    global $db;
    $endtime = strtotime($userInfo['endtime']);
    if($endtime < time()){
        $endtime = time();
    }
    $endtime = $endtime + $carmiInfo['carmi_time'] * 60;
    $soft_user_info['endtime'] = timetostr($endtime);
    $soft_user_info['point'] = $userInfo['point'] + $carmiInfo['carmi_point'];
    $soft_user_info['opening'] = $carmiInfo['carmi_opening'];
    $soft_user_info['bind'] = $carmiInfo['carmi_bind'];
    $soft_user_info['unbind'] = $carmiInfo['carmi_unbind'];
    $soft_user_info['data_extra'] = $carmiInfo['carmi_data_extra'];
    $row = $db->update('soft_user',$soft_user_info,['user_id'=>$userInfo['user_id']]);
    if(!$row)return false;
    $userTime = timetostr(time());
    $useEndtime = timetostr(time()+$carmiInfo['carmi_time'] * 60);
    $usePoint = $carmiInfo['carmi_point'];
    $db->update('soft_carmi',['carmi_status'=>2,'use_soft_user_id'=>$userInfo['user_id'],'use_time'=>$userTime,'use_endtime'=>$useEndtime,'use_point'=>$usePoint],['carmi_id'=>$carmiInfo['carmi_id']]);
    insertUserLog(user_id: $userInfo['user_id'], type: 2, logData: "使用了充值卡[{$carmiInfo['carmi_str']}]进行账户充值,获得{$carmiInfo['carmi_point']}点数,有效期至{$endtime}");
    return true;
}

/**
 * 生成用户数据(通过充值卡号)
 * @param array $carmiInfo 充值卡信息
 * @return array|bool 用户信息数组 失败返回false
 */
function insertUserCarmi(array $carmiInfo){
    global $db,$soft,$ip,$mac;
    $soft_user_info['create_user_id'] = $soft['create_user_id'];
    $soft_user_info['soft_id'] = $soft['soft_id'];
    $soft_user_info['user_type'] = 1;
    $soft_user_info['user_account'] = $carmiInfo['carmi_str'];
    $endtime = time() + $carmiInfo['carmi_time'] * 60;
    $soft_user_info['endtime'] = timetostr($endtime);
    $soft_user_info['point'] = $carmiInfo['carmi_point'];
    $soft_user_info['opening'] = $carmiInfo['carmi_opening'];
    $soft_user_info['bind'] = $carmiInfo['carmi_bind'];
    $soft_user_info['unbind'] = $carmiInfo['carmi_unbind'];
    $soft_user_info['data_extra'] = $carmiInfo['carmi_data_extra'];
    $soft_user_info['reg_ip'] = $ip;
    $soft_user_info['reg_mac'] = $mac;
    $row = $db->insert('soft_user',$soft_user_info);
    if(!$row)return false;
    alterCarmiInfo(carmi_id: $carmiInfo['carmi_id'], key: 'carmi_status', value: '2');
    $userInfo = getUserId($row);
    return $userInfo;
}

/**
 * 读取用户信息(通过用户账号)
 * @param string $userAccount 用户账号/卡号
 * @param string $userPass 用户密码(留空可只通过账号查询,一般用于查询卡号)
 * @param bool $needPass 是否需要密码(特殊情况下使用,默认留空即可)
 * @return array|bool 用户信息数组 失败返回false
 */
function getUserAccount(string $userAccount,?string $userPass=null,?bool $needPass=true){
    global $db,$admin_id,$soft;
    $row = $db->find('soft_user','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'user_account'=>$userAccount]);
    if(!$row)return false;
    if($row['user_type']==0){
        if(!$userPass && $needPass){
            return false;
        }
    }
    $soft_user_info['user_id'] = $row['user_id'];
    $soft_user_info['user_type'] = $row['user_type'];
    $soft_user_info['user_account'] = $row['user_account'];
    $soft_user_info['user_pass'] = $row['user_pass'];
    $soft_user_info['user_status'] = $row['user_status'];
    $soft_user_info['endtime'] = $row['endtime'];
    $soft_user_info['point'] = $row['point'];
    $soft_user_info['opening'] = $row['opening'];
    $soft_user_info['bind'] = $row['bind'];
    $soft_user_info['unbind'] = $row['unbind'];
    $soft_user_info['data_extra'] = $row['data_extra'];
    $soft_user_info['data_cloud'] = $row['data_cloud'];
    $soft_user_info['reg_ip'] = $row['reg_ip'];
    $soft_user_info['reg_mac'] = $row['reg_mac'];
    $soft_user_info['reg_time'] = $row['reg_time'];
    $soft_user_info['login_time'] = $row['login_time'];
    $soft_user_info['heart_time'] = $row['heart_time'];
    return $soft_user_info;
}

/**
 * 读取用户信息(通过用户id)
 * @param int $userId 用户账号id
 * @return array|bool 用户信息数组 失败返回false
 */
function getUserId(int $userId){
    global $db,$admin_id,$soft;
    $row = $db->find('soft_user','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'user_id'=>$userId]);
    if(!$row)return false;
    $soft_user_info['user_id'] = $row['user_id'];
    $soft_user_info['user_type'] = $row['user_type'];
    $soft_user_info['user_account'] = $row['user_account'];
    $soft_user_info['user_pass'] = $row['user_pass'];
    $soft_user_info['user_status'] = $row['user_status'];
    $soft_user_info['endtime'] = $row['endtime'];
    $soft_user_info['point'] = $row['point'];
    $soft_user_info['opening'] = $row['opening'];
    $soft_user_info['bind'] = $row['bind'];
    $soft_user_info['unbind'] = $row['unbind'];
    $soft_user_info['data_extra'] = $row['data_extra'];
    $soft_user_info['data_cloud'] = $row['data_cloud'];
    $soft_user_info['reg_ip'] = $row['reg_ip'];
    $soft_user_info['reg_mac'] = $row['reg_mac'];
    $soft_user_info['reg_time'] = $row['reg_time'];
    $soft_user_info['login_time'] = $row['login_time'];
    $soft_user_info['heart_time'] = $row['heart_time'];
    return $soft_user_info;
}

/**
 * 读取用户信息(通过登录凭据)
 * @param string $cookie 登录凭据
 * @return array|bool 用户信息数组 失败返回false
 */
function getUserCookie(string $cookie){
    global $db,$admin_id,$soft,$clientid;
    $row = $db->find('soft_cookie','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'login_cookie'=>$cookie,'client_id'=>$clientid]);
    if(!$row)return false;
    $row = $db->find('soft_user','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'user_id'=>$row['user_id']]);
    if(!$row)return false;
    $soft_user_info['user_id'] = $row['user_id'];
    $soft_user_info['user_type'] = $row['user_type'];
    $soft_user_info['user_account'] = $row['user_account'];
    $soft_user_info['user_pass'] = $row['user_pass'];
    $soft_user_info['user_status'] = $row['user_status'];
    $soft_user_info['endtime'] = $row['endtime'];
    $soft_user_info['point'] = $row['point'];
    $soft_user_info['opening'] = $row['opening'];
    $soft_user_info['bind'] = $row['bind'];
    $soft_user_info['unbind'] = $row['unbind'];
    $soft_user_info['data_extra'] = $row['data_extra'];
    $soft_user_info['data_cloud'] = $row['data_cloud'];
    $soft_user_info['reg_ip'] = $row['reg_ip'];
    $soft_user_info['reg_mac'] = $row['reg_mac'];
    $soft_user_info['reg_time'] = $row['reg_time'];
    $soft_user_info['login_time'] = $row['login_time'];
    $soft_user_info['heart_time'] = $row['heart_time'];
    return $soft_user_info;
}

/**
 * 读取登录凭据信息
 * @param string $cookie 登录凭据
 * @return array|bool Cookie信息数组 失败返回false
 */
function getCookie(string $cookie){
    global $db,$admin_id,$soft;
    $row = $db->find('soft_cookie','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'login_cookie'=>$cookie]);
    if(!$row)return false;
    $soft_cookie_info['cookie_id'] = $row['cookie_id'];
    $soft_cookie_info['user_id'] = $row['user_id'];
    $soft_cookie_info['soft_version'] = $row['soft_version'];
    $soft_cookie_info['login_type'] = $row['login_type'];
    $soft_cookie_info['login_cookie'] = $row['login_cookie'];
    $soft_cookie_info['login_feature'] = $row['login_feature'];
    $soft_cookie_info['login_ip'] = $row['login_ip'];
    $soft_cookie_info['login_mac'] = $row['login_mac'];
    $soft_cookie_info['client_id'] = $row['client_id'];
    $soft_cookie_info['client_os'] = $row['client_os'];
    $soft_cookie_info['temp_data'] = $row['temp_data'];
    $soft_cookie_info['login_time'] = $row['create_time'];
    $soft_cookie_info['heartbeat_time'] = $row['update_time'];
    return $soft_cookie_info;
}

/**
 * 扣除用户点数和时间
 * @param int $type 扣除类型(0=点数 1=时间 2=同时扣除)
 * @param array $userInfo 用户信息
 * @param int $number 扣除数量(点数或者分钟数)[当type=2时,此处为扣除时间]
 * @param int $number2 扣除数量(扣除点数)[当type=2时此处生效]
 * @param string|null $reason 扣除原因
 * @return bool true 或 false
 */
function deductUserData(int $type,array $userInfo,int $number,?int $number2=0,?string $reason=null){
    global $db;
    if($type==1){
        //扣除时间
        $newEndtime = strtotime($userInfo['endtime']) - ($number*60);
        if($newEndtime<time())return false;
        $newEndtime = timetostr($newEndtime);
        $row = $db->update('soft_user',['endtime'=>$newEndtime],['user_id'=>$userInfo['user_id']]);
        if(!$row)return false;
        if($reason)$reason = "(理由:{$reason})";
        insertUserLog(user_id: $userInfo['user_id'], type: 4,logData: "扣除了{$number}分钟时间,剩余到期时间:{$newEndtime}{$reason}");
        return true;
    }elseif($type==0){
        //扣除点数
        $newPoint = $userInfo['point'] - $number;
        if($newPoint<0)return false;
        $row = $db->update('soft_user',['point'=>$newPoint],['user_id'=>$userInfo['user_id']]);
        if(!$row)return false;
        if($reason)$reason = "(理由:{$reason})";
        insertUserLog(user_id: $userInfo['user_id'], type: 4,logData: "扣除了{$number}点数,剩余点数:{$newPoint}{$reason}");
        return true;
    }elseif($type==2){
        //扣除点数和时间
        //[时间计算]
        $newEndtime = strtotime($userInfo['endtime']) - ($number*60);
        if($newEndtime<time())return false;
        //[点数计算]
        $newPoint = $userInfo['point'] - $number2;
        if($newPoint<0)return false;
        //[换算并保存]
        $newEndtime = timetostr($newEndtime);
        $row = $db->update('soft_user',['endtime'=>$newEndtime,'point'=>$newPoint],['user_id'=>$userInfo['user_id']]);
        if(!$row)return false;
        if($reason)$reason = "(理由:{$reason})";
        insertUserLog(user_id: $userInfo['user_id'], type: 4,logData: "扣除了{$number}分钟时间和{$number}点数,剩余时间:{$newEndtime},剩余点数:{$newPoint}{$reason}");
        return true;
    }
}

/**
 * 检查用户是否已到期(只检测用户的endtime)
 * @param array $userInfo 用户信息
 * @return bool true(未到期) 或 false(到期)
 */
function checkUserEndtime(array $userInfo){
    if(strtotime($userInfo['endtime'])<=time())return false;
    return true;
}

/**
 * 检查用户是否已到期(根据软件计费方式)
 * @param array $userInfo 用户信息
 * @return int 0未到期 1已到期 2点数不足 3已到期或点数不足
 */
function checkUserExpire(array $userInfo){
    global $soft;
    //计费方式 0免费 1计时收费 2计点收费 3混合收费(模式1) 4混合收费(模式2)
    if($soft['charge_type']==1){
        if(strtotime($userInfo['endtime']) > time())return 0;
        return 1;
    }
    if($soft['charge_type']==2){
        if($userInfo['point'] > 0)return 0;
        return 2;
    }
    if($soft['charge_type']==3){
        if($userInfo['point'] > 0 && strtotime($userInfo['endtime']) > time())return 0;
        return 3;
    }
    if($soft['charge_type']==4){
        if($userInfo['point'] > 0 || strtotime($userInfo['endtime']) > time())return 0;
        return 3;
    }
    return 0;
}

/**
 * 检查用户状态是否正常
 * @param array $userInfo 用户信息
 * @return int 0正常 1被封禁 2被冻结
 */
function checkUserStatus(array $userInfo){
    //1封禁 2冻结
    if($userInfo['user_status']==1)return 1;
    if($userInfo['user_status']==2)return 2;
    return 0;
}

/**
 * 检测剩余解绑次数
 * @param string $user_id 用户id
 * @param string $unbind 解绑次数
 * @return bool true(还有次数) 失败直接拦截返回
 */
function checkUnBind(string $user_id,string $unbind){
    global $db,$soft;
    //查询当天解绑数据
    $sql_day = "SELECT createdate FROM pre_soft_user_log WHERE type=1 and user_id={$user_id} and (create_time BETWEEN CONCAT(CURDATE(),' 00:00:00') AND CONCAT(CURDATE(),' 23:59:59'))";
    $n_day = $db->getCount($sql_day);
    //查询当周解绑数据
    $sql_week = "SELECT create_time as t FROM pre_soft_user_log WHERE type=1 and user_id={$user_id} and create_time>=date_sub(now(),interval DAYOFWEEK(now())-1 day) and create_time <= date_add(now(),interval 8-DAYOFWEEK(now()) day) group by create_time";
    $n_week = $db->getCount($sql_week);
    //查询当月解绑数据
    $sql_month = "SELECT create_time FROM pre_soft_user_log WHERE type=1 and user_id={$user_id} and MONTH(FROM_UNIXTIME(createdate,'%Y-%m-%d')) = MONTH(NOW())";
    $n_month = $db->getCount($sql_month);
    //查询总解绑数据
    $sql_count = "SELECT * FROM pre_soft_user_log WHERE type=1 and user_id={$user_id}";
    $n_count = $db->getCount($sql_count);
    if($unbind==''){
        $unbind = '-1|-1|-1|-1';
    }
    $number = explode('|',$unbind);
    //当天剩余次数计算
    if($number[0]<=$n_day && $number[0]!=-1){
        retOut(status: 'success', code: 335, msg: '解绑失败,今日解绑次数已达上限', soft: $soft);
    }
    //当周剩余次数计算
    if($number[1]<=$n_week && $number[1]!=-1){
        retOut(status: 'success', code: 336, msg: '解绑失败,本周解绑次数已达上限', soft: $soft);
    }
    //当月剩余次数计算
    if($number[2]<=$n_month && $number[2]!=-1){
        retOut(status: 'success', code: 337, msg: '解绑失败,当月解绑次数已达上限', soft: $soft);
    }
    //总共剩余次数计算
    if($number[3]<=$n_count && $number[3]!=-1){
        retOut(status: 'success', code: 338, msg: '解绑失败,该账户解绑次数已达上限', soft: $soft);
    }
    return true;
}

/**
 * 解绑特征信息(同时记录用户日志)
 * @param array $userInfo 用户信息数组
 * @param string $feature 特征信息(留空解绑全部)
 * @return int 0成功 或 1失败(账户剩余时间或点数不足) 2不存在此特征信息 3没有绑定任何特征信息
 */
function unBindFeature(array $userInfo,?string $feature=null){
    global $db,$soft;
    if($feature){
        $row_feature = $db->find('soft_user_feature','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id'],'user_id'=>$userInfo['user_id'],'feature'=>$feature]);
        if(!$row_feature){
            return 2;
        }
        $row = deductUserData(type: 2, userInfo: $userInfo, number: $soft['unbind_time'], number2: $soft['unbind_point']);
        if($row) {
            $db->delete('soft_user_feature', ['feature_id' => $row_feature['feature_id']]);
            insertUserLog(user_id: $userInfo['user_id'], type: 1, logData: "解除特征[{$feature}]的绑定");
            return 0;
        }
        return 1;
    }else{
        //解除所有特征绑定
        $count = $db->count('soft_user_feature',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id'],'user_id'=>$userInfo['user_id']]);
        if($count<=0){
            return 3;
        }
        $row = deductUserData(type: 2, userInfo: $userInfo, number: $soft['unbind_time'] * $count, number2: $soft['unbind_point'] * $count);
        if($row) {
            $db->delete('soft_user_feature',['soft_id'=>$soft['soft_id'],'create_user_id'=>$soft['create_user_id'],'user_id'=>$userInfo['user_id']]);
            insertUserLog(user_id: $userInfo['user_id'], type: 1, logData: "解除所有绑定的特征");
            return 0;
        }
        return 1;
    }
}

/**
 * 检测用户是否绑定了特征信息(自动检测软件是否开启了绑定特征信息)
 * @param string $userId 用户id
 * @param string $feature 特征信息
 * @return bool true 或 false
 */
function checkBindFeature(string $userId,?string $feature=null){
    global $db,$admin_id,$soft;
    if($soft['bind_type']){
        if($feature){
            $row_feature = $db->find('soft_user_feature','*',['create_user_id'=>$admin_id,'soft_id'=>$soft['soft_id'],'user_id'=>$userId,'feature'=>$feature]);
            if(!$row_feature)return false;
            return true;
        }
        return false;
    }
    return true;
}

/**
 * 绑定特征信息(自动检测软件是否开启了绑定特征信息)
 * @param array $userInfo 用户信息
 * @param string $feature 特征信息
 * @return int 0成功 1绑定已达上限 2特征信息已存在 3特征信息为空
 */
function bindFeature(array $userInfo,?string $feature=null){
    global $db,$admin_id,$soft;
    if($soft['bind_type']){
        //检测绑定是否已存在
        if($feature){
            $row_feature = $db->find('soft_user_feature','*',['create_user_id'=>$admin_id,'soft_id'=>$soft['soft_id'],'user_id'=>$userInfo['user_id'],'feature'=>$feature]);
            if(!$row_feature){
                //检测绑定数量是否已上限
                $row_count = $db->count('soft_user_feature',['create_user_id'=>$admin_id,'soft_id'=>$soft['soft_id'],'user_id'=>$userInfo['user_id']]);
                if($row_count>=$userInfo['bind'])return 1;
                $db->insert('soft_user_feature',['create_user_id'=>$admin_id,'soft_id'=>$soft['soft_id'],'user_id'=>$userInfo['user_id'],'feature'=>$feature]);
                insertUserLog(user_id: $userInfo['user_id'], type: 3,logData: "绑定了新特征[{$feature}]");
                return 0;
            }
        }else{
            return 3;
        }
    }
    return 0;
}

/**
 * 解绑特征信息(不计算解绑扣除时间或点数同时也不记录用户日志)
 * @param array $userInfo 用户信息
 * @param string $feature 特征信息(留空解绑所有)
 */
function unBindFeature_2(array $userInfo,?string $feature=null){
    global $db,$admin_id,$soft;
    if($feature){
        $db->delete('soft_user_feature',['create_user_id'=>$admin_id,'soft_id'=>$soft['soft_id'],'user_id'=>$userInfo['user_id'],'feature'=>$feature]);
    }else{
        $db->delete('soft_user_feature',['create_user_id'=>$admin_id,'soft_id'=>$soft['soft_id'],'user_id'=>$userInfo['user_id']]);
    }
}

/**
 * 检测用户是否在线
 * @param string $userAccount 用户账号
 * @param string $cookie 登录凭据
 * @return array 成功返回Cookie凭据信息数组 失败直接拦截返回原因
 */
function checkOnlie(string $userAccount,string $cookie){
    global $db,$admin_id,$soft,$feature,$clientid;
    //通过登录账号,凭据,特征,客户端id 四个要素进行验证是否在线
    if(!$cookie)retOut(status: 'success', code: 250, msg: '登录凭据不存在,请重新登录', soft: $soft);
    $row_cookie = $db->find('soft_cookie','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'login_account'=>$userAccount,'login_cookie'=>$cookie,'login_feature'=>$feature,'client_id'=>$clientid]);
    if(!$row_cookie)retOut(status: 'success', code: 250, msg: '登录凭据已过期,请重新登录', soft: $soft);
    //检测心跳是否超时
    if(time() - strtotime($row_cookie['heart_time']) > $soft['soft_jump']){
        $db->delete('soft_cookie',['cookie_id'=>$row_cookie['cookie_id']]);
        retOut(status: 'success', code: 250, msg: '登录凭据已过期,请重新登录', soft: $soft);
    }
    //检测软件是否开启绑定并且绑定了特征
    if(!checkBindFeature(userId: $row_cookie['user_id'], feature: $feature)){
        $db->delete('soft_cookie',['cookie_id'=>$row_cookie['cookie_id']]);
        retOut(status: 'success', code: 251, msg: '绑定特征信息不存在,请重新登录', soft: $soft);
    }
    //获取用户信息
    $row_user = getUserId(userId: $row_cookie['user_id']);
    if(!$row_user)retOut(status: 'success', code: 252, msg: '用户不存在,请重新登录', soft: $soft);
    //检测用户状态
    //0正常 1被封禁 2被冻结
    $u = checkUserStatus(userInfo: $row_user);
    if($u==1)retOut(status: 'success', code: 253, msg: '用户已被封禁,请重新登录', soft: $soft);
    if($u==2)retOut(status: 'success', code: 254, msg: '用户已被冻结,请重新登录', soft: $soft);
    //检测用户是否已到期(根据软件计费方式来判断)
    //0未到期 1已到期 2点数不足 3已到期或点数不足
    $u = checkUserExpire(userInfo: $row_user);
    if($u==1)retOut(status: 'success', code: 255, msg: '用户已过期,请重新登录', soft: $soft);
    if($u==2)retOut(status: 'success', code: 256, msg: '用户点数不足,请重新登录', soft: $soft);
    if($u==3)retOut(status: 'success', code: 257, msg: '用户已到期或点数不足,请重新登录', soft: $soft);
    //验证通过
    return $row_cookie;
}

/**
 * 检测用户通道在线是否达到上限(根据软件设定的通道模式来)
 * @param array $userInfo 用户信息
 * @return bool true(未达到上限) 或 false(已达到上限)
 */
function checkOpening(array $userInfo){
    global $db,$admin_id,$soft,$feature;
    //单通道+绑定特征：每个特征通道数量
    //单通道+不绑定特征：账号总通道数量
    //账号总通道+绑定特征：账号总通道数量
    //账号总通道+不绑定特征：账号总通道数量
    //通道模式 0单绑定通道(必须开启特征绑定) 1总通道
    if($soft['open_type']==0 && $soft['bind_type']){
        //检测绑定特征的登录数量
        $row_cookie = $db->count('soft_cookie',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'user_id'=>$userInfo['user_id'],'login_feature'=>$feature]);
        //检测是否超过用户通道上限
        if($row_cookie>=$userInfo['opening'])return false;
        return true;
    }else{
        //检测账号总的登录数量
        $row_cookie = $db->count('soft_cookie',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'user_id'=>$userInfo['user_id']]);
        //检测是否超过用户通道上限
        if($row_cookie>=$userInfo['opening'])return false;
        return true;
    }
    return true;
}

/**
 * 新增一条Cookie凭据信息
 * @param array $userInfo 用户信息
 * @return array|bool Cookie凭据信息 失败返回false
 */
function insertCookie(array $userInfo){
    global $db,$admin_id,$soft,$version,$feature,$ip,$mac,$clientid,$clientos;
    $insert['create_user_id'] = $admin_id;
    $insert['soft_id'] = $soft['soft_id'];
    $insert['user_id'] = $userInfo['user_id'];
    $insert['soft_version'] = $version;
    $insert['login_account'] = $userInfo['user_account'];
    $insert['login_type'] = $userInfo['user_type'];
    $insert['login_cookie'] = createStr(25,0,1);
    $insert['login_feature'] = $feature;
    $insert['login_ip'] = $ip;
    $insert['login_mac'] = $mac;
    $insert['client_os'] = $clientos;
    $insert['client_id'] = $clientid;
    $insert['soft_jump'] = $soft['soft_jump'];
    $row = $db->insert('soft_cookie',$insert);
    if(!$row)return false;
    $row_cookie = $db->find('soft_cookie','*',['cookie_id'=>$row]);
    unset($row_cookie['create_user_id']);
    return $row_cookie;
}

/**
 * 删除最老生成的Cookie凭据信息
 * @param int $user_id 用户信息
 * @return bool true(删除成功) 或 false(删除失败)
 */
function deleteCookie(int $user_id,?string $feature=null,?string $cookie=null){
    global $db,$admin_id,$soft,$account,$clientid;
    if($cookie){
        $s = $db->delete('soft_cookie',['login_cookie'=>$cookie,'client_id'=>$clientid,'soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'login_account'=>$account]);
        if(!$s)return false;
        insertUserLog(user_id: $user_id, type: 5,logData: "退出了登录,删除Cookie值[{$cookie}]");
        return true;
    }
    if($soft['open_type']==0 && $soft['bind_type']){
        //检测绑定特征的最老登录的凭据信息
        $row_cookie = $db->find('soft_cookie','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'login_account'=>$account,'user_id'=>$user_id,'login_feature'=>$feature],'login_time');
        if(!$row_cookie)return true;
        $s = $db->delete('soft_cookie',['cookie_id'=>$row_cookie['cookie_id']]);
        if(!$s)return false;
        insertUserLog(user_id: $user_id, type: 5,logData: "退出了登录,删除Cookie值[{$row_cookie['login_cookie']}]");
        return true;
    }else{
        //检测账号的最老登录的凭据信息
        $row_cookie = $db->find('soft_cookie','*',['soft_id'=>$soft['soft_id'],'create_user_id'=>$admin_id,'login_account'=>$account,'user_id'=>$user_id],'login_time');
        if(!$row_cookie)return true;
        $s = $db->delete('soft_cookie',['cookie_id'=>$row_cookie['cookie_id']]);
        if(!$s)return false;
        insertUserLog(user_id: $user_id, type: 5,logData: "退出了登录,删除Cookie值[{$row_cookie['login_cookie']}]");
        return true;
    }
}

/**
 * 新增一条用户日志
 * @param string $user_id 用户id
 * @param int $type 日志类型
 * @param string $logData 日志内容
 * @return bool true(成功) 或 false(失败)
 */
function insertUserLog(string $user_id,int $type,string $logData){
    global $db,$soft,$ip,$mac,$ver;
    $row = getUserId(userId: $user_id);
    $insert['create_user_id'] = $soft['create_user_id'];
    $insert['soft_id'] = $soft['soft_id'];
    $insert['user_id'] = $user_id;
    $insert['log_type'] = $type;
    $insert['log_data'] = $logData;
    $insert['log_ip'] = $ip;
    $insert['log_mac'] = $mac;
    $insert['soft_ver'] = $ver;
    $insert['user_endtime'] = $row['endtime'];
    $insert['user_point'] = $row['point'];
    $row = $db->insert('soft_user_log',$insert);
    if(!$row)return false;
    return true;
}

?>