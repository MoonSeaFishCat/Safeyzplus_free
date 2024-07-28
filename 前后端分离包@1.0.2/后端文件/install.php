<?php
error_reporting(0);
// 检查PHP是否安装了指定的扩展
function is_extension_installed($extension) {
    // 检查扩展是否在已安装扩展列表中
    if (extension_loaded($extension)) {
        return true;
    } else {
        return false;
    }
}

if(@$_GET['do'] == 'php'){
    phpinfo();
    exit();
}

$http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
$url=$http_type.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?do=php';
$Body=file_get_contents($url);

//判断操作系统
preg_match_all('/<tr><td class="e">System\b[ \t]*<\/td>[^\r\n]+/i', $Body, $result);
if(!$result[0])exit('未获取到数据!');
preg_match_all('/\bWindows\b/i', $result[0][0], $result);
if($result[0]){
	$System='Windows';
}else{
	$System='Linux';
}

//判断PHP版本
preg_match_all('/<h1 class="p">PHP Version [\d.]+<\/h1>/i', $Body, $result);
preg_match_all('/\d+\.\d+(?=\.)/i', $result[0][0], $result);
$phpver=$result[0][0];

//判断PHP架构
preg_match_all('/<tr><td class="e">Architecture\b[ \t]*<\/td>[^\r\n]+/i', $Body, $result);
preg_match_all('/>x86\b/i', $result[0][0], $result);
$x86=($result[0])?1:0;
preg_match_all('/<tr><td class="e">Architecture\b[ \t]*<\/td>[^\r\n]+/i', $Body, $result);
preg_match_all('/>x64\b/i', $result[0][0], $result);
$x64=($result[0])?1:0;

if($x86){
	$Architecture='x86';
	$Architecture_='x86(32位)';
}else if($x64){
	$Architecture='x64';
	$Architecture_='x64(64位)';
}else{	//有的PHP版本中没有该项(如有CentOS系统中的PHP7.0版本没有该项，x86-64需要用64位的扩展)
	if($phpver*1 >= 7){
		$Architecture='x64';
		$Architecture_='x64(64位)';
	}else{
		$Architecture='x86';
		$Architecture_='x86(32位)';
	}
}

//判断PHP线程安全
preg_match_all('/<tr><td class="e">Thread Safety\b[ \t]*<\/td>[^\r\n]+/i', $Body, $result);
preg_match_all('/>enabled\b/i', $result[0][0], $result);
if($result[0]){
	$Thread='ts';
}else{
	$Thread='nts';
}

//判断扩展存放路径
//<tr><td class="e">extension_dir</td><td class="v">D:\phpStudy\PHPTutorial\php\php-5.5.38\ext</td><td class="v">D:\phpStudy\PHPTutorial\php\php-5.5.38\ext</td></tr>
preg_match_all('/<tr><td class="e">extension_dir[ \t]*<\/td><td\b[^\r\n]+?(?=<\/td>)/i', $Body, $result);
$extpath=preg_replace('/\bextension_dir\b[ \t]*/i','',$result[0][0]);
$extpath=preg_replace('/<[^>]+>/i','',$extpath);

//判断php.ini位置
preg_match_all('/<tr><td class="e">Loaded Configuration File[ \t]*<\/td>[^\r\n]+/i', $Body, $result);
$phpini=preg_replace('/\bLoaded Configuration File\b[ \t]*/i','',$result[0][0]);
$phpini=preg_replace('/<[^>]+>/i','',$phpini);

if($phpver*1 >= 7){
	if($System=='Windows'){
		$Ext="XLoader_Win_php" . $phpver . "_" . $Thread . "_" . $Architecture . ".dll";
	}else{
		$Ext="XLoader_Lin_php" . $phpver . "_" . $Architecture . ".so";
	}
	$ExtLink="http://soft.phpxload.com/ext/ExtDown.asp?e=ExtCheck&r=" . $Ext;
}else{
	$ExtLink="javascript:alert('适用于PHP5.X的XLoad扩展需要进入官网下载中心进行下载。');";
}

if(PHP_VERSION<8.0){
    $PHP_Ver = 'PHP版本检测 <b><span style="color:red">[不通过]</span> </b>PHP版本不可小于8.0';
}else{
    $PHP_Ver = 'PHP版本检测 <b><span style="color:blue">[通过]</span></b> ，当前版本：'.PHP_VERSION;
}

