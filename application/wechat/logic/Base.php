<?php 
namespace app\wechat\logic;

use app\common\controller\Common;
/**
 * 所有微信模块下的Logic处理基类
 */
class Base extends Common
{
		//数据处理
	public static function handleData()
	{
		
		$data = file_get_contents('php://input');

		$ret = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA | LIBXML_NOBLANKS);

		if(FALSE === $ret){
			Log::error('接收微信推送数据并解析失败. 数据: '.$ret);
			return false;
		}

		return json_encode($ret);

	}

    // 获取access_token
    private function getAccessToken($appId,$appSecret)
    {
    	
    }

    //验证签名
	private static function checkSign()
	{
		if( !(input('?get.signature') && input('?get.timestamp') && input('?get.nonce'))) return false;

		$data = [
			input('get.timestamp'),
			input('get.nonce'),
			config('wechat.token')
		]; 
		
		sort($data,SORT_STRING);

		return input('get.signature') == sha1(implode($data));
	}
}