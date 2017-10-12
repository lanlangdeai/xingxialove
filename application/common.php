<?php
/**
 * 应用公共文件
 *
 * X-wolf
 *
 * 2017/9/21
 */

// 友好输出
if(!function_exists('p')){
	function p($value,$is_die = true)
	{
		echo '<pre>';
		print_r($value);
		echo '</pre>';
		$is_die && die();
	}
}
// 普通输出
if(!function_exists('e')){
	function e($value,$is_die = true)
	{
		echo $value;
		$is_die && die();
	}
}

// 错误输出
if(!function_exists('error')){
	function error(){

	}
}

// 正确输出
if(!function_exists('success')){
	function success()
	{

	}
}
// 生成签名
if(!function_exists('generateSign')){
	function generateSign($data = [])
	{
		if(!$data || !isAssocArr($data)) return false;
		$sign = [];
		asort($data);
		foreach($data as $k=>$v){
			$sign[] = $k.'='.$v;
		}
		return sha1(implode('&',$sign));
	}
}
// 生成随机数
if(!function_exists('generateRandStr')){
	function generateRandStr()
	{
		$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
	    $str = "";
	    for ($i = 0; $i < $length; $i++) {
	      $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
	    }
	    return $str;
	}
}
// 是否是关联数组
if(!function_exists('isAssocArr')){
	function isAssocArr($arr)
	{
		return array_diff_assoc(array_keys($arr), range(0,sizeof($arr))) ? true : false;
	}
}