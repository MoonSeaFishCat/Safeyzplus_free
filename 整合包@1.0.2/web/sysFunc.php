<?php
/**
 * 文件名：系统内置函数
 * 更新时间：2024-1-7 23:46
 */

/** 查询系统字典值 */
function getDictionaryValue(string $code,string $code_value){
    global $db;
    $row = $db->find('dictionary','*',['dict_code'=>$code]);
    if($row){
        $row_data = $db->find('dictionary_data','*',['dict_id'=>$row['dict_id'],'dict_data_code'=>$code_value]);
        if($row_data){
            return $row_data['dict_data_name'];
        }
        return null;
    }
    return null;
}

/** 查询系统字典标签颜色 */
function getDictionaryTagColor(string $code,string $code_value){
    global $db;
    $row = $db->find('dictionary','*',['dict_code'=>$code]);
    if($row){
        $row_data = $db->find('dictionary_data','*',['dict_id'=>$row['dict_id'],'dict_data_code'=>$code_value]);
        if($row_data){
            return $row_data['tag_color'];
        }
        return null;
    }
    return null;
}

/** 查询系统字典标签名称 */
function getDictionaryTagName(string $code,string $code_value){
    global $db;
    $row = $db->find('dictionary','*',['dict_code'=>$code]);
    if($row){
        $row_data = $db->find('dictionary_data','*',['dict_id'=>$row['dict_id'],'dict_data_code'=>$code_value]);
        if($row_data){
            return $row_data['tag_dict_data_name'];
        }
        return null;
    }
    return null;
}

/** 插入一条代理日志 */
function insertAgentLog(int $createUserId,int $agentId,string $money,string $consume,int $logType,string $log,string $rebate=null){
    global $db;
    $insertData = array(
        'create_user_id' => $createUserId,
        'agent_id' => $agentId,
        'money' => $money,
        'consume' => $consume,
        'rebate' => $rebate,
        'log_type' => $logType,
        'log' => $log,
        'ip' => getIp()
    );
    $db->insert('agent_log',$insertData);
}

?>