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
		$ticket = 'HoagFKDcsGMVCIY2vOjf9n8hrde0I1ZhqT6aHh9Ij7YqytXCGcsbdDQCqshJ_j1XM1SIpbNAdkR_W2FLP4g1IQ';
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
		if(!$ticket){
			$accessToken = Base::getAccessToken();
			$ticket = $this->getTicket($accessToken);
			if(!$ticket) return false; //获取ticket失败
			Cache::set($key,$ticket,self::JSAPI_TICKET_EXPIRE_IN);
		}
		return $ticket; 
	}
	
	private function getTicket($accessToken)
	{
		$api = 'https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi';
		$url = sprintf($api,$accessToken);
		$data = json_decode(Util::http_get($url));
		return isset($data->ticket) ? $data->ticket : '';
	}
}