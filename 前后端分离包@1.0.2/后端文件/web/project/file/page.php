<?php
include('../../common.php');
include('../../checkLogin.php');
include('../../checkPower.php');

#检测访问权限
@checkPower('pjc:file:list');

$page = filterArr($_GET['page']);
$pageSize = filterArr($_GET['limit']);
$limit = [($page-1)*$pageSize,$pageSize];

$name = filterArr($_GET['name']);
$path = filterArr($_GET['path']);
$createNickname = filterArr($_GET['createNickname']);
if($name)$where['name']=$name;
if($path)$where['path']=$path;
if($createNickname)$where['nickname']=$createNickname;

#添加归属UserId(作者id)
$where['a.create_user_id'] = $user_info['user_id'];

$where['deleted'] = 0;
$count = $db->getCount("select a.*,b.nickname from pre_file_record as a left join pre_user as b on a.create_user_id=b.user_id".whereStr($where));
$datalist_ret['count'] = $count;
if(!$count){
    $datalist_ret['list'] = [];
    exJson(0,'操作成功',$datalist_ret);
}

#获取域名,并组成下载链接前缀
$url  = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
$url .= "://" . $_SERVER['SERVER_NAME'];
$url_upload = $url."/sapi/file/show?path=";

$res = $db->getAll("select a.*,b.nickname,b.username from pre_file_record as a left join pre_user as b on a.create_user_id=b.user_id".whereStr($where)." limit ".($page - 1) * $pageSize.",".$pageSize);
foreach ($res as $value){
    $datainfo = array();
    $datainfo['id'] = $value['id'];
    $datainfo['name'] = $value['name'];
    $datainfo['path'] = $value['path'];
    $datainfo['length'] = $value['length'];
    $datainfo['contentType'] = $value['contentType'];
    $datainfo['comments'] = $value['comments'];
    $datainfo['createUserId'] = $value['create_user_id'];
    $datainfo['createTime'] = $value['create_time'];
    $datainfo['updateTime'] = $value['update_time'];
    $datainfo['url'] = $url_upload.$value['path'];
    $datainfo['thumbnail'] = $url_upload.$value['path'];
    $datainfo['downloadUrl'] = $value['durl'];
    $datainfo['createUsername'] = $value['username'];
    $datainfo['createNickname'] = $value['nickname'];
    $datalist[] = $datainfo;
}
$datalist_ret['list'] = $datalist;
exJson(0,'操作成功',$datalist_ret);

?>