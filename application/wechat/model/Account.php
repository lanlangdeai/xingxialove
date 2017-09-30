<?php 
namespace app\wechat\model;

use app\common\model\Common;

/**
 * 公众号账户model
 *
 * X-wolf
 *
 * 2017/9/30
 */
class Account extends Common
{
	public static function add($appId,$appSecret)
	{
		$account = new Account;
	
		$account->data([
			'app_id'	=> $appId,
			'app_secret'=> $appSecret,
			'comment'	=> '初始化公众号帐号数据'
		]);

		$ret = $account->save();

		return $ret ? true : false; 
	}
}