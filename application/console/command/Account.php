<?php
namespace app\console\command;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use app\wechat\model\Account as AccountModel;
/**
 * 创建公众号
 */
class Account extends Command
{
	private $appId = '';

	private $appSecret = '';

	protected function configure()
	{
		$this->setName('Account')->setDescription('Create Account');
	}

	protected function execute(Input $input, Output $output)
	{
		$ret = AccountModel::add($this->appId,$this->appSecret);

		echo $ret ? 'Add account success' : 'Add account failure';
	}
}