-- --------------------------------------------------------
-- 主机:                           127.0.0.1
-- 服务器版本:                        8.2.0 - MySQL Community Server - GPL
-- 服务器操作系统:                      Linux
-- HeidiSQL 版本:                  12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- 导出  表 safeyz_t.b2_agent_carmit 结构
DROP TABLE IF EXISTS `b2_agent_carmit`;
CREATE TABLE IF NOT EXISTS `b2_agent_carmit` (
  `id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `agent_id` int NOT NULL COMMENT '代理id(User表)',
  `carmit_id` int NOT NULL COMMENT '卡种id(SoftCarmit表)',
  `carmit_money` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0.00' COMMENT '卡种价格',
  `notes` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '备注信息',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_agent_carmit 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_agent_log 结构
DROP TABLE IF EXISTS `b2_agent_log`;
CREATE TABLE IF NOT EXISTS `b2_agent_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `agent_id` int NOT NULL COMMENT '代理id(User表)',
  `ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `log_type` int NOT NULL COMMENT '0账户消费 1下级提成 2退卡返还 3后台加款 4在线充值',
  `log` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  `money` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `consume` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `rebate` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_agent_log 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_agent_notice 结构
DROP TABLE IF EXISTS `b2_agent_notice`;
CREATE TABLE IF NOT EXISTS `b2_agent_notice` (
  `notice_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `notice_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notice_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_agent_notice 的数据：~3 rows (大约)
INSERT INTO `b2_agent_notice` (`notice_id`, `create_user_id`, `notice_title`, `notice_info`, `create_time`, `update_time`) VALUES
	(3, 1, '🔈测试Markdown公告标题测试Markdown公告标题测试Markdown公告标题', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 07:16:45', '2024-01-15 11:21:56'),
	(4, 1, '测试代理公告2测试代理公告2测试代理公告2测试代理公告2', '> 哈哈哈哈哈哈哈哈哈哈哈哈哈\n> dsada', '2024-01-15 07:33:30', '2024-01-15 11:20:43'),
	(5, 1, '测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3', '测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3测试代理公告3', '2024-01-15 11:21:45', '2024-01-15 11:21:45');

-- 导出  表 safeyz_t.b2_dictionary 结构
DROP TABLE IF EXISTS `b2_dictionary`;
CREATE TABLE IF NOT EXISTS `b2_dictionary` (
  `dict_id` int NOT NULL AUTO_INCREMENT COMMENT '字典id',
  `dict_code` varchar(100) NOT NULL COMMENT '字典标识',
  `dict_name` varchar(200) NOT NULL COMMENT '字典名称',
  `sort_number` int NOT NULL DEFAULT '1' COMMENT '排序号',
  `comments` varchar(400) DEFAULT NULL COMMENT '备注',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`dict_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='字典';

-- 正在导出表  safeyz_t.b2_dictionary 的数据：~28 rows (大约)
INSERT INTO `b2_dictionary` (`dict_id`, `dict_code`, `dict_name`, `sort_number`, `comments`, `create_time`, `update_time`) VALUES
	(1, 'sex', '性别', 1, '1', '2020-03-15 05:04:39', '2023-11-11 15:54:56'),
	(3, 'soft_status', '运营状态', 2, '', '2023-11-14 16:53:54', '2023-12-06 14:53:42'),
	(5, 'soft_open_type', '通道模式', 4, '', '2023-11-15 12:47:20', '2023-12-24 13:13:56'),
	(6, 'soft_bind_type', '绑定方式', 4, '', '2023-11-15 12:48:33', '2023-12-06 14:52:01'),
	(7, 'soft_reg_type', '注册方式', 5, '', '2023-11-15 12:50:22', '2023-12-06 14:52:04'),
	(8, 'soft_unbinds_switch', '自动解绑', 6, '', '2023-11-15 12:50:51', '2024-01-29 04:25:23'),
	(9, 'soft_login_type', '登录方式', 3, '', '2023-11-15 12:51:06', '2023-12-13 09:50:56'),
	(10, 'soft_charge_type', '运营模式', 2, '', '2023-11-15 12:51:28', '2023-12-13 09:50:41'),
	(11, 'soft_endata_type', '数据加密', 9, '', '2023-11-15 12:51:40', '2023-12-06 14:52:19'),
	(12, 'soft_sign_type', '签名校验', 10, '', '2023-11-15 12:52:01', '2023-12-06 14:52:24'),
	(13, 'soft_md5_type', '摘要校验', 11, '', '2023-11-15 12:52:45', '2023-12-06 14:52:29'),
	(14, 'soft_reg_give', '注册赠送', 12, '', '2023-11-15 12:53:05', '2023-12-06 14:52:35'),
	(15, 'soft_reg_give_limit', '赠送限制', 13, '', '2023-11-15 12:53:36', '2023-12-06 14:52:38'),
	(16, 'soft_trial_type', '试用开关', 14, '', '2023-11-15 12:53:57', '2023-12-06 14:52:42'),
	(17, 'soft_gxfs', '更新方式', 15, '版本更新方式', '2023-12-05 14:01:32', '2023-12-06 14:52:47'),
	(18, 'soft_user_status', '账户状态', 15, '', '2023-12-06 14:48:35', '2023-12-06 14:52:54'),
	(19, 'soft_user_type', '账户类型', 16, '', '2023-12-06 15:00:55', '2023-12-06 15:00:55'),
	(21, 'carmi_status', '充值卡状态', 20, '', '2023-12-14 04:48:24', '2023-12-14 13:38:12'),
	(22, 'endtime_status', '计时状态', 20, '软件用户计时状态', '2023-12-22 07:58:52', '2023-12-25 06:32:21'),
	(27, 'agent_log_type', '代理日志(明细)', 60, '', '2024-01-09 11:36:20', '2024-01-09 11:36:20'),
	(28, 'soft_variable_type', '变量获取类型', 100, '', '2024-01-16 09:47:07', '2024-02-01 14:11:18'),
	(29, 'soft_login_force_type', '顶号登录', 4, '', '2024-01-24 04:23:06', '2024-01-24 04:24:09'),
	(30, 'soft_unbinds_switch_1', '解绑(指定)', 7, '', '2024-01-29 04:25:45', '2024-01-29 04:26:05'),
	(31, 'soft_unbinds_switch_2', '解绑(全部)', 7, '', '2024-01-29 04:25:58', '2024-01-29 04:25:58'),
	(32, 'soft_user_log_type', '用户日志类型', 200, '', '2024-01-29 05:11:04', '2024-02-01 05:43:49'),
	(33, 'soft_variable_del_type', '变量接口删除', 102, '', '2024-02-01 05:43:35', '2024-02-01 15:15:17'),
	(34, 'soft_variable_alter_type', '变量接口修改', 101, '', '2024-02-01 15:15:13', '2024-02-01 15:15:13'),
	(36, 'top', '置顶', 0, '', '2024-02-14 14:25:13', '2024-02-14 14:25:27');

-- 导出  表 safeyz_t.b2_dictionary_data 结构
DROP TABLE IF EXISTS `b2_dictionary_data`;
CREATE TABLE IF NOT EXISTS `b2_dictionary_data` (
  `dict_data_id` int NOT NULL AUTO_INCREMENT COMMENT '字典项id',
  `dict_id` int NOT NULL COMMENT '字典id',
  `dict_data_code` varchar(100) NOT NULL COMMENT '字典项标识',
  `dict_data_name` varchar(200) NOT NULL COMMENT '字典项名称',
  `sort_number` int NOT NULL DEFAULT '1' COMMENT '排序号',
  `tag_dict_data_name` varchar(200) DEFAULT NULL COMMENT '标签显示',
  `tag_color` varchar(200) DEFAULT NULL COMMENT '色彩标签',
  `comments` varchar(400) DEFAULT NULL COMMENT '备注',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`dict_data_id`) USING BTREE,
  KEY `dict_id` (`dict_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='字典项';

-- 正在导出表  safeyz_t.b2_dictionary_data 的数据：~81 rows (大约)
INSERT INTO `b2_dictionary_data` (`dict_data_id`, `dict_id`, `dict_data_code`, `dict_data_name`, `sort_number`, `tag_dict_data_name`, `tag_color`, `comments`, `create_time`, `update_time`) VALUES
	(1, 1, '1', '男', 1, NULL, '', NULL, '2020-03-15 05:07:28', '2023-12-13 08:58:03'),
	(2, 1, '2', '女', 2, NULL, NULL, NULL, '2020-03-15 05:07:41', '2022-03-11 14:46:25'),
	(7, 3, '0', '正常', 1, '正常', 'info', '', '2023-11-14 16:54:16', '2023-12-13 09:16:10'),
	(8, 3, '1', '维护', 2, '维护', 'warning', '', '2023-11-14 16:54:25', '2023-12-13 09:16:12'),
	(9, 3, '2', '停运', 3, '停运', 'danger', '', '2023-11-14 16:54:34', '2023-12-13 09:16:15'),
	(10, 5, '0', '单绑定通道', 1, '单绑定多开', NULL, '', '2023-11-15 12:47:38', '2023-12-24 13:14:04'),
	(11, 5, '1', '账户总通道', 2, '账户总多开', NULL, '', '2023-11-15 12:48:04', '2023-12-24 13:14:08'),
	(12, 6, '0', '不绑定', 1, NULL, NULL, '', '2023-11-15 12:48:49', '2023-11-15 12:48:49'),
	(13, 6, '1', '特征绑定（🧩自定义传入IP地址或机器码等特征数据）', 2, NULL, NULL, '', '2023-11-15 12:48:57', '2023-12-06 15:28:05'),
	(15, 7, '0', '关闭注册', 1, '关闭注册', 'danger', '', '2023-11-15 12:55:02', '2023-12-13 09:43:30'),
	(16, 7, '1', '开放注册（无限制）', 2, '开放注册', 'info', '', '2023-11-15 12:55:13', '2024-01-25 05:23:19'),
	(17, 7, '2', '开放注册（需充值卡）', 3, '卡号注册', 'info', '', '2023-11-15 12:55:20', '2024-01-25 05:23:29'),
	(18, 7, '3', '特征限制（自定义限制次数）', 4, '特征限制', 'warning', '', '2023-11-15 12:55:33', '2024-01-25 05:14:22'),
	(20, 8, '0', '关闭', 1, '关闭', NULL, '', '2023-11-15 12:56:01', '2024-01-29 04:26:41'),
	(21, 8, '1', '开启', 2, '开启', NULL, '', '2023-11-15 12:56:11', '2024-01-29 04:32:16'),
	(22, 9, '0', '账号登录', 1, '账号登录', 'border-color: #B3D9D9;color: #5CADAD;', '', '2023-11-15 12:56:31', '2024-01-16 13:06:54'),
	(23, 9, '1', '卡号登录（充值卡/激活码可直接登录）', 2, '卡号登录', 'border-color: #FFD9EC;color: #FF95CA;', '', '2023-11-15 12:56:39', '2024-01-23 08:10:46'),
	(24, 9, '2', '混合登录（账号可登录+充值卡/激活码可登录）', 3, '混合登录', 'border-color: #E6CAFF;color: #BE77FF;', '', '2023-11-15 12:56:48', '2024-01-16 13:08:15'),
	(26, 10, '1', '计时收费', 2, '计时收费', 'background: linear-gradient(to right, #DCB5FF, #B15BFF);', '', '2023-11-15 12:57:09', '2024-02-03 14:01:02'),
	(27, 10, '2', '计点收费', 3, '计点收费', 'background: linear-gradient(to right, #FFC78E, #FF9797);', '', '2023-11-15 12:57:24', '2024-02-03 13:40:05'),
	(28, 10, '3', '混合收费(模式1)', 4, '混合|模式1', 'background: linear-gradient(to right, #FF9797, #FF60AF);', '', '2023-11-15 12:57:32', '2024-02-03 14:04:28'),
	(29, 11, '0', '明文（推荐调试时使用）', 1, '明文', 'background: linear-gradient(to right, #9D9D9D, #4F4F4F);', '', '2023-11-15 12:57:47', '2024-01-16 13:20:06'),
	(30, 11, '1', 'RC4（安全性一般）', 2, 'Rc4', 'background: linear-gradient(to right, #84C1FF, #0080FF);', '', '2023-11-15 12:58:01', '2024-01-17 12:01:16'),
	(31, 11, '2', 'BASE64（无安全性）', 3, 'Base64', 'background: linear-gradient(to right, #C7C7E2, #6A6AFF);', '', '2023-11-15 12:58:17', '2024-01-17 12:01:11'),
	(32, 11, '3', 'RSA2（安全性非常高）', 4, 'Rsa2', 'background: linear-gradient(to right, #D3A4FF, #BE77FF);', '', '2023-11-15 12:58:38', '2024-01-17 12:01:07'),
	(33, 12, '0', '关闭', 1, '不验签名', 'info', '', '2023-11-15 12:58:48', '2023-12-13 09:48:37'),
	(34, 12, '1', '开启（取md5值）', 2, '验证签名', 'success', '', '2023-11-15 12:58:55', '2024-01-25 05:16:49'),
	(35, 13, '0', '关闭', 1, NULL, NULL, '', '2023-11-15 12:59:04', '2023-11-15 12:59:04'),
	(36, 13, '1', '开启', 2, NULL, NULL, '', '2023-11-15 12:59:10', '2023-11-15 12:59:10'),
	(37, 14, '0', '关闭', 1, NULL, NULL, '', '2023-11-15 12:59:21', '2023-11-15 12:59:21'),
	(38, 14, '1', '开启', 2, NULL, NULL, '', '2023-11-15 12:59:28', '2023-11-15 12:59:28'),
	(39, 15, '0', '关闭', 1, NULL, NULL, '', '2023-11-15 12:59:50', '2023-11-15 12:59:50'),
	(40, 15, '1', '开启', 2, NULL, NULL, '', '2023-11-15 12:59:55', '2023-11-15 12:59:55'),
	(41, 16, '0', '关闭', 1, NULL, NULL, '', '2023-11-15 13:00:03', '2023-11-15 13:00:03'),
	(42, 16, '1', '开启', 2, NULL, NULL, '', '2023-11-15 13:00:08', '2023-11-15 13:00:08'),
	(44, 10, '0', '限时免费', 1, '限时免费', 'background: linear-gradient(to right, #ADFEDC, #0080FF);', '', '2023-11-15 14:28:12', '2024-02-03 14:01:00'),
	(47, 17, '0', '选择更新', 2, NULL, NULL, '', '2023-12-05 14:02:16', '2023-12-05 14:02:35'),
	(48, 17, '1', '强制更新', 1, NULL, NULL, '', '2023-12-05 14:02:22', '2023-12-05 14:02:33'),
	(49, 18, '0', '正常', 1, '正常', 'success', '', '2023-12-06 14:50:10', '2023-12-13 10:17:59'),
	(50, 18, '1', '封禁', 2, '封禁', 'danger', '', '2023-12-06 14:50:16', '2023-12-13 10:12:46'),
	(51, 18, '2', '冻结', 3, '冻结', 'warning', '', '2023-12-06 14:50:26', '2023-12-13 10:12:51'),
	(52, 19, '0', '账号（账户密码必填，否则无法登录）', 1, '账号', 'background: linear-gradient(45deg, #97CBFF, #0080FF);', '', '2023-12-06 15:01:08', '2024-01-16 13:33:30'),
	(53, 19, '1', '卡号（充值卡/激活码，账户密码无需填写）', 2, '卡号', 'background: linear-gradient(45deg, #B9B9FF, #6A6AFF);', '', '2023-12-06 15:01:15', '2024-02-15 02:40:20'),
	(57, 21, '0', '未使用', 1, '未使用', 'success', '', '2023-12-14 04:51:27', '2024-01-08 05:13:59'),
	(58, 21, '4', '已锁卡', 5, '已锁卡', 'danger', '', '2023-12-14 04:51:45', '2024-01-10 13:15:19'),
	(59, 22, '0', '未到期', 1, '未到期', '', '', '2023-12-22 07:59:03', '2023-12-22 07:59:03'),
	(60, 22, '1', '已到期', 2, '已到期', '', '', '2023-12-22 07:59:08', '2023-12-22 07:59:08'),
	(71, 21, '2', '已使用', 3, '已使用', 'warning', '', '2024-01-08 05:10:35', '2024-01-08 05:17:02'),
	(72, 21, '3', '已失效', 4, '已失效', 'info', '', '2024-01-08 05:10:44', '2024-01-08 05:17:00'),
	(73, 27, '0', '账户消费', 1, '账户消费', 'primary', '', '2024-01-09 11:36:35', '2024-01-09 11:37:46'),
	(74, 27, '1', '下级提成', 2, '下级提成', 'warning', '', '2024-01-09 11:36:43', '2024-01-09 11:37:54'),
	(75, 27, '2', '退卡返还', 3, '退卡返还', 'danger', '', '2024-01-09 11:36:49', '2024-01-09 11:37:59'),
	(76, 27, '3', '后台加款', 4, '后台加款', 'success', '', '2024-01-09 11:36:57', '2024-01-09 11:38:06'),
	(77, 27, '4', '在线充值', 5, '在线充值', 'success', '', '2024-01-09 11:37:04', '2024-01-09 11:38:08'),
	(78, 21, '1', '已售出', 2, '已售出', '', '', '2024-01-10 13:13:26', '2024-01-10 13:13:26'),
	(79, 28, '1', '开启', 1, '开启', 'success', '', '2024-01-16 09:48:02', '2024-02-01 14:11:40'),
	(80, 28, '0', '关闭', 2, '关闭', 'info', '', '2024-01-16 09:48:11', '2024-02-01 14:11:01'),
	(85, 29, '0', '关闭（客户端主动注销在线或服务端验证心跳超时后方可登录）', 1, '关闭', '', '', '2024-01-24 04:23:13', '2024-01-24 04:27:26'),
	(86, 29, '1', '开启（根据通道模式和绑定方式，强制离线最老的登录客户端）', 2, '开启', '', '', '2024-01-24 04:23:18', '2024-01-24 04:26:38'),
	(87, 7, '4', 'IP地址限制（自定义限制次数）', 5, 'IP地址限制', 'warning', '', '2024-01-25 05:13:22', '2024-01-25 05:14:24'),
	(88, 7, '5', '设备码限制（自定义限制次数）', 6, '设备码限制', 'warning', '', '2024-01-25 05:13:30', '2024-01-25 05:22:08'),
	(90, 31, '0', '关闭', 1, '关闭', '', '', '2024-01-29 04:26:51', '2024-01-29 04:26:51'),
	(91, 31, '1', '只能在原特征上解绑', 2, '原特征上解绑', '', '', '2024-01-29 04:27:00', '2024-01-29 04:27:24'),
	(92, 31, '2', '可在任意特征上解绑', 3, '任意特征上解绑', '', '', '2024-01-29 04:27:14', '2024-01-29 04:27:29'),
	(93, 30, '0', '关闭', 1, '关闭', '', '', '2024-01-29 04:27:36', '2024-01-29 04:27:36'),
	(94, 30, '1', '只能在原特征上解绑', 2, '只能在原特征上解绑', '', '', '2024-01-29 04:27:44', '2024-01-29 04:27:44'),
	(95, 30, '2', '可在任意特征上解绑', 3, '可在任意特征上解绑', '', '', '2024-01-29 04:27:50', '2024-01-29 04:27:50'),
	(96, 32, '0', '登录软件', 1, '登录软件', 'color:#1E5AF0', '', '2024-01-29 05:11:28', '2024-01-30 04:25:37'),
	(97, 32, '1', '解绑特征', 2, '解绑特征', 'color:#D28700', '', '2024-01-29 05:11:35', '2024-01-30 04:00:28'),
	(98, 32, '2', '账户充值', 3, '账户充值', 'color:#4BB400', '', '2024-01-29 05:11:43', '2024-01-30 04:00:45'),
	(99, 32, '3', '绑定特征', 4, '绑定特征', 'color:#921AFF', '', '2024-01-29 05:11:53', '2024-01-30 04:02:11'),
	(100, 32, '4', '扣时扣点', 5, '扣时扣点', 'color:red;font-weight: bold;', '', '2024-01-29 05:16:24', '2024-02-03 11:58:05'),
	(101, 32, '5', '注销登录', 6, '注销登录', 'color:#009600', '', '2024-01-30 03:37:01', '2024-02-03 11:58:58'),
	(102, 33, '1', '开启', 2, '开启', 'success', '', '2024-02-01 05:44:19', '2024-02-01 15:17:34'),
	(103, 33, '0', '关闭', 1, '关闭', 'info', '', '2024-02-01 05:44:24', '2024-02-01 15:17:37'),
	(104, 34, '0', '关闭', 1, '关闭', 'info', '', '2024-02-01 15:15:32', '2024-02-01 15:18:51'),
	(105, 34, '1', '开启', 2, '开启', 'success', '', '2024-02-01 15:15:36', '2024-02-01 15:20:54'),
	(107, 10, '4', '混合收费(模式2)', 5, '混合|模式2', 'background: linear-gradient(to right, #FF9797, #FF60AF);', '', '2024-02-03 14:03:09', '2024-02-03 14:04:31'),
	(109, 36, '1', '是', 1, '是', 'danger', '', '2024-02-14 14:25:48', '2024-02-14 14:51:38'),
	(110, 36, '0', '否', 2, '否', 'info', '', '2024-02-14 14:25:58', '2024-02-14 14:51:42'),
	(111, 19, '2', '域名（特殊验证接口使用）', 3, '域名', 'background: linear-gradient(45deg, #FFB6C1, #CC33FF);', '', '2024-02-15 02:40:39', '2024-02-15 03:01:20');

-- 导出  表 safeyz_t.b2_file_record 结构
DROP TABLE IF EXISTS `b2_file_record`;
CREATE TABLE IF NOT EXISTS `b2_file_record` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `create_user_id` int NOT NULL COMMENT '用户id',
  `name` varchar(200) DEFAULT NULL COMMENT '文件名称',
  `fmd5` varchar(200) DEFAULT NULL COMMENT '文件指纹',
  `path` varchar(400) DEFAULT NULL COMMENT '文件存储路径',
  `length` int DEFAULT NULL COMMENT '文件大小',
  `content_type` varchar(80) DEFAULT NULL COMMENT '文件类型',
  `durl` text,
  `comments` varchar(400) DEFAULT NULL COMMENT '备注',
  `deleted` int NOT NULL DEFAULT '0' COMMENT '是否删除, 0否, 1是',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='文件上传记录';

-- 正在导出表  safeyz_t.b2_file_record 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_menu 结构
DROP TABLE IF EXISTS `b2_menu`;
CREATE TABLE IF NOT EXISTS `b2_menu` (
  `menu_id` int NOT NULL AUTO_INCREMENT COMMENT '菜单id',
  `parent_id` int NOT NULL DEFAULT '0' COMMENT '上级id, 0是顶级',
  `title` varchar(200) NOT NULL COMMENT '菜单名称',
  `path` varchar(200) DEFAULT NULL COMMENT '菜单路由地址',
  `component` varchar(200) DEFAULT NULL COMMENT '菜单组件地址, 目录可为空',
  `menu_type` int DEFAULT '0' COMMENT '类型, 0菜单, 1按钮',
  `sort_number` int NOT NULL DEFAULT '1' COMMENT '排序号',
  `authority` varchar(200) DEFAULT NULL COMMENT '权限标识',
  `icon` varchar(200) DEFAULT NULL COMMENT '菜单图标',
  `hide` int NOT NULL DEFAULT '0' COMMENT '是否隐藏, 0否, 1是(仅注册路由不显示在左侧菜单)',
  `meta` varchar(800) DEFAULT NULL COMMENT '其它路由元信息',
  `deleted` int NOT NULL DEFAULT '0' COMMENT '是否删除, 0否, 1是',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`menu_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=523 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='菜单';

-- 正在导出表  safeyz_t.b2_menu 的数据：~131 rows (大约)
INSERT INTO `b2_menu` (`menu_id`, `parent_id`, `title`, `path`, `component`, `menu_type`, `sort_number`, `authority`, `icon`, `hide`, `meta`, `deleted`, `create_time`, `update_time`) VALUES
	(301, 0, '站点管理', '/system', NULL, 0, 1, NULL, 'Setting', 0, '{"props": {"badge": {"value": "超管", "type": "warning"}}, "lang": {"zh_TW": "系統管理", "en": "System"}}', 0, '2020-02-26 04:51:23', '2024-02-21 13:26:09'),
	(302, 301, '账户管理', '/system/user', '/system/user', 0, 2, NULL, 'User', 0, '{"lang": {"zh_TW": "用戶管理", "en": "User"},"hideFooter":true}', 0, '2020-02-26 04:51:55', '2024-01-10 16:30:59'),
	(303, 302, '查询用户', NULL, NULL, 1, 1, 'sys:user:list', NULL, 0, NULL, 0, '2020-02-26 04:52:06', '2023-05-24 03:59:06'),
	(304, 302, '添加用户', NULL, NULL, 1, 2, 'sys:user:save', NULL, 0, NULL, 0, '2020-02-26 04:52:26', '2023-05-24 03:59:06'),
	(305, 302, '修改用户', NULL, NULL, 1, 3, 'sys:user:alter', NULL, 0, NULL, 0, '2020-02-26 04:52:50', '2023-11-15 12:41:35'),
	(306, 302, '删除用户', NULL, NULL, 1, 4, 'sys:user:remove', NULL, 0, NULL, 0, '2020-02-26 04:53:13', '2023-05-24 03:59:06'),
	(307, 301, '角色权限', '/system/role', '/system/role', 0, 15, NULL, 'Postcard', 0, '{"lang": {"zh_TW": "角色权限", "en": "Role"},"hideFooter":true}', 0, '2020-03-13 05:29:08', '2024-01-15 14:57:26'),
	(308, 307, '查询角色', NULL, NULL, 1, 1, 'sys:role:list', NULL, 0, NULL, 0, '2020-03-13 05:30:41', '2024-01-06 10:28:06'),
	(309, 307, '添加角色', NULL, NULL, 1, 2, 'sys:role:save', NULL, 0, NULL, 0, '2020-03-15 05:02:07', '2023-05-24 03:59:06'),
	(310, 307, '修改角色', NULL, NULL, 1, 3, 'sys:role:alter', NULL, 0, NULL, 0, '2020-03-15 05:02:49', '2023-11-15 12:41:41'),
	(311, 307, '删除角色', NULL, NULL, 1, 4, 'sys:role:remove', NULL, 0, NULL, 0, '2020-03-20 09:58:51', '2023-05-24 03:59:06'),
	(312, 301, '路由菜单', '/system/menu', '/system/menu', 0, 10, NULL, 'Operation', 0, '{"lang": {"zh_TW": "路由菜单", "en": "Menu"},"hideFooter":true}', 0, '2020-03-20 17:07:13', '2024-01-15 14:57:39'),
	(313, 312, '查询菜单', NULL, NULL, 1, 1, 'sys:menu:list', NULL, 0, NULL, 0, '2020-03-21 08:43:30', '2023-05-24 03:59:06'),
	(314, 312, '添加菜单', NULL, NULL, 1, 2, 'sys:menu:save', NULL, 0, NULL, 0, '2020-03-21 08:43:54', '2023-05-24 03:59:06'),
	(315, 312, '修改菜单', NULL, NULL, 1, 3, 'sys:menu:alter', NULL, 0, NULL, 0, '2020-03-21 10:24:17', '2023-11-15 12:41:45'),
	(316, 312, '删除菜单', NULL, NULL, 1, 4, 'sys:menu:remove', NULL, 0, NULL, 0, '2020-03-21 10:24:18', '2023-05-24 03:59:06'),
	(322, 301, '字典数据', '/system/dictionary', '/system/dictionary', 0, 20, NULL, 'Coin', 0, '{"hideFooter":true, "lang": {"zh_TW": "字典数据", "en": "Dictionary"},"hideFooter":true}', 0, '2020-03-21 10:24:26', '2024-02-03 12:10:23'),
	(323, 322, '查询字典', NULL, NULL, 1, 1, 'sys:dict:list', NULL, 0, NULL, 0, '2020-03-21 10:24:27', '2023-05-24 03:59:06'),
	(324, 322, '添加字典', NULL, NULL, 1, 2, 'sys:dict:save', NULL, 0, NULL, 0, '2020-03-21 10:24:28', '2023-05-24 03:59:06'),
	(325, 322, '修改字典', NULL, NULL, 1, 3, 'sys:dict:alter', NULL, 0, NULL, 0, '2020-03-21 10:24:29', '2023-11-15 12:41:49'),
	(326, 322, '删除字典', NULL, NULL, 1, 4, 'sys:dict:remove', NULL, 0, NULL, 0, '2020-03-21 10:24:31', '2023-05-24 03:59:06'),
	(329, 301, '网盘管理', '/system/file', '/system/file', 0, 6, NULL, 'Folder', 0, '{"lang": {"zh_TW": "网盘管理", "en": "File"},"hideFooter":true}', 0, '2020-09-17 15:19:43', '2024-01-15 14:58:31'),
	(330, 329, '上传文件', NULL, NULL, 1, 1, 'sys:file:upfile', NULL, 0, NULL, 0, '2020-09-17 15:21:04', '2023-12-04 11:51:34'),
	(331, 329, '删除文件', NULL, NULL, 1, 2, 'sys:file:remove', NULL, 0, NULL, 0, '2020-09-17 15:21:53', '2023-05-24 03:59:06'),
	(332, 329, '查看记录', NULL, NULL, 1, 3, 'sys:file:list', NULL, 0, NULL, 0, '2020-09-17 15:20:29', '2023-05-24 03:59:06'),
	(333, 302, '用户详情', '/system/user/details', '/system/user/details', 0, 5, NULL, 'User', 1, '{"active": "/system/user", "lang": {"zh_TW": "用戶詳情", "en": "UserDetails"}}', 0, '2021-05-21 03:07:54', '2023-06-12 15:09:28'),
	(334, 361, '修改个人密码', NULL, NULL, 1, 10, 'sys:auth:password', NULL, 0, NULL, 0, '2020-09-17 15:22:45', '2023-11-13 08:00:46'),
	(361, 0, '综合功能(所有角色都要添加的权限)', '/user', NULL, 0, 100, NULL, 'SetUp', 1, '{"lang": {"zh_TW": "個人中心", "en": "User"}}', 0, '2021-02-02 12:09:54', '2024-02-03 12:13:24'),
	(400, 0, '项目管理', '/project', '', 0, 2, '', 'AppstoreAddOutlined', 0, '', 0, '2023-11-13 06:47:14', '2023-11-13 07:57:51'),
	(401, 400, '软件管理', '/project/soft', '/project/soft', 0, 1, '', 'Monitor', 0, '{"hideFooter":true}', 0, '2023-11-13 06:53:40', '2024-01-14 12:39:01'),
	(402, 400, '公告管理', '/project/notice', '/project/notice', 0, 2, '', 'Tickets', 0, '{"hideFooter":true}', 0, '2023-11-13 07:47:56', '2024-01-10 16:31:47'),
	(403, 400, '版本管理', '/project/edition', '/project/edition', 0, 4, '', 'Coin', 0, '{"hideFooter":true}', 0, '2023-11-13 07:49:57', '2024-01-10 16:31:55'),
	(405, 466, '用户列表', '/soft/user', '/soft/user', 0, 1, '', 'Postcard', 0, '', 0, '2023-11-13 07:55:44', '2024-02-15 09:56:32'),
	(407, 466, '在线列表', '/soft/online', '/soft/online', 0, 2, '', 'Connection', 0, '{"hideFooter":true}', 0, '2023-11-13 07:57:24', '2024-01-15 14:41:10'),
	(408, 401, '软件查询', '', '', 1, 1, 'pjc:soft:list', '', 0, '', 0, '2023-11-14 14:49:55', '2023-11-14 14:49:55'),
	(410, 401, '修改软件', '/project/soft/edit', '/project/soft/edit', 0, 5, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-11-14 16:38:27', '2024-01-10 16:29:21'),
	(411, 401, '软件修改', '', '', 1, 2, 'pjc:soft:alter', '', 0, '', 0, '2023-11-15 12:36:41', '2023-12-23 09:06:05'),
	(412, 401, '软件新增', '', '', 1, 3, 'pjc:soft:save', '', 0, '', 0, '2023-11-15 12:37:24', '2023-12-23 09:06:09'),
	(413, 401, '软件删除', '', '', 1, 4, 'pjc:soft:remove', '', 0, '', 0, '2023-11-15 12:37:50', '2023-12-23 09:06:11'),
	(414, 401, '添加软件', '/project/soft/add', '/project/soft/add', 0, 6, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-11-20 18:01:53', '2024-01-10 16:29:15'),
	(415, 402, '公告查询', '', '', 1, 1, 'pjc:notice:list', '', 0, '', 0, '2023-11-20 18:10:34', '2023-11-20 18:10:34'),
	(416, 402, '公告新增', '', '', 1, 1, 'pjc:notice:save', '', 0, '', 0, '2023-11-20 18:11:11', '2023-11-20 19:12:05'),
	(417, 402, '公告修改', '', '', 1, 1, 'pjc:notice:alter', '', 0, '', 0, '2023-11-20 18:11:42', '2023-11-20 18:11:42'),
	(418, 402, '公告删除', '', '', 1, 1, 'pjc:notice:remove', '', 0, '', 0, '2023-11-20 18:11:56', '2023-11-20 18:11:56'),
	(419, 402, '修改公告', '/project/notice/edit', '/project/notice/edit', 0, 2, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-11-20 18:12:46', '2024-01-10 16:31:41'),
	(420, 402, '添加公告', '/project/notice/add', '/project/notice/add', 0, 2, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-11-20 18:13:46', '2024-01-10 16:31:43'),
	(421, 400, '网盘管理', '/project/file', '/project/file', 0, 3, '', 'Folder', 0, '{"hideFooter":true}', 0, '2023-12-04 13:21:39', '2024-01-10 16:31:52'),
	(422, 421, '上传文件', '', '', 1, 1, 'pjc:file:upfile', '', 0, '', 0, '2023-12-04 13:23:16', '2023-12-04 13:23:16'),
	(423, 421, '删除文件', '', '', 1, 2, 'pjc:file:remove', '', 0, '', 0, '2023-12-04 13:23:58', '2023-12-04 13:23:58'),
	(424, 421, '查看记录', '', '', 1, 3, 'pjc:file:list', '', 0, '', 0, '2023-12-04 13:24:23', '2023-12-04 13:24:23'),
	(425, 403, '版本查询', '', '', 1, 1, 'pjc:edition:list', '', 0, '', 0, '2023-12-05 14:20:15', '2023-12-05 14:20:36'),
	(426, 403, '版本新增', '', '', 1, 1, 'pjc:edition:save', '', 0, '', 0, '2023-12-05 14:20:32', '2023-12-05 14:22:34'),
	(427, 403, '版本修改', '', '', 1, 1, 'pjc:edition:alter', '', 0, '', 0, '2023-12-05 14:21:00', '2023-12-05 14:22:36'),
	(428, 403, '版本删除', '', '', 1, 1, 'pjc:edition:remove', '', 0, '', 0, '2023-12-05 14:21:17', '2023-12-05 14:22:39'),
	(429, 403, '添加版本', '/project/edition/add', '/project/edition/add', 0, 2, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-12-05 14:22:26', '2024-01-10 16:31:59'),
	(430, 403, '修改版本', '/project/edition/edit', '/project/edition/edit', 0, 2, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-12-05 14:23:05', '2024-01-10 16:32:01'),
	(431, 405, '用户查询', '', '', 1, 1, 'soft:user:list', '', 0, '', 0, '2023-12-06 13:28:59', '2023-12-06 13:28:59'),
	(432, 405, '用户修改', '', '', 1, 1, 'soft:user:alter', '', 0, '', 0, '2023-12-06 13:29:18', '2023-12-06 13:29:18'),
	(433, 405, '用户新增', '', '', 1, 1, 'soft:user:save', '', 0, '', 0, '2023-12-06 13:29:36', '2023-12-06 13:29:36'),
	(434, 405, '用户删除', '', '', 1, 1, 'soft:user:remove', '', 0, '', 0, '2023-12-06 13:29:53', '2023-12-06 13:29:53'),
	(435, 405, '添加用户', '/soft/user/add', '/soft/user/add', 0, 2, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-12-06 13:30:31', '2024-01-10 16:32:35'),
	(436, 405, '修改用户', '/soft/user/edit', '/soft/user/edit', 0, 2, '', 'Link', 1, '{"hideFooter":true}', 0, '2023-12-06 13:31:06', '2024-01-10 16:32:37'),
	(437, 407, '在线列表', '', '', 1, 1, 'soft:online:list', '', 0, '', 0, '2023-12-13 13:26:19', '2024-01-10 16:32:44'),
	(438, 407, '强制离线', '', '', 1, 1, 'soft:online:remove', '', 0, '', 0, '2023-12-13 13:26:56', '2023-12-14 03:01:50'),
	(440, 0, '充值管理', '/soft_carmi', '', 0, 30, '', 'Postcard', 0, '', 0, '2023-12-14 03:26:28', '2024-02-03 12:13:12'),
	(441, 440, '卡种管理', '/soft/carmit', '/soft/carmit', 0, 1, '', 'Calendar', 0, '', 0, '2023-12-14 03:28:48', '2023-12-14 03:29:22'),
	(442, 440, '充值卡库存', '/soft/carmi', '/soft/carmi', 0, 2, '', 'Coin', 0, '', 0, '2023-12-14 03:29:55', '2023-12-14 03:34:16'),
	(443, 441, '卡种查询', '', '', 1, 1, 'soft:carmit:list', '', 0, '', 0, '2023-12-14 03:57:47', '2023-12-14 03:57:47'),
	(444, 441, '卡种修改', '', '', 1, 1, 'soft:carmit:alter', '', 0, '', 0, '2023-12-14 03:58:01', '2023-12-14 03:58:01'),
	(445, 441, '卡种新增', '', '', 1, 1, 'soft:carmit:save', '', 0, '', 0, '2023-12-14 03:58:21', '2023-12-14 03:58:21'),
	(446, 441, '卡种删除', '', '', 1, 1, 'soft:carmit:remove', '', 0, '', 0, '2023-12-14 03:58:36', '2023-12-14 03:58:36'),
	(447, 442, '生产充值卡', '', '', 1, 1, 'soft:carmi:save', '', 0, '', 0, '2023-12-14 04:00:48', '2023-12-14 04:00:48'),
	(448, 442, '查询充值卡', '', '', 1, 1, 'soft:carmi:list', '', 0, '', 0, '2023-12-14 04:01:03', '2024-01-05 03:37:09'),
	(449, 442, '删除充值卡', '', '', 1, 1, 'soft:carmi:remove', '', 0, '', 0, '2023-12-14 04:01:24', '2024-01-05 03:37:05'),
	(455, 0, '代理中心', '/agent', '', 0, 90, '', 'OfficeBuilding', 0, '', 0, '2023-12-19 12:17:07', '2024-02-03 12:13:32'),
	(456, 455, '子代列表', '/agent/subordinate', '/agent/subordinate', 0, 2, '', 'ScaleToOriginal', 0, '{"hideFooter":true}', 0, '2023-12-19 12:21:11', '2024-01-10 16:33:08'),
	(457, 455, '充值卡管理', '/agent/carmi', '/agent/carmi', 0, 3, '', 'CreditCard', 0, '{"hideFooter":true}', 0, '2023-12-19 12:22:43', '2024-01-10 16:33:11'),
	(458, 455, '控制台', '/agent/console', '/agent/console', 0, 1, '', 'PieChart', 0, '{"hideFooter":true}', 0, '2023-12-19 12:24:07', '2024-01-15 07:35:21'),
	(459, 301, '系统设置', '/system/website', '/system/website', 0, 1, '', 'Odometer', 0, '{"hideFooter":true}', 0, '2023-12-19 14:20:52', '2024-01-10 16:30:44'),
	(460, 459, '查看信息', '', '', 1, 1, 'sys:web:info', '', 0, '', 0, '2023-12-19 14:22:36', '2023-12-19 14:23:03'),
	(461, 459, '修改设置', '', '', 1, 2, 'sys:web:save', '', 0, '', 0, '2023-12-19 14:23:30', '2023-12-19 14:23:30'),
	(464, 361, '查询字典', '', '', 1, 100, 'sys:dict:list', '', 0, '', 0, '2023-12-23 09:02:14', '2024-01-16 05:44:23'),
	(465, 0, '代理管理', '/soft_agent', '', 0, 40, '', 'Notification', 0, '', 0, '2023-12-23 09:23:13', '2024-02-03 12:13:15'),
	(466, 0, '用户管理', '/soft_user', '', 0, 10, '', 'User', 0, '{"hideFooter":true}', 0, '2023-12-23 09:24:11', '2024-02-03 12:13:04'),
	(467, 465, '代理列表', '/agent/user', '/agent/user', 0, 1, '', 'Place', 0, '{"hideFooter":true}', 0, '2023-12-23 09:26:05', '2024-01-10 16:32:13'),
	(468, 465, '消费记录', '/agent/log', '/agent/log', 0, 3, '', 'ZoomIn', 0, '{"hideFooter":true}', 0, '2023-12-23 09:27:08', '2024-01-11 06:28:59'),
	(469, 467, '查询代理', '', '', 1, 1, 'pjc:agent:list', '', 0, '', 0, '2023-12-23 09:43:45', '2024-01-04 04:11:08'),
	(470, 467, '添加代理', '', '', 1, 2, 'pjc:agent:save', '', 0, '', 0, '2023-12-23 09:44:09', '2023-12-23 09:44:09'),
	(471, 467, '删除代理', '', '', 1, 3, 'pjc:agent:remove', '', 0, '', 0, '2023-12-23 09:44:23', '2023-12-23 09:44:23'),
	(472, 467, '修改代理', '', '', 1, 4, 'pjc:agent:alter', '', 0, '', 0, '2023-12-23 09:44:39', '2023-12-24 12:00:24'),
	(473, 467, '代理详情', '/agent/user/details', '/agent/user/details', 0, 6, '', 'User', 1, '{"hideFooter":true}', 0, '2023-12-24 04:31:17', '2024-01-10 16:32:09'),
	(474, 467, '卡种分配', '', '', 1, 5, 'pjc:agent:carmit', '', 0, '', 0, '2023-12-26 14:42:34', '2023-12-26 14:42:42'),
	(475, 456, '查询子代', '', '', 1, 1, 'agent:subordinate:list', '', 0, '', 0, '2024-01-04 04:10:51', '2024-01-04 04:11:21'),
	(476, 456, '添加子代', '', '', 1, 2, 'agent:subordinate:save', '', 0, '', 0, '2024-01-04 04:11:30', '2024-01-04 04:11:30'),
	(477, 456, '删除子代', '', '', 1, 3, 'agent:subordinate:remove', '', 0, '', 0, '2024-01-04 04:11:45', '2024-01-04 04:11:45'),
	(478, 456, '修改子代', '', '', 1, 4, 'agent:subordinate:alter', '', 0, '', 0, '2024-01-04 04:12:03', '2024-01-04 04:12:03'),
	(479, 456, '卡种分配', '', '', 1, 5, 'agent:subordinate:carmit', '', 0, '', 0, '2024-01-04 04:12:50', '2024-01-04 04:12:50'),
	(480, 456, '子代详情', '/agent/subordinate/details', '/agent/subordinate/details', 0, 6, '', 'User', 1, '{"hideFooter":true}', 0, '2024-01-04 04:18:20', '2024-01-10 16:33:17'),
	(481, 457, '生产充值卡', '', '', 1, 1, 'agent:carmi:save', '', 0, '', 0, '2024-01-05 03:36:20', '2024-01-05 03:36:20'),
	(482, 457, '查询充值卡', '', '', 1, 2, 'agent:carmi:list', '', 0, '', 0, '2024-01-05 03:36:36', '2024-01-05 03:36:43'),
	(483, 457, '删除充值卡', '', '', 1, 3, 'agent:carmi:remove', '', 0, '', 0, '2024-01-05 03:37:00', '2024-01-05 03:37:00'),
	(484, 457, '操作充值卡', '', '', 1, 4, 'agent:carmi:alter', '', 0, '', 0, '2024-01-08 16:11:17', '2024-01-08 16:11:17'),
	(486, 465, '代理公告', '/agent/notice', '/agent/notice', 0, 2, '', 'Bell', 0, '{"hideFooter":true}', 0, '2024-01-11 06:28:55', '2024-01-15 07:13:43'),
	(487, 486, '修改公告', '', '', 1, 2, 'agent:notice:alter', '', 0, '', 0, '2024-01-15 04:30:43', '2024-01-15 07:03:29'),
	(488, 486, '查询公告', '', '', 1, 1, 'agent:notice:list', '', 0, '', 0, '2024-01-15 07:03:49', '2024-01-15 07:03:49'),
	(489, 486, '添加公告', '', '', 1, 3, 'agent:notice:save', '', 0, '', 0, '2024-01-15 07:03:59', '2024-01-15 07:04:03'),
	(490, 486, '删除公告', '', '', 1, 4, 'agent:notice:remove', '', 0, '', 0, '2024-01-15 07:04:17', '2024-01-15 07:04:17'),
	(491, 486, '修改公告', '/agent/notice/edit', '/agent/notice/edit', 0, 5, '', 'Link', 1, '{"hideFooter":true}', 0, '2024-01-15 07:13:09', '2024-01-15 07:14:30'),
	(492, 486, '添加公告', '/agent/notice/add', '/agent/notice/add', 0, 5, '', 'Link', 1, '{"hideFooter":true}', 0, '2024-01-15 07:13:34', '2024-01-15 07:14:33'),
	(493, 468, '查询记录', '', '', 1, 1, 'pjc:agent:log', '', 0, '', 0, '2024-01-15 11:41:07', '2024-01-15 11:41:07'),
	(494, 456, '转账子代', '', '', 1, 5, 'agent:subordinate:recharge', '', 0, '', 0, '2024-01-15 12:43:00', '2024-01-15 12:43:00'),
	(495, 301, '平台公告', '/system/notice', '/system/notice', 0, 1, '', 'Bell', 0, '{"hideFooter":true}', 0, '2024-01-15 14:18:59', '2024-01-15 14:57:02'),
	(496, 495, '查看公告', '', '', 1, 1, 'sys:notice:list', '', 0, '', 0, '2024-01-15 14:19:34', '2024-01-15 14:23:59'),
	(497, 495, '添加公告', '', '', 1, 2, 'sys:notice:save', '', 0, '', 0, '2024-01-15 14:19:53', '2024-01-15 14:24:02'),
	(498, 495, '修改公告', '', '', 1, 3, 'sys:notice:alter', '', 0, '', 0, '2024-01-15 14:20:06', '2024-01-15 14:24:04'),
	(499, 495, '删除公告', '', '', 1, 4, 'sys:notice:remove', '', 0, '', 0, '2024-01-15 14:20:16', '2024-01-15 14:24:13'),
	(500, 495, '修改公告', '/system/notice/edit', '/system/notice/edit', 0, 5, '', 'Link', 1, '{"hideFooter":true}', 0, '2024-01-15 14:21:01', '2024-01-15 14:24:17'),
	(501, 495, '添加公告', '/system/notice/add', '/system/notice/add', 0, 6, '', 'Link', 1, '{"hideFooter":true}', 0, '2024-01-15 14:21:42', '2024-01-15 14:24:22'),
	(502, 0, '控制台', '/system/console', '/system/console', 0, 0, '', 'House', 0, '{"hideFooter":true}', 0, '2024-01-15 15:10:55', '2024-01-16 05:39:25'),
	(504, 512, '云端变量', '/extend/variable', '/extend/variable', 0, 9, '', 'Coin', 0, '{"hideFooter":true}', 0, '2024-01-16 10:12:29', '2024-01-16 13:40:39'),
	(505, 504, '查看变量', '', '', 1, 1, 'soft:variable:list', '', 0, '', 0, '2024-01-16 10:12:47', '2024-01-16 10:12:47'),
	(506, 504, '保存变量', '', '', 1, 2, 'soft:variable:save', '', 0, '', 0, '2024-01-16 10:13:06', '2024-01-16 10:13:06'),
	(507, 504, '修改变量', '', '', 1, 3, 'soft:variable:alter', '', 0, '', 0, '2024-01-16 10:13:22', '2024-01-16 10:13:22'),
	(508, 504, '删除变量', '', '', 1, 4, 'soft:variable:remove', '', 0, '', 0, '2024-01-16 10:13:37', '2024-01-16 10:13:37'),
	(509, 512, '接口日志', '/extend/apilog', '/extend/apilog', 0, 9, '', 'Connection', 0, '{"hideFooter":true}', 0, '2024-01-16 10:15:06', '2024-01-16 13:40:36'),
	(510, 509, '查看日志', '', '', 1, 1, 'soft:apilog:list', '', 0, '', 0, '2024-01-16 10:15:23', '2024-01-16 10:15:23'),
	(511, 509, '删除日志', '', '', 1, 2, 'soft:apilog:remove', '', 0, '', 0, '2024-01-16 10:15:37', '2024-01-16 13:58:42'),
	(512, 0, '拓展功能', '/extend', '', 0, 50, '', 'MessageBox', 0, '', 0, '2024-01-16 10:18:15', '2024-02-03 12:13:18'),
	(520, 466, '日志记录', '/soft/userlog', '/soft/userlog', 0, 3, '', 'Clock', 0, '{"hideFooter":true}', 0, '2024-01-30 03:20:52', '2024-01-30 03:20:59'),
	(521, 520, '查询日志', '', '', 1, 1, 'soft:userlog:list', '', 0, '', 0, '2024-01-30 03:21:20', '2024-01-30 03:21:20'),
	(522, 361, '账户充电', '', '', 1, 4, 'sys:auth:charge', '', 0, '', 0, '2024-02-08 10:50:58', '2024-02-08 10:50:58');

-- 导出  表 safeyz_t.b2_notice 结构
DROP TABLE IF EXISTS `b2_notice`;
CREATE TABLE IF NOT EXISTS `b2_notice` (
  `notice_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `notice_type` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `notice_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notice_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_notice 的数据：~7 rows (大约)
INSERT INTO `b2_notice` (`notice_id`, `create_user_id`, `notice_type`, `notice_title`, `notice_info`, `create_time`, `update_time`) VALUES
	(1, 0, 'warning', '🔈测试Markdown公告标题1', '---\ntitle: 安全宝网络验证\nlanguage_tabs:\n  - shell: Shell\n  - http: HTTP\n  - javascript: JavaScript\n  - ruby: Ruby\n  - python: Python\n  - php: PHP\n  - java: Java\n  - go: Go\ntoc_footers: []\ns: []\nsearch: true\ncode_clipboard: true\nhighlight_theme: darkula\nheadingLevel: 2\ngenerator: "@tarslib/widdershins v4.0.20"\n\n---\n\n# 安全宝网络验证\n\nBase URLs:\n\n# Authentication\n\n# 安全宝旗舰版/客户端接口(标准版)\n\n## POST 注册\n\nPOST /api/reg\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "account_pass": "string",\n    "carmi": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号|\n|»» account_pass|body|string| yes |密码|\n|»» carmi|body|string| no |软件配置注册需充值卡时必填,其他情况下留空|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 登录\n\nPOST /api/login\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "account_pass": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» account_pass|body|string| no |密码(卡号时留空)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 心跳\n\nPOST /api/heartbeat\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 取登录信息\n\nPOST /api/user_info\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 历史充值卡_查询\n\nPOST /api/use_carmi_get\n\n查询登录用户的所有已经充值过的充值卡信息\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 历史充值卡_扣除\n\nPOST /api/use_carmi_deduct\n\n<span style="color:#FFA500;">扣除历史充值卡号上的点数/时间，此功能一般用于特殊的计费方式（不懂勿用）</span>\n<span style="color:#38ACEC;">每张充值卡在充值到用户账户上时都会自动生成一个 <span style="color:#F75D59;"><code>[基于当前充值时间计算后的到期时间]</code></span> 和 <span style="color:#F75D59;"><code style="color:#F75D59;">[剩余点数]</code></span></span>\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "carmi": "string",\n    "type": "string",\n    "number": "string",\n    "reason": "string",\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» carmi|body|string| yes |历史充值卡号(通过 历史充值卡_查询 接口获取)|\n|»» type|body|string| yes |扣除类型(0点数 1时间)|\n|»» number|body|string| yes |扣除数量(类型为时间时单位为分钟)|\n|»» reason|body|string| yes |扣除原因|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 临时数据_读\n\nPOST /api/temp_data_get\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 临时数据_写\n\nPOST /api/temp_data_set\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "temp_data": "string",\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» temp_data|body|string| yes |临时数据|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 云端变量_读\n\nPOST /api/variable_get\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "key": "string",\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» key|body|string| yes |变量名|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| no |登录凭证(登录成功后返回) [当变量需要登录才能读取时,该参数必填]|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 云端变量_删\n\nPOST /api/variable_del\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "key": "string",\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» key|body|string| yes |变量名|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| no |登录凭证(登录成功后返回) [当变量需要登录才能操作时,该参数必填]|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 云端变量_写\n\nPOST /api/variable_set\n\n该接口同时具有 [<span style="color:green">新增</span>] 和 [<span style="color:green">修改</span>] 变量两个功能，当要修改的变量名不存在时则变为新增变量；\n<span style="color:#FFA500;text-decoration:underline;">如果只想当做新增变量的接口用途，可使用读取变量接口进行判断是否存在；</span>\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "key": "string",\n    "value": "string",\n    "v_type": "string",\n    "v_alter": "string",\n    "v_del": "string",\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» key|body|string| yes |变量名|\n|»» value|body|string| yes |变量值|\n|»» v_type|body|string| no |变量读取类型(0无需登录 1需要登录) [当为新增变量时必填]|\n|»» v_alter|body|string| no |可否接口修改变量 [当为新增变量时必填]|\n|»» v_del|body|string| no |可否接口删除变量 [当为新增变量时必填]|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| no |登录凭证(登录成功后返回) [当变量需要登录才能操作时,该参数必填]|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 扣点\n\nPOST /api/deduct_point\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "number": "string",\n    "reason": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» number|body|string| yes |扣除数量|\n|»» reason|body|string| yes |扣除原因|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 扣时\n\nPOST /api/deduct_time\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "number": "string",\n    "reason": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» number|body|string| yes |扣除时间(分钟)|\n|»» reason|body|string| yes |扣除原因|\n|»» cookie|body|string| yes |登录凭证(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 注销\n\nPOST /api/logout\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "cookie": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» cookie|body|string| yes |登录凭据(登录成功后返回)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 充值\n\nPOST /api/recharge\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "carmi": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» carmi|body|string| yes |充值卡号|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 取公告列表\n\nPOST /api/notice\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 解绑_指定\n\nPOST /api/un_bind\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "account_pass": "string",\n    "unFeature": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» account_pass|body|string| no |密码(卡号时留空)|\n|»» unFeature|body|string| no |当软件配置[可在任意特征上解绑]时,该参数必填|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 解绑_全部\n\nPOST /api/un_bind_all\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "account": "string",\n    "account_pass": "string",\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» account|body|string| yes |账号/卡号|\n|»» account_pass|body|string| no |密码(卡号时留空)|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 初始化\n\nPOST /api/init\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 更新检测\n\nPOST /api/update\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n## POST 取软件信息\n\nPOST /api/soft_info\n\n> Body Parameters\n\n```json\n{\n  "soft": "string",\n  "data": {\n    "feature": "string",\n    "mac": "string",\n    "md5": "string",\n    "version": "string",\n    "clientid": "string",\n    "clientos": "string",\n    "param": "string",\n    "token": "string",\n    "uuid": "string"\n  },\n  "sign": "string"\n}\n```\n\n### Params\n\n|Name|Location|Type|d|Description|\n|---|---|---|---|---|\n|Content-Type|header|string| no |none|\n|body|body|object| no |none|\n|» soft|body|string| yes |none|\n|» data|body|object| yes |none|\n|»» feature|body|string| yes |特征信息|\n|»» mac|body|string| yes |机器码|\n|»» md5|body|string| no |软件MD5(开启摘要校验时必填)|\n|»» version|body|string| yes |软件版本|\n|»» clientid|body|string| yes |客户端id|\n|»» clientos|body|string| yes |客户端os|\n|»» param|body|string| no |自定义传输字符串|\n|»» token|body|string| yes |none|\n|»» uuid|body|string| yes |none|\n|» sign|body|string| no |none|\n\n> Response Examples\n\n> 200 Response\n\n```json\n{}\n```\n\n### Responses\n\n|HTTP Status Code |Meaning|Description|Data schema|\n|---|---|---|---|\n|200|[OK](https://tools.ietf.org/html/rfc7231#section-6.3.1)|成功|Inline|\n\n### Responses Data Schema\n\n# Data Schema\n\n', '2024-01-15 14:25:06', '2024-02-20 07:00:52'),
	(5, 0, 'primary', '🔈测试Markdown公告标题2', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 14:25:06', '2024-01-15 16:43:32'),
	(6, 0, 'success', '🔈测试Markdown公告标题3', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 14:25:06', '2024-01-15 16:43:35'),
	(7, 0, NULL, '🔈测试Markdown公告标题4', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 14:25:06', '2024-01-15 16:43:38'),
	(8, 0, 'warning', '🔈测试Markdown公告标题5', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 14:25:06', '2024-01-15 16:43:41'),
	(9, 0, 'danger', '🔈测试Markdown公告标题6', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 14:25:06', '2024-01-15 16:43:50'),
	(10, 0, '', '🔈测试Markdown公告标题7', '8888888888888\n\n```js\nfunction f1() {\n    var num = 123;\n    function f2() {\n        console.log(num);\n    }\n    f2(); \n} \nvar num = 456; \nf1();\n```\n\n![{855BC97D-7462-468b-ABFB-4D7A24D2AD02}.png](https://api.v1.x9n.net/upload/files/admin/20240115/65a51552b7ca39186.png)', '2024-01-15 14:25:06', '2024-01-15 16:43:55');

-- 导出  表 safeyz_t.b2_role 结构
DROP TABLE IF EXISTS `b2_role`;
CREATE TABLE IF NOT EXISTS `b2_role` (
  `role_id` int NOT NULL AUTO_INCREMENT COMMENT '角色id',
  `role_name` varchar(200) NOT NULL COMMENT '角色名称',
  `role_code` varchar(200) NOT NULL COMMENT '角色标识',
  `comments` varchar(400) DEFAULT NULL COMMENT '备注',
  `deleted` int NOT NULL DEFAULT '0' COMMENT '是否删除, 0否, 1是',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`role_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='角色';

-- 正在导出表  safeyz_t.b2_role 的数据：~5 rows (大约)
INSERT INTO `b2_role` (`role_id`, `role_name`, `role_code`, `comments`, `deleted`, `create_time`, `update_time`) VALUES
	(10, '站长组', 'admin', '系统管理员', 0, '2020-02-26 07:18:37', '2024-01-17 08:26:49'),
	(15, '代理组', 'agent', '代理商', 0, '2023-11-06 08:44:07', '2024-01-17 08:26:51'),
	(16, '运维组', 'devops', '系统运维', 0, '2023-11-15 12:13:20', '2024-01-17 08:26:53'),
	(17, '作者组', 'author', '作者', 0, '2023-12-22 05:33:49', '2024-01-17 08:26:55'),
	(18, '演示站长', 'yszz', '演示使用', 0, '2023-12-22 05:45:09', '2023-12-23 07:29:28');

-- 导出  表 safeyz_t.b2_role_menu 结构
DROP TABLE IF EXISTS `b2_role_menu`;
CREATE TABLE IF NOT EXISTS `b2_role_menu` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `role_id` int NOT NULL COMMENT '角色id',
  `menu_id` int NOT NULL COMMENT '菜单id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8968 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='角色权限';

-- 正在导出表  safeyz_t.b2_role_menu 的数据：~275 rows (大约)
INSERT INTO `b2_role_menu` (`id`, `role_id`, `menu_id`, `create_time`, `update_time`) VALUES
	(2451, 16, 322, '2023-11-15 12:13:38', '2023-11-15 12:13:38'),
	(2452, 16, 323, '2023-11-15 12:13:38', '2023-11-15 12:13:38'),
	(2453, 16, 324, '2023-11-15 12:13:38', '2023-11-15 12:13:38'),
	(2454, 16, 325, '2023-11-15 12:13:38', '2023-11-15 12:13:38'),
	(2455, 16, 326, '2023-11-15 12:13:38', '2023-11-15 12:13:38'),
	(2456, 16, 301, '2023-11-15 12:13:38', '2023-11-15 12:13:38'),
	(5421, 18, 460, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5422, 18, 303, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5423, 18, 333, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5424, 18, 332, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5425, 18, 308, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5426, 18, 313, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5427, 18, 323, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5428, 18, 401, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5429, 18, 408, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5430, 18, 411, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5431, 18, 412, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5432, 18, 413, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5433, 18, 410, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5434, 18, 414, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5435, 18, 402, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5436, 18, 415, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5437, 18, 416, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5438, 18, 417, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5439, 18, 418, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5440, 18, 419, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5441, 18, 420, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5442, 18, 424, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5443, 18, 403, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5444, 18, 425, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5445, 18, 426, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5446, 18, 427, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5447, 18, 428, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5448, 18, 429, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5449, 18, 430, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5451, 18, 405, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5452, 18, 431, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5453, 18, 432, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5454, 18, 433, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5455, 18, 434, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5456, 18, 435, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5457, 18, 436, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5458, 18, 407, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5459, 18, 437, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5460, 18, 438, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5461, 18, 440, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5462, 18, 441, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5463, 18, 443, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5464, 18, 444, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5465, 18, 445, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5466, 18, 446, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5467, 18, 442, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5468, 18, 447, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5469, 18, 448, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5470, 18, 449, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5471, 18, 301, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5472, 18, 459, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5473, 18, 302, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5474, 18, 329, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5475, 18, 307, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5476, 18, 312, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5477, 18, 322, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5478, 18, 400, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(5479, 18, 421, '2023-12-22 05:48:05', '2023-12-22 05:48:05'),
	(7930, 15, 455, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7931, 15, 458, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7932, 15, 456, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7933, 15, 475, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7934, 15, 476, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7935, 15, 477, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7936, 15, 478, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7937, 15, 479, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7938, 15, 494, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7939, 15, 480, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7940, 15, 457, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7941, 15, 481, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7942, 15, 482, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7943, 15, 483, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7944, 15, 484, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7945, 15, 334, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7946, 15, 464, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(7947, 15, 361, '2024-01-16 05:41:40', '2024-01-16 05:41:40'),
	(8317, 17, 502, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8318, 17, 400, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8319, 17, 401, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8320, 17, 408, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8321, 17, 411, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8322, 17, 412, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8323, 17, 413, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8324, 17, 410, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8325, 17, 414, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8326, 17, 402, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8327, 17, 415, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8328, 17, 416, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8329, 17, 417, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8330, 17, 418, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8331, 17, 419, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8332, 17, 420, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8333, 17, 421, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8334, 17, 422, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8335, 17, 423, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8336, 17, 424, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8337, 17, 403, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8338, 17, 425, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8339, 17, 426, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8340, 17, 427, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8341, 17, 428, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8342, 17, 429, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8343, 17, 430, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8344, 17, 465, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8345, 17, 467, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8346, 17, 469, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8347, 17, 470, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8348, 17, 471, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8349, 17, 472, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8350, 17, 474, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8351, 17, 473, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8352, 17, 486, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8353, 17, 488, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8354, 17, 487, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8355, 17, 489, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8356, 17, 490, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8357, 17, 491, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8358, 17, 492, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8359, 17, 468, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8360, 17, 493, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8361, 17, 466, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8362, 17, 405, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8363, 17, 431, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8364, 17, 432, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8365, 17, 433, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8366, 17, 434, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8367, 17, 435, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8368, 17, 436, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8369, 17, 407, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8370, 17, 437, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8371, 17, 438, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8372, 17, 440, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8373, 17, 441, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8374, 17, 443, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8375, 17, 444, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8376, 17, 445, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8377, 17, 446, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8378, 17, 442, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8379, 17, 447, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8380, 17, 448, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8381, 17, 449, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8382, 17, 512, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8383, 17, 504, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8384, 17, 505, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8385, 17, 506, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8386, 17, 507, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8387, 17, 508, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8388, 17, 509, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8389, 17, 510, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8390, 17, 511, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8391, 17, 361, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8392, 17, 334, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8393, 17, 464, '2024-01-16 10:19:40', '2024-01-16 10:19:40'),
	(8852, 10, 502, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8853, 10, 301, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8854, 10, 459, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8855, 10, 460, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8856, 10, 461, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8857, 10, 495, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8858, 10, 496, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8859, 10, 497, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8860, 10, 498, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8861, 10, 499, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8862, 10, 500, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8863, 10, 501, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8864, 10, 302, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8865, 10, 303, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8866, 10, 304, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8867, 10, 305, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8868, 10, 306, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8869, 10, 333, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8870, 10, 329, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8871, 10, 330, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8872, 10, 331, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8873, 10, 332, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8874, 10, 312, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8875, 10, 313, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8876, 10, 314, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8877, 10, 315, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8878, 10, 316, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8879, 10, 307, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8880, 10, 308, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8881, 10, 309, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8882, 10, 310, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8883, 10, 311, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8884, 10, 322, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8885, 10, 323, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8886, 10, 324, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8887, 10, 325, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8888, 10, 326, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8889, 10, 400, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8890, 10, 401, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8891, 10, 408, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8892, 10, 411, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8893, 10, 412, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8894, 10, 413, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8895, 10, 410, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8896, 10, 414, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8897, 10, 402, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8898, 10, 415, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8899, 10, 416, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8900, 10, 417, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8901, 10, 418, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8902, 10, 419, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8903, 10, 420, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8904, 10, 421, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8905, 10, 422, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8906, 10, 423, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8907, 10, 424, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8908, 10, 403, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8909, 10, 425, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8910, 10, 426, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8911, 10, 427, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8912, 10, 428, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8913, 10, 429, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8914, 10, 430, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8915, 10, 466, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8916, 10, 405, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8917, 10, 431, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8918, 10, 432, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8919, 10, 433, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8920, 10, 434, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8921, 10, 435, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8922, 10, 436, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8923, 10, 407, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8924, 10, 437, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8925, 10, 438, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8926, 10, 520, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8927, 10, 521, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8928, 10, 440, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8929, 10, 441, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8930, 10, 443, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8931, 10, 444, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8932, 10, 445, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8933, 10, 446, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8934, 10, 442, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8935, 10, 447, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8936, 10, 448, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8937, 10, 449, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8938, 10, 465, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8939, 10, 467, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8940, 10, 469, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8941, 10, 470, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8942, 10, 471, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8943, 10, 472, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8944, 10, 474, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8945, 10, 473, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8946, 10, 486, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8947, 10, 488, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8948, 10, 487, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8949, 10, 489, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8950, 10, 490, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8951, 10, 491, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8952, 10, 492, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8953, 10, 468, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8954, 10, 493, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8955, 10, 512, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8956, 10, 504, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8957, 10, 505, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8958, 10, 506, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8959, 10, 507, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8960, 10, 508, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8961, 10, 509, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8962, 10, 510, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8963, 10, 511, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8964, 10, 361, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8965, 10, 522, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8966, 10, 334, '2024-02-17 09:44:21', '2024-02-17 09:44:21'),
	(8967, 10, 464, '2024-02-17 09:44:21', '2024-02-17 09:44:21');

-- 导出  表 safeyz_t.b2_soft 结构
DROP TABLE IF EXISTS `b2_soft`;
CREATE TABLE IF NOT EXISTS `b2_soft` (
  `soft_id` int NOT NULL AUTO_INCREMENT COMMENT '软件id',
  `create_user_id` int NOT NULL,
  `soft_name` varchar(50) NOT NULL COMMENT '软件名称',
  `soft_code` varchar(50) NOT NULL COMMENT '软件识别码',
  `soft_key` varchar(50) NOT NULL COMMENT '软件密钥',
  `soft_extend` longtext COMMENT '扩展数据内容',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`soft_id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft 的数据：~1 rows (大约)
INSERT INTO `b2_soft` (`soft_id`, `create_user_id`, `soft_name`, `soft_code`, `soft_key`, `soft_extend`, `create_time`, `update_time`) VALUES
	(1, 1, '安全宝网络验证Plus🍓', 'n!Y5I0NgtOVhNbhA', 'RyF75o%4o%QlcmlyxInqNyYgC2l6Link', 'a:33:{s:11:"soft_status";i:0;s:9:"soft_whgg";N;s:11:"soft_notice";s:252:"测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容测试公告内容";s:10:"login_type";i:2;s:11:"charge_type";i:4;s:16:"login_force_type";i:1;s:9:"soft_jump";i:180;s:11:"endata_type";i:1;s:9:"sign_type";i:1;s:11:"sign_client";s:20:"123[data]456[key]789";s:11:"sign_server";s:20:"987[data]654[key]321";s:8:"md5_type";i:0;s:14:"rsa2_pluginkey";N;s:15:"rsa2_privatekey";N;s:7:"rc4_key";s:32:"XH21yFnyDtbNL6H70oxj0JW1nflghJlb";s:8:"reg_type";i:1;s:11:"reg_type_sl";s:1:"0";s:8:"reg_give";i:1;s:13:"reg_give_time";s:4:"1440";s:14:"reg_give_point";s:1:"0";s:14:"reg_give_limit";i:1;s:16:"reg_give_feature";s:3:"100";s:10:"trial_type";i:1;s:10:"trial_time";i:0;s:11:"trial_point";s:3:"100";s:9:"bind_type";i:1;s:11:"unbind_type";i:1;s:14:"unbinds_switch";i:1;s:16:"unbinds_switch_1";i:1;s:16:"unbinds_switch_2";i:1;s:11:"unbind_time";s:3:"100";s:12:"unbind_point";s:1:"0";s:9:"open_type";i:1;}', '2023-11-14 12:40:11', '2024-02-20 07:13:23');

-- 导出  表 safeyz_t.b2_soft_api_log 结构
DROP TABLE IF EXISTS `b2_soft_api_log`;
CREATE TABLE IF NOT EXISTS `b2_soft_api_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `soft_user_id` int DEFAULT NULL,
  `api_url` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `api_name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `enc_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `decr_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `from_ver` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `from_mac` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_api_log 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_carmi 结构
DROP TABLE IF EXISTS `b2_soft_carmi`;
CREATE TABLE IF NOT EXISTS `b2_soft_carmi` (
  `carmi_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL COMMENT '软件id',
  `carmi_pch` varchar(100) NOT NULL COMMENT '批次号',
  `making_user_id` int DEFAULT NULL COMMENT '制卡人id(User表)',
  `making_money` varchar(20) DEFAULT '0.00' COMMENT '制卡价格',
  `making_rebate` varchar(100) DEFAULT NULL COMMENT '制卡时给上级的提成',
  `making_rebate_agent` int DEFAULT NULL COMMENT '制卡提成的代理id(User表)',
  `carmi_status` int DEFAULT '0' COMMENT '充值卡状态(0未使用 1已售出 2已使用 3已失效 4已锁卡)',
  `carmi_str` varchar(200) NOT NULL COMMENT '充值卡号',
  `carmi_name` varchar(100) NOT NULL COMMENT '卡种名称',
  `carmi_time` varchar(100) DEFAULT '0' COMMENT '充值时间(分钟)',
  `carmi_point` varchar(50) DEFAULT '0' COMMENT '充值点数',
  `carmi_opening` int DEFAULT '1' COMMENT '多开数量',
  `carmi_bind` int DEFAULT '1' COMMENT '绑定数量',
  `carmi_unbind` varchar(100) DEFAULT '-1|-1|-1|-1' COMMENT '解绑次数',
  `carmi_data_extra` longtext COMMENT '附加数据',
  `carmi_notes` text COMMENT '充值卡备注',
  `use_soft_user_id` int DEFAULT NULL COMMENT '充值软件用户id',
  `use_time` timestamp NULL DEFAULT NULL COMMENT '充值时间',
  `use_endtime` timestamp NULL DEFAULT NULL COMMENT '额外拓展到期时间功能,从充值卡被充值后开始计时',
  `use_point` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0',
  `soft_carmit_id` int NOT NULL COMMENT '关联卡类id',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`carmi_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_carmi 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_carmit 结构
DROP TABLE IF EXISTS `b2_soft_carmit`;
CREATE TABLE IF NOT EXISTS `b2_soft_carmit` (
  `carmit_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL COMMENT '软件id',
  `carmit_name` varchar(100) NOT NULL COMMENT '卡种名称',
  `carmit_time` varchar(100) DEFAULT '0' COMMENT '充值时间(分钟)',
  `carmit_point` varchar(50) DEFAULT '0' COMMENT '充值点数',
  `carmit_opening` int DEFAULT '1' COMMENT '多开数量',
  `carmit_bind` int DEFAULT '1' COMMENT '绑定数量',
  `carmit_unbind` varchar(100) DEFAULT '-1|-1|-1|-1' COMMENT '解绑次数',
  `carmit_length` int DEFAULT '32' COMMENT '充值卡长度',
  `carmit_prefix` varchar(100) DEFAULT NULL COMMENT '充值卡卡头',
  `carmit_data_extra` longtext COMMENT '附加数据',
  `carmit_notes` text COMMENT '充值卡备注',
  `carmit_money` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0.00' COMMENT '制卡基础价格',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`carmit_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_carmit 的数据：~1 rows (大约)
INSERT INTO `b2_soft_carmit` (`carmit_id`, `create_user_id`, `soft_id`, `carmit_name`, `carmit_time`, `carmit_point`, `carmit_opening`, `carmit_bind`, `carmit_unbind`, `carmit_length`, `carmit_prefix`, `carmit_data_extra`, `carmit_notes`, `carmit_money`, `create_time`, `update_time`) VALUES
	(1, 1, 1, '测试天卡', '1440', '0', 1, 1, '-1|-1|-1|-1', 32, 'TK-', '{ "api":"userInfo", "count":1 }', '啊啊啊', '1.5', '2023-12-14 04:38:26', '2024-01-25 14:45:33');

-- 导出  表 safeyz_t.b2_soft_cookie 结构
DROP TABLE IF EXISTS `b2_soft_cookie`;
CREATE TABLE IF NOT EXISTS `b2_soft_cookie` (
  `cookie_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT '软件用户id',
  `soft_id` int NOT NULL COMMENT '软件id',
  `soft_version` varchar(100) NOT NULL COMMENT '软件版本',
  `login_account` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '登录账号',
  `login_type` int NOT NULL COMMENT '登录方式(0账户 1卡串)',
  `login_cookie` varchar(200) NOT NULL COMMENT '登录凭据',
  `login_feature` varchar(200) DEFAULT NULL COMMENT '登录特征数据',
  `login_ip` varchar(100) DEFAULT NULL COMMENT '登录IP地址',
  `login_mac` varchar(200) DEFAULT NULL COMMENT '登录mac地址',
  `client_id` varchar(200) NOT NULL COMMENT '客户端id',
  `client_os` varchar(200) NOT NULL COMMENT '客户端系统',
  `temp_data` longtext COMMENT '临时读写数据',
  `login_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '登录时间',
  `heart_time` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '心跳时间',
  `soft_jump` int DEFAULT '180' COMMENT '软件心跳周期',
  PRIMARY KEY (`cookie_id`)
) ENGINE=InnoDB AUTO_INCREMENT=100 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_cookie 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_notice 结构
DROP TABLE IF EXISTS `b2_soft_notice`;
CREATE TABLE IF NOT EXISTS `b2_soft_notice` (
  `notice_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `notice_top` int NOT NULL DEFAULT '0',
  `notice_type` varchar(20) NOT NULL DEFAULT 'primary',
  `notice_title` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `notice_info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`notice_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_notice 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_user 结构
DROP TABLE IF EXISTS `b2_soft_user`;
CREATE TABLE IF NOT EXISTS `b2_soft_user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL COMMENT '软件id',
  `agent_id` int DEFAULT NULL COMMENT '绑定代理id',
  `user_type` int NOT NULL COMMENT '用户类型(0账号 1单码)',
  `user_account` varchar(100) NOT NULL COMMENT '账号&单码',
  `user_pass` varchar(100) DEFAULT NULL COMMENT '密码',
  `user_status` int DEFAULT '0' COMMENT '0正常 1封禁 2冻结',
  `endtime` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '到期时间',
  `point` varchar(50) DEFAULT '0' COMMENT '点数余额',
  `opening` int DEFAULT '1' COMMENT '通道数量',
  `bind` int DEFAULT '1' COMMENT '绑定数量',
  `unbind` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '-1|-1|-1|-1' COMMENT '解绑次数',
  `data_extra` longtext COMMENT '附加数据',
  `data_cloud` longtext COMMENT '云端数据',
  `reg_ip` varchar(50) DEFAULT NULL COMMENT '注册IP地址',
  `reg_mac` varchar(50) DEFAULT NULL COMMENT '注册机器码',
  `reg_feature` varchar(200) DEFAULT NULL,
  `reg_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '登录时间',
  `heart_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP COMMENT '心跳时间',
  `abnormal_time` timestamp NULL DEFAULT NULL COMMENT '异常时间(封禁&冻结)',
  `author_deduct_time` date DEFAULT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_user 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_user_feature 结构
DROP TABLE IF EXISTS `b2_soft_user_feature`;
CREATE TABLE IF NOT EXISTS `b2_soft_user_feature` (
  `feature_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `user_id` int NOT NULL COMMENT '软件用户id(SoftUser表)',
  `feature` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT '特征信息',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`feature_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_user_feature 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_user_log 结构
DROP TABLE IF EXISTS `b2_soft_user_log`;
CREATE TABLE IF NOT EXISTS `b2_soft_user_log` (
  `log_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `user_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `user_endtime` datetime DEFAULT CURRENT_TIMESTAMP,
  `user_point` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `log_type` int NOT NULL COMMENT '日志类型（1登录软件 1解绑特征 2充值账户 3绑定特征 4扣时扣点 5注销登录）',
  `log_data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `log_ip` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `log_mac` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `soft_ver` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `create_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`log_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_user_log 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_soft_variable 结构
DROP TABLE IF EXISTS `b2_soft_variable`;
CREATE TABLE IF NOT EXISTS `b2_soft_variable` (
  `id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `v_key` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `v_value` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `v_type` int DEFAULT '0',
  `v_read` int DEFAULT '0',
  `v_write` int DEFAULT '0',
  `v_alter` int DEFAULT '0',
  `v_del` int DEFAULT '0',
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_variable 的数据：~2 rows (大约)
INSERT INTO `b2_soft_variable` (`id`, `create_user_id`, `soft_id`, `v_key`, `v_value`, `v_type`, `v_read`, `v_write`, `v_alter`, `v_del`, `create_time`, `update_time`) VALUES
	(1, 1, 1, '123123', '132', 1, 4, 0, 0, 1, '2024-01-16 12:24:22', '2024-02-01 15:21:08'),
	(7, 1, 1, '测试变量', '1111111111111', 0, 2, 2, 1, 1, '2024-02-03 11:54:36', '2024-02-03 11:56:32');

-- 导出  表 safeyz_t.b2_soft_version 结构
DROP TABLE IF EXISTS `b2_soft_version`;
CREATE TABLE IF NOT EXISTS `b2_soft_version` (
  `version_id` int NOT NULL AUTO_INCREMENT,
  `create_user_id` int NOT NULL,
  `soft_id` int NOT NULL,
  `version` varchar(50) NOT NULL COMMENT '版本号',
  `md5` varchar(50) DEFAULT NULL COMMENT '版本摘要',
  `url` varchar(200) DEFAULT NULL COMMENT '下载地址',
  `log` text COMMENT '更新日志',
  `nversion` varchar(50) DEFAULT NULL COMMENT '牵引版本号(旧)',
  `gxfs` int DEFAULT '0' COMMENT '更新方式(0选择 1强制)',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`version_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_soft_version 的数据：~1 rows (大约)
INSERT INTO `b2_soft_version` (`version_id`, `create_user_id`, `soft_id`, `version`, `md5`, `url`, `log`, `nversion`, `gxfs`, `create_time`, `update_time`) VALUES
	(14, 1, 1, 'V1', '', '', '', '', 1, '2024-01-08 13:38:47', '2024-01-25 12:50:13');

-- 导出  表 safeyz_t.b2_user 结构
DROP TABLE IF EXISTS `b2_user`;
CREATE TABLE IF NOT EXISTS `b2_user` (
  `user_id` int NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `create_user_id` int DEFAULT NULL,
  `agent_id` int DEFAULT NULL COMMENT '上级代理',
  `open_agent` int DEFAULT '1' COMMENT '允许子代',
  `user_type` int DEFAULT '1' COMMENT '0平台级别账户 (非0为其他类型账户)',
  `username` varchar(100) NOT NULL COMMENT '账号',
  `password` varchar(200) NOT NULL COMMENT '密码',
  `status` int NOT NULL DEFAULT '0' COMMENT '状态, 0正常, 1冻结',
  `nickname` varchar(200) NOT NULL COMMENT '昵称',
  `avatar` varchar(200) DEFAULT NULL COMMENT '头像',
  `sex` int DEFAULT '1' COMMENT '性别',
  `phone` varchar(20) DEFAULT NULL COMMENT '手机号',
  `email` varchar(200) DEFAULT NULL COMMENT '邮箱',
  `email_verified` int NOT NULL DEFAULT '0' COMMENT '邮箱是否验证, 0否, 1是',
  `introduction` varchar(200) DEFAULT NULL COMMENT '个人简介',
  `address` varchar(200) DEFAULT NULL,
  `tell` int DEFAULT NULL,
  `tell_pre` int DEFAULT NULL,
  `real_name` varchar(200) DEFAULT NULL COMMENT '真实姓名',
  `id_card` varchar(200) DEFAULT NULL COMMENT '身份证号',
  `birthday` date DEFAULT NULL COMMENT '出生日期',
  `login_cookie` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '登录cookie',
  `login_time` timestamp NULL DEFAULT NULL COMMENT '登录时间',
  `money` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0.00' COMMENT '账户余额',
  `consume` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0.00' COMMENT '账户消费',
  `money_2` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT '0.00' COMMENT 'CPU电量',
  `rebate` varchar(100) DEFAULT '0.00' COMMENT '获得提成',
  `author_code` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT '账户识别码',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '注册时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_user 的数据：~1 rows (大约)
INSERT INTO `b2_user` (`user_id`, `create_user_id`, `agent_id`, `open_agent`, `user_type`, `username`, `password`, `status`, `nickname`, `avatar`, `sex`, `phone`, `email`, `email_verified`, `introduction`, `address`, `tell`, `tell_pre`, `real_name`, `id_card`, `birthday`, `login_cookie`, `login_time`, `money`, `consume`, `money_2`, `rebate`, `author_code`, `create_time`, `update_time`) VALUES
	(1, 1, NULL, NULL, 0, 'admin', '$2a$01$949ba59a.ZDNjMjlhM2E2MjkyODBlNjg2Y2YwYzNm', 0, '樱岛奈子', NULL, 2, '12345678914', '3233333304@qq.com', 0, '888888888', '', 43, 752, NULL, NULL, '2023-11-02', '1e88801330bdce77c85ab3a738f79022', '2024-02-21 01:29:28', '660', '340', '225.69', '0.00', 'Nq4inC0rNwKw', '2023-11-02 08:46:20', '2024-02-21 13:29:35');

-- 导出  表 safeyz_t.b2_user_file 结构
DROP TABLE IF EXISTS `b2_user_file`;
CREATE TABLE IF NOT EXISTS `b2_user_file` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int NOT NULL COMMENT '用户id',
  `name` varchar(200) DEFAULT NULL COMMENT '文件名称',
  `is_directory` int DEFAULT NULL COMMENT '是否是文件夹',
  `parent_id` int DEFAULT NULL COMMENT '上级id',
  `path` varchar(400) DEFAULT NULL COMMENT '文件路径',
  `length` int DEFAULT NULL COMMENT '文件大小',
  `content_type` varchar(80) DEFAULT NULL COMMENT '文件类型',
  `deleted` int NOT NULL DEFAULT '0' COMMENT '是否删除, 0否, 1是',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='用户文件';

-- 正在导出表  safeyz_t.b2_user_file 的数据：~0 rows (大约)

-- 导出  表 safeyz_t.b2_user_role 结构
DROP TABLE IF EXISTS `b2_user_role`;
CREATE TABLE IF NOT EXISTS `b2_user_role` (
  `id` int NOT NULL AUTO_INCREMENT COMMENT '主键id',
  `user_id` int NOT NULL COMMENT '用户id',
  `role_id` int NOT NULL COMMENT '角色id',
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '修改时间',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci ROW_FORMAT=DYNAMIC COMMENT='用户角色';

-- 正在导出表  safeyz_t.b2_user_role 的数据：~1 rows (大约)
INSERT INTO `b2_user_role` (`id`, `user_id`, `role_id`, `create_time`, `update_time`) VALUES
	(240, 1, 10, '2024-02-05 15:52:39', '2024-02-05 15:52:39');

-- 导出  表 safeyz_t.b2_website 结构
DROP TABLE IF EXISTS `b2_website`;
CREATE TABLE IF NOT EXISTS `b2_website` (
  `id` int NOT NULL AUTO_INCREMENT,
  `web_key` varchar(200) NOT NULL,
  `web_value` text NOT NULL,
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- 正在导出表  safeyz_t.b2_website 的数据：~13 rows (大约)
INSERT INTO `b2_website` (`id`, `web_key`, `web_value`, `create_time`, `update_time`) VALUES
	(2, 'kfqq', '2408312005', '2023-12-19 15:15:14', '2023-12-23 09:14:41'),
	(3, 'weburl', 'https://www.safeyz.com', '2023-12-19 15:15:14', '2024-01-15 07:25:05'),
	(4, 'webstatus', '1', '2023-12-19 15:15:14', '2024-01-15 07:24:57'),
	(5, 'role_id_agent', '15', '2023-12-21 11:30:18', '2023-12-23 09:14:54'),
	(7, 'role_id_author', '17', '2024-01-17 08:23:19', '2024-01-17 08:23:19'),
	(8, 'reg_author', '0', '2024-01-17 08:23:19', '2024-01-25 14:56:49'),
	(9, 'skey', 'f6db1ef4.7e1ff932f1e394d16967124c', '2024-02-05 13:14:54', '2024-02-05 13:14:54'),
	(10, 'soft_user_usemoney', '0.02', '2024-02-05 13:14:54', '2024-02-05 13:15:25'),
	(11, 'soft_charge', '100', '2024-02-08 10:35:22', '2024-02-08 15:15:30'),
	(12, 'pan_file_type', 'image/png,image/jpeg,image/pjpeg,image/x-png,image/gif,text/plain,application/octet-stream,application/octet-stream,application/zip,application/x-msdownload', '2024-02-17 07:54:55', '2024-02-20 08:30:53'),
	(13, 'pan_file_size', '20', '2024-02-17 07:54:55', '2024-02-20 08:42:53'),
	(15, 'pan_file_max_size', '50', '2024-02-17 07:54:55', '2024-02-20 08:31:03'),
	(16, 'pan_file_exename', 'jpg,gif,png,exe,dll,txt,zip,rar,7z', '2024-02-18 05:19:54', '2024-02-18 05:19:54');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
