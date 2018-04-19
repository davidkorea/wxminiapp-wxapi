# wxminiapp-wxapi

> wxaeffebcfe95ba2ad

# reference
[微信小程序全方位深度解析-Chapter 15](http://study.163.com/course/courseMain.htm?courseId=1003283028)

# Issue 1 - SAE setup

 
* 应用-代码管理

    * php files  
    
    * the file that you want to download should be saved here
 
* 存储与CDN服务-Storage

    * file that has been uploaded is saved here

# Issue 2 - 40013 invalid appid

 The params in url should be covered by "" instead of '', even thought the vars could be declared by ''.
 
 ```php
$code = $_GET['code'];
$appid = 'wx------2ad';
$appsecret ='9----------------9d';

//params covered by '' could not be resolved!!!!!!!!!!
$api = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$appsecret}&js_code={$code}&grant_type=authorization_code";
 ```
