<?php 
namespace app\wechat\logic;

use app\common\controller\Common;
use app\wechat\model\Account as AccountModel;
use lib\Util;
use think\Cache;
use think\Log;
/**
 * 所有微信模块下的Logic处理基类
 */
class Base extends Common
{

	const EXPIRE_IN = 7100;

	//数据处理
	public static function handleData()
	{
		
		$data = file_get_contents('php://input');

		$ret = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA | LIBXML_NOBLANKS);

		if(FALSE === $ret){
			Log::error('接收微信推送数据并解析失败. 数据: '.$ret);
			return false;
		}
		Log::info('数据解析成功. '.json_encode($ret));
		return json_decode(json_encode($ret));

	}


    //验证签名
	public static function checkSign()
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

	// 获取access_token
    public static function getAccessToken()
    {
    	return Cache::get(config('keys.access_token')) ? : self::setAccessToken();
    }
    // 生成access_token
    public static function setAccessToken()
    {
    	$app_secret = AccountModel::getSecret(config('wechat_appid'));

    	$access_token = self::generateAccessToken(config('wechat_appid') , $app_secret);
    	
    	return $access_token ? Cache::set(config('keys.access_token'),$access_token,self::EXPIRE_IN) : '';
    }
    // 调取access_token
    private static function generateAccessToken($appId,$appSecret)
    {
    	$api = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s';

    	$url = sprintf($api,$appId,$appSecret);

    	$ret = json_decode(Util::urlGet($url),true);

    	return isset($ret['access_token']) ? $ret['access_token'] : '';
    }

}