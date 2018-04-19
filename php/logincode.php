<!-- http://demo.open.weixin.qq.com/jssdk/sample.zip -->


<?php
	
	$code = $_GET['code'];

	$appid = 'wxaeffebcfe95ba2ad';
	$appsecret ='961b3ecafe8469cbb4cd43cb4e002a9d';

	$api = 'https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$appsecret}&js_code={$code}&grant_type=authorization_code';


?>