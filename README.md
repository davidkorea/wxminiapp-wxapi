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

# Issue 2 - customer services Token verify failed
 
Due to the offical php demo coded has been changed and fortunately wx_sample.php could be found online.

1. Still not sure what did work for it, but i do changed it and add some extra codes as below.

```php
+  header("content-type:text/plain; charset=utf-8"); //添加这行 text/plain

   ......
   
   public function valid()
       {
           $echoStr = $_GET["echostr"];
           if($this->checkSignature())
           {
_              // header('content-type:text');//再添加这行
+              ob_clean();
               echo $echoStr;
               exit;
           }
       }
   ......
```

2. One more thing is that the Token should be a little bit complicated. No all numbers, No too short...

> Reference: [微信公众平台修改服务器配置时token验证失败](https://bbs.csdn.net/topics/390991193)

# Issue 2 - template message

> define a piece of codes by <<<END...END

```php
$var<<<END
...
END;
//END: should be wroten at the very beginning of this row!!!!!

$resultStr = httpGet($getTokenApi);
//$resultStr = $this->httpGet($getTokenApi); 
//"Using $this when not in object context" if not in a Class, do not use $this->


```
