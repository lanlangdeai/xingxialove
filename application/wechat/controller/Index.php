<?php 

namespace app\wechat\controller;

use think\Controller;
use think\Log;
/**
 * 微信相关接口
 */
class Index extends Controller
{

	public function index()
	{
		if(!$this->checkSign()){
			Log::error('验证签名失败');
			return false;
		}
		if(input('?get.echostr')){
			return input('get.echostr');
		}
		echo '调用其他事件';
	}

	private function checkSign()
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





 ?>