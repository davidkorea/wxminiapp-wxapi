<?php

  function httpPost($data,$url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $temInfo = curl_exec($ch);
    if (curl_errno($ch)) {
        return curl_error($ch);  //分号不能少
    }
    curl_close($ch);
    return $temInfo;
  }

  function httpGet($url) {
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_TIMEOUT, 500);
    // 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, true);
    curl_setopt($curl, CURLOPT_URL, $url);

    $res = curl_exec($curl);
    curl_close($curl);

    return $res;
  }


  $openid = $_GET["openid"];
  $formId = $_GET["formId"];
  $name = $_GET["name"];
  $date = $_GET["date"];
  $time = $_GET["time"];
  $site = $_GET["site"];
  $seat = $_GET["seat"];

  $templateid = "xouu1JpXWIMlF0kff0nSFOJKE-oHXR9XUa4eJEACdW0";

  $data = <<<EOF
     {
        "touser": "{$openid}",
        "template_id": "{$templateid}",
        "page": "index",
        "form_id": "{$formId}",
        "data": {
            "keyword1": {
                "value": "{$name}",
                "color": "#173177"
            },
            "keyword2": {
                "value": "{$date}",
                // "color": "#173177"
            },
            "keyword3": {
                "value": "{$time}",
                // "color": "#173177"
            } ,
            "keyword4": {
                "value": "{$site}",
                // "color": "#173177"
            }
            "keyword5": {
                "value": "{$seat}",
                // "color": "#173177"
            }
        },
        "emphasis_keyword": "keyword1.DATA"
      }
    EOF;

    $appid = "wxaeffebcfe95ba2ad";
    $appsecret ="961b3ecafe8469cbb4cd43cb4e002a9d";
    $getTokenApi = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}";
    $resultStr = $this->httpGet($getTokenApi);
    $arr = json_decode($resultStr,true);
    $token = $arr["access_token"];
    //发送模板消息的api
    $templateApi = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token={$token}";
    $res = httpPost($data, $templateApi);



 ?>
