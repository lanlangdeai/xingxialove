<?php 
namespace app\console\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\wechat\logic\Menu as MenuLogic;
/**
 * 创建菜单脚本
 *
 * X-wolf
 *
 * 2017/9/30
 */
class Menu extends Command
{
	protected function configure()
	{
		$this->setName('Menu')->setDescription('Generate Menu');
	}
	protected function execute(Input $input , Output $output)
	{
		$menu = $this->getMenu();
		$ret = MenuLogic::create($menu);
		echo $ret ? 'Success to generate menu' : 'Failure to generate menu';
	}

	private function getMenu()
	{
		$menu = [
			'button'	=> [
				[
					'type'	=> 'view',
					'name'	=> '首页',
					'url'	=> 'http://xingxialove.cn/index/index/index'
				],
				[
					'type'	=> 'view',
					'name'	=> '与我相关',
					'url'	=> 'http://xingxialove.cn/index/index/connectUs'
				]
			]
		];

		return json_decode(json_encode($menu));
	}
}