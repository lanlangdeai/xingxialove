<?php 
namespace app\index\model;

use think\Model;
use think\Db;
/**
 * 相关测试功能
 */
class Test extends Model
{
	public function getAccount($id)
	{
		$sql = 'select 1 from `account` where id= :id';
		$ret = Db::query($sql,['id'=>$id]);
		dump($ret);die;
		return $ret ? true: false;
	}
}