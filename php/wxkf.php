<?php
header("content-type:text/plain; charset=utf-8"); //添加这行 text/plain
define("TOKEN", "davidkorea");
$wechatObj = new wechatCallbackapiTest();
// $wechatObj->valid(); 
$wechatObj->responseMsg();

class wechatCallbackapiTest
{
    public function valid()
    {
        $echoStr = $_GET["echostr"];

        //valid signature , option
        if($this->checkSignature())
        {
           // header('content-type:text');//再添加这行
            ob_clean();
            echo $echoStr;
            exit;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr))
        {
            libxml_disable_entity_loader(true);
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $openid = trim($postObj->FromUserName);
            $content = trim($postObj->Content);

            $appid = 'wxaeffebcfe95ba2ad';
            $appsecret ='961b3ecafe8469cbb4cd43cb4e002a9d';

            //https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140183
            $getTokenApi = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$appid}&secret={$appsecret}"; 

            $resultStr = $this->httpGet($getTokenApi);

            $arr = json_decode($resultStr,true);
            //2000times one day, each access_token can be used for 2hours
            $token = $arr['access_token'];

            $postMsgApi = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token={$token}";
            if ($content == "price"){
                $data = array("touser"=>$openid,"msgtype"=>"text","text"=>array("content"=>"the price is 100W"));
            }else if ($content == "hi") { $data = array("touser"=>$openid,"msgtype"=>"text","text"=>array("content"=>"hi! i'm david"));           
            }else{
                $data = array("touser"=>$openid,"msgtype"=>"text","text"=>array("content"=>"hi! Welcome~"));
            }

            foreach ($data as $key => $value) {
                if ($key == "text") {
                    $data["text"]["content"] = urlencode($value["content"]);
                }
            }
            $json = urldecode(json_encode($data));
            $str = $this->httpPost($json,$postMsgApi);

            echo $str;

            // $fromUsername = $postObj->FromUserName;
            // $toUsername = $postObj->ToUserName;
            // $keyword = trim($postObj->Content);
            // $time = time();
            // $textTpl = "<xml>
            //     <ToUserName><![CDATA[%s]]></ToUserName>
            //     <FromUserName><![CDATA[%s]]></FromUserName>
            //     <CreateTime>%s</CreateTime>
            //     <MsgType><![CDATA[%s]]></MsgType>
            //     <Content><![CDATA[%s]]></Content>
            //     <FuncFlag>0</FuncFlag>
            //     </xml>";             
        //     if(!empty( $keyword ))
        //     {
        //         $msgType = "text";
        //         $contentStr = "Welcome to wechat world!";
        //         $resultStr = sprintf($textTpl, $fromUsername, $toUsername, $time, $msgType, $contentStr);
        //         echo $resultStr;
        //     }
        //     else
        //     {
        //         echo "Input something...";
        //     }
        // }
        else
        {
            echo "";
            exit;
        }
    }

    public function httpPost($data,$url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $temInfo = curl_exec($ch);
        if (curl_errno($ch)) {
            return curl_error($ch)
        }
        curl_close($ch);
        return $temInfo;
    }

    public function httpGet($url) {
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


    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];    

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature )
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}

?>