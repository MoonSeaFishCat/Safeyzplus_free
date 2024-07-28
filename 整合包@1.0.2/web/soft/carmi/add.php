<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

function generate($length=8) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $password = "";
    for($i=0;$i<$length;$i++)
    {
        $password .= $chars[mt_rand(0,strlen($chars)-1)];
    }
    return $password;
}

#检测访问权限
@checkPower('soft:carmi:save');

if(!$arr['softId'])exJson(1,'请选择充值卡所属软件');
if(!$arr['carmitName'])exJson(1,'请输入充值卡名称');

$addsl = intval($arr['addCount']) ? intval($arr['addCount']) : 1;
$carmiNotes = $arr['carmitNotes'];

#生成卡数据
$saveData['soft_id'] = $arr['softId'];
$saveData['carmi_name'] = $arr['carmitName'];
$saveData['carmi_time'] = $arr['carmitTime'] ? $arr['carmitTime'] : '0';
$saveData['carmi_point'] = $arr['carmitPoint'] ? $arr['carmitPoint'] : '0';
$saveData['carmi_opening'] = $arr['carmitOpening'] ? $arr['carmitOpening'] : 1;
$saveData['carmi_bind'] = $arr['carmitBind'] ? $arr['carmitBind'] : 1;
$saveData['carmi_unbind'] = $arr['carmitUnbind'] ? $arr['carmitUnbind'] : '-1|-1|-1|-1';
$saveData['carmi_data_extra'] = $arr['carmitDataExtra'];
$saveData['carmi_notes'] = $carmiNotes ? $carmiNotes : $row['carmitNotes'];
#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

$carmiLength = $arr['carmitLength'] ? $arr['carmitLength'] : 12;

#制卡批次号
$saveData['carmi_pch'] = date("Ymd-His").mt_rand(10,99);
#卡状态
$saveData['carmi_status'] = 0;
#制卡价格
$saveData['making_money'] = $arr['carmitMoney'];
#制卡人id
$saveData['making_user_id'] = $user_info['user_id'];

for($i=0; $i<$addsl; $i++){
    #生成充值卡号
    $saveData['carmi_str'] = $arr['carmitPrefix'].generate($carmiLength);
    $db->insert('soft_carmi',$saveData);
}

exJson(0,'操作成功');
?>