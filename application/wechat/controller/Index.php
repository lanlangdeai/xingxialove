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
			echo input(input('?get.echostr'));
			exit();
		}

		$this->handleData();		

		// $this->response();
	}

	public function handleData()
	{
		
		$data = file_get_contents('php://input');

		$ret = simplexml_load_string($data,'SimpleXMLElement',LIBXML_NOCDATA | LIBXML_NOBLANKS);

		if(FALSE === $ret){
			Log::error('接收微信推送数据并解析失败. 数据: '.$ret);
			echo '';
			exit();
		}

		print_r($ret);die;

	}

	public function response()
    {

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