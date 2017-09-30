<?php
namespace app\index\controller;

use app\common\controller\Common;
use think\Cache;
class Index extends Common
{

    public function index()
    {
        return 'Xia,I Love You';
    }

    public function cache()
    {
    	$name = 'name';
    	$value = 'xing';
    	Cache::get($name);die;
    	Cache::set($name,$value);
    }

}