$extensionToCheck = 'xload'; // 要检查的扩展名称
if (is_extension_installed($extensionToCheck)) {
    $toCheck = "<b style='color:blue'>已安装</b>";
} else {
    $toCheck = "<b style='color:red'>未安装</b>";
}
$toCheck = "<b style='color:#9F35FF'>无需安装</b>";
?>

<html><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>安全宝旗舰版安装助手</title>
</head>
<body>
<style type="text/css">
.DownTB{
	background:#c3dbff;
	border:1px #9ed0ae solid;
	border-collapse:collapse;
}
.DownTB TD{
	color:#187937;
	text-align:center;
	border:1px #bdd2c2 dashed;
}
.DownTB .D_LIN1{
	color:#777777;
	background:#e9f4f7;
}
.DownTB .D_LIN2{
	color:#777777;
	background:#d3e9ef;
}
.hei {color:#333333;}
</style>
<table width="80%" align="center" class="DownTB" border="0" cellspacing="0" cellpadding="5">
	<tr>
		<td width="25%"><b class="hei">操作系统 </b></td>
		<td><b class="hei">PHP版本</b></td>
		<td><b class="hei">PHP架构</b></td>
		<td><b class="hei">线程安全</b></td>
	</tr>
	<tr class="D_LIN1">
		<td><?=$System?></td>
		<td><?=$phpver?></td>
		<td><?=$Architecture_?></td>
		<td><?=$Thread?></td>
	</tr>
</table>
<br>
<table width="80%" align="center" class="DownTB" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td><b class="hei">PHP版本检测</b></td>
    </tr>
    <tr class="D_LIN1">
        <td><?=$PHP_Ver?></td>
    </tr>
</table>
<br>
<table width="80%" align="center" class="DownTB" border="0" cellspacing="0" cellpadding="5">
    <tr class="D_LIN1">
        <td width="25%"><b class="hei">安装检测</b></td>
        <td style="text-align:left;padding-left:10px"><?=$toCheck?></td>
    </tr>
	<tr class="D_LIN1">
		<td><b class="hei">XLoad 扩展下载</b></td>
		<td style="text-align:left;padding-left:10px"><a href="<?=$ExtLink?>" target="\_blank">点此下载</a></td>
	</tr>
	<tr class="D_LIN1">
		<td><b class="hei">扩展存放路径</b></td>
		<td style="text-align:left;padding-left:10px"><?=$extpath?></td>
	</tr>
	<tr class="D_LIN1">
		<td><b class="hei">配置文件(php.ini)</b></td>
		<td style="text-align:left;padding-left:10px"><?=$phpini?></td>
	</tr>
    <tr class="D_LIN1">
        <td><b class="hei">扩展安装方法</b></td>
        <td style="text-align:left;padding-left:10px">1.打开php.ini配置文件<br>2.在文件末尾处填写：extension=<?=$Ext?><br>3.然后保存重启PHP</td>
    </tr>
</table>
<br>
<table width="80%" align="center" class="DownTB" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td><b class="hei">Nginx伪静态设置<code style="color:red">（使用整合包安装的用户请无视此条）</code></b></td>
    </tr>
    <tr class="D_LIN1">
        <td style="text-align:left;padding-left:10px">location / { <br>
            &nbsp;&nbsp;&nbsp;&nbsp;rewrite ^/f/(.*) /dnld.php?file=$1 last; <br>
            &nbsp;&nbsp;&nbsp;&nbsp;rewrite ^/sapi/(.*) /web/$1.php last; <br>
            &nbsp;&nbsp;&nbsp;&nbsp;rewrite ^/api/(.*) /api/$1.php last; <br>
            }</td>
    </tr>
</table>
<br>
<table width="80%" align="center" class="DownTB" border="0" cellspacing="0" cellpadding="5">
    <tr>
        <td><b class="hei">数据库安装/导入</b></td>
    </tr>
    <tr class="D_LIN1">
        <td style="text-align:left;padding-left:10px">
			<li>MySQL数据库版本需在8.x以上</li>
            <li>在下载的安装包内找到install.sql文件</li>
            <li>导入install.sql文件到你的MySQL数据库内</li>
            <li>配置includes/db.config.php文件内的数据库信息</li>
			<hr><code style="color:red">如果您使用的是5.x的数据库,需自行手动转换一下安装语句（您也可以使用其他类型的数据库,只要支持PDO连接）</code>
        </td>
    </tr>
</table>
<body>
<html>