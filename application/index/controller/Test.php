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
	public function table()
	{
		$table = 'message';
		$userId = 'user18991';
		// $ret = $this->doHash($table,$userId);
		// echo $ret;
		$user = 30;
		$total = 4;
		// echo $this->hash_table($table,$user,$total);
		echo $this->get_hash($user);
	}

	// hash分表
	public function doHash($table,$userid)
	{
		 $str = crc32($userid);  
		 if($str<0){  
			 $hash = "0".substr(abs($str), 0, 1);  
		 }else{  
			 $hash = substr($str, 0, 2);  
		 }  
		  
		 return $table."_".$hash;
	}
	// hash 算法  位数规定
	public function get_hash($id){
		$str = bin2hex($id);
		$hash = substr($str, 0, 4);
		if (strlen($hash)<4){
		$hash = str_pad($hash, 4, "0");
		}
		return $hash;
	}
	/**
	 * 取模分表
	 * @param  [type] $table_name 表名
	 * @param  [type] $user_id    用户id
	 * @param  [type] $total      分表总数量
	 */
	public function hash_table($table_name,$user_id,$total)
	{
		return $table_name.'_'.(($user_id % $total) + 1);
	}

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






