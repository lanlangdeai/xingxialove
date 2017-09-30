<?php
namespace app\wechat\logic;

use app\common\controller\Common;
use lib\Util;
/**
 * 菜单相关操作
 *
 * X-wolf
 *
 * 2017/9/30
 */
class Menu extends Common
{
	// 创建菜单
	public static function create($menu)
	{
		if(!$menu || !is_object($menu)) return false;

		$accessToken = Base::getAccessToken();

		if(!$accessToken) return false; //生成菜单失败

		return self::doCreate($accessToken,$menu);
	}
	//菜单创建
	private static function doCreate($accessToken , $menu)
	{
		$api = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token=';
		$url = $api.$accessToken;
		$ret = json_decode(json_encode(Util::http_post_curl($url,$menu)),true);
		return isset($ret['errmsg']) && $ret['errmsg'] == 'ok' ? true : false;
	}
}