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