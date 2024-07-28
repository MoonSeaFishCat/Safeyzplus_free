# Safeyzplus_free

>>备注：本项目原为开源项目 有人二开并且进行倒卖，因此，本验证转为闭源，并开源二开的版本代码。在原作者的许可下，本人代为开源，基于Agplv3协议开源处理
这里点名批评
https://www.apibug.com/code/webcode/2554.html
二开改版权，变成自己开发的，改成付费验证二次出售
******************************************************

##  验证介绍
安全宝网络验证针对的是平台级的多作者账户的验证(可用于运营或个人使用)，界面美观，功能强大
该验证的用户机制区别于所有验证（该验证可以绑定多个机器码或者IP地址）
用户前端：eleadmin
开发环境：PHP8.0 + MySQL5.7


## 验证更新日志
### V1.0.2
社区版/旗舰版框架:1.1.72024-01-22 12:12

- 1.[修复] 已知所有小问题

- 2.[删除] 站点管理->账户管理中的导入功能

- 3.[新增] 用户管理->用户列表中的导入功能(可迁移其他验证的用户数据到安全宝系统内)

- 4.[新增] 网盘容量管理,具体配置在站点管理->系统设置内

- 5.[优化] 系统设置界面,分类显示

- 6.[新增] 软件用户登陆按量扣除CPU电量

- 7.[优化] 缩减前端文件大小,删除字体文件

- 8.[修复] 无法生成卡号的问题(之前小遗漏,忘了添加字段导致的)

- 9.[新增] 项目管理->网盘管理显示网盘容量上限和已用容量

- 10.[新增] 软件列表显示每个软件的独立公告列表链接(可直接用于内嵌显示)

### V1.0.1
社区版/旗舰版框架:1.1.72023-12-25 14:30

- 1.后端接口完成

- 2.前端框架完成

- 3.客户端基础接口完成


## 接口文档地址
https://apifox.com/apidoc/shared-e8a8823b-a832-4bfb-a542-8afa8acf2bb4
## 详细安装教程
# 详细安装教程
## 前端安装教程
1.宝塔新建站点，php设置为纯静态，不建立数据库
2.上传前端的全部文件并解压
3.打开根目录的index.html文件，进行如下配置
(配置后端接口地址（必须）)
![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422688/image-preview)

:::tip
以下部分为必须操作内容，否则会页面刷新404
:::
4.设置前端伪静态内容为
“该部分用于解决界面刷新404，以及代理端404问题”

```
location / {
  if (!-e $request_filename) {
    rewrite  ^(.*)$ /index.html?s=/$1  last;
    break;
  }
}
```
如果没有宝塔面板
打开ngix的配置文件，修改内容
![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422695/image-preview)
5.启用gzip压缩
:::tip
该部分gzip 可以压缩 3-5 倍左右， 能够大幅度优化首屏加载的速度，项目已经配置了打包生成 gzip 文件，只需要给 nginx 增加如下配置：
:::
打开ngix的配置文件，修改内容
![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422689/image-preview)
以上为没有宝塔面板操作方法
### **宝塔面板操作方法如下**
软件商店→已安装→选择Nginx右侧的设置，选择性能调整，将gzip_comp_level改为3或者4

![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422690/image-preview)

![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422691/image-preview)

![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422692/image-preview)

![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422693/image-preview)
压缩级别，1压缩比最小处理速度最快，9压缩比最大但处理最慢，同时也最消耗CPU,一般设置为3就可以了
到此：前端安装完成

:::tip
如果启用ssl，需要前后同时开启ssl
:::
## 后端部分
1.宝塔新建站点，php选择8.0以上，mysql推荐8.0，5.6，5.7也可以使用
2.上传后端的全部文件
3.访问后端的域名

![image.png](https://api.apifox.com/api/v1/projects/4019769/resources/422694/image-preview)
如同所示，从上到下，依次操作，操作完毕后，访问前端域名会自动跳转到登录界面
默认后台用户名密码
安装完成后，后台账号密码默认：admin / 123456


