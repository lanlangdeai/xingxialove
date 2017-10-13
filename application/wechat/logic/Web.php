<?php
namespace app\wechat\logic;
use think\Cache;
use lib\Util;
/**
 * 微信网页逻辑层
 */
class Web
{
	const JSAPI_TICKET_EXPIRE_IN = 7100; 

	//获取js-sdk相关配置信息 可将信息进行序列化处理
	public function jsSdk()
	{
		$ticket = $this->getJsApiTicket();

		// 动态获取
		$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' || $_SERVER['SERVER_PORT'] == 443 ) ? 'https://' : 'http://';
		$url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

		$timestamp = time();
		$nonceStr = generateRandStr();
		$data = [
			'jsapi_ticket'	=>	$ticket,
			'noncestr'		=>	$nonceStr,
			'timestamp'		=> 	$timestamp,
			'url'			=> 	$url
		];
		$signature = generateSign($data);
		unset($data);
		$data = compact('nonceStr','timestamp','url','signature');
		$data['appId'] = config('wechat.app_id');
		return $data;
	}
	// 获取jsapi-ticket(7200)
	private function getJsApiTicket()
	{
		$key = config('keys.jsapi_ticket');
		$ticket = Cache::get($key); 
		// echo $ticket;die;
		if(!$ticket){
			$accessToken = Base::getAccessToken();
			$ticket = $this->getTicket($accessToken);
			echo $ticket;die;
			if(!$ticket) return false; //获取ticket失败
			Cache::set($key,$ticket,self::JSAPI_TICKET_EXPIRE_IN);
		}
		return $ticket; 
	}
	
	private function getTicket($accessToken)
	{
		$api = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi';
		$url = sprintf($api,$accessToken);
		$data = Util::http_get($url);
		// $data = json_decode();
		dump($data);die;
		return isset($data->ticket) ? $data->ticket : '';
	}
}