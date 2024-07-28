<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

function generate(int $length=8) {
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

$addsl = intval($arr['addCount']) ? intval($arr['addCount']) : 1;
$carmiNotes = $arr['carmitNotes'];
#获取卡种id
$carmitId = intval($arr['carmitId']);
#获取卡种信息
$row = $db->find('soft_carmit','*',['carmit_id'=>$carmitId,'create_user_id'=>$user_info['user_id']]);
if(!$row)exJson(1,'不存在此卡种');

#添加归属UserId(作者id)
$saveData['create_user_id'] = $user_info['user_id'];

#生成卡数据
$saveData['soft_id'] = $row['soft_id'];
$saveData['soft_carmit_id'] = $carmitId;
$saveData['carmi_name'] = $row['carmit_name'];
$saveData['carmi_time'] = $row['carmit_time'];
$saveData['carmi_point'] = $row['carmit_point'];
$saveData['carmi_opening'] = $row['carmit_opening'];
$saveData['carmi_bind'] = $row['carmit_bind'];
$saveData['carmi_unbind'] = $row['carmit_unbind'];
$saveData['carmi_data_extra'] = $row['carmit_data_extra'];
$saveData['carmi_notes'] = $carmiNotes ? $carmiNotes : $row['carmit_notes'];
#制卡批次号
$saveData['carmi_pch'] = date("Ymd-His").mt_rand(10,99);
#卡状态
$saveData['carmi_status'] = 0;
#制卡价格
$saveData['making_money'] = $row['carmit_money'];
#制卡人id
$saveData['making_user_id'] = $user_info['user_id'];

for($i=0; $i<$addsl; $i++){
    #生成充值卡号
    $saveData['carmi_str'] = $row['carmit_prefix'].generate($row['carmit_length']);
    $db->insert('soft_carmi',$saveData);
}

exJson(0,'操作成功');
?>