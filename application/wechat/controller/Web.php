<?php
namespace app\wechat\controller;

use app\common\controller\Common;
use app\wechat\logic\Web as WebLogic;
/**
 * 微信网页相关功能
 *
 * X-wolf
 *
 * 2017/10/12
 */
class Web extends Common
{
	// 首页
	public function index()
	{
		$web = new WebLogic();
		$data = $web->jsSdk();
		return view('index',['data'=>$data]);
	}
	// 分享
	public function share()
	{
		return view();
	}
}