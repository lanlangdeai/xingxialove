<?php 
namespace app\index\controller;

use app\common\controller\Common;
use think\Cache;
use lib\Util;
use app\index\model\Test as TestModel;
/**
 * 相关测试功能
 */
class Test extends Common
{
	public function phpinfo()
	{
		echo phpinfo();
	}
	public function server()
	{
		dump($_SERVER);
	}

	public function cache()
	{
		// $name = 'name';
		
		// $value = 'xing';
		// echo Cache::get($name);
		$name = 'sex';
		$value = 1;
		// Cache::set($name,$value,120);
		echo Cache::get($name);
	}

	public function time()
	{
		echo NOW;
	}

	// 测试图像的数据流存储
	public function img()
	{	
		// $toFile = './test.txt';
		// 将图片转化成数据流形式
		$file = './static/test.png';
		// 由文件或URL创建一个新图像
		$img = imagecreatefrompng($file);
		// 保存alpha信息(设置初始信息)
		imagealphablending($img, false);
		imagesavealpha($img, true);
		ob_start();
		imagepng($img);
		$contents = ob_get_contents();
		ob_end_clean();
		//可以将数据保存在文件或数据库中 base64_encode($contents);
		// $ret = file_put_contents($toFile, base64_encode($contents)); 
		// p($ret); 成功之后 返回字节数: 139364  否则 返回false
		$api = 'http://xingxialove.net/index/test/saveImg';
		$ret = Util::http_post_curl($api,$contents);
		p($ret);
	}
	//接受图片数据流 
	public function saveImg()
	{
		$img = './new.png'; 
		$stream = file_get_contents('php://input');
		file_put_contents($img, $stream);
	}
	// 测试curl相关方法
	public function curl()
	{
		$ch = curl_init();
		$url = 'http://www.yahoo.com/';
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_exec($ch);
		if(!curl_errno($ch)){
			$info = curl_getinfo($ch); //获取一个curl链接句柄的信息
			print_r($info);
		}
		curl_close($ch);
	}

	public function db()
	{

		$id = 2;
		$model = new TestModel();
		$ret = $model->getAccount($id);
		dump($ret);
	}
}






