<?php 
namespace app\index\controller;

use app\common\controller\Common;
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
		$name = 'name';
		
		$value = 'xing';

	}
}






