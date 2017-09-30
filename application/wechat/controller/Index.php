<?php 

namespace app\wechat\controller;

use app\common\Common;
use think\Log;
use lib\Util;
use app\wechat\logic\Base as BaseLogic;
/**
 * 微信相关接口
 */
class Index extends Controller
{
	//统一入口
	public function index()
	{

		if(!BaseLogic::checkSign()){
			Log::error('验证签名失败');
			return false;
		}
		if(input('?get.echostr')){
			echo input('get.echostr');
			exit();
		}

		$obj = BaseLogic::handleData();		

		if(!$obj) return false;

		$this->response($obj);

	}

	// 事件处理
	public function response($obj)
    {
    	switch ($obj->MsgType) {
    		case 'text':
    			$this->responseText($obj);
    			break;
    		case 'image':
    			$this->responseImg($obj);
    			break;
    		case 'voice':
    			$this->responseVoice($obj);
    			break;
    		case 'video':
    			$this->responsevideo($obj);
    			break;
    		case 'shortvideo':
    			$this->responseShortvideo($obj);
    			break;
			case 'location':
    			$this->responseLocation($obj);
    			break;
    		case 'link':
    			$this->responseLink($obj);
    			break;
    		case 'event':
    			$this->responseEvent($obj);
    			break;
    		
    		default:
    			# code...
    			break;
    	}
    }
    // 文本消息
    private function responseText()
    {

    }
    // 图片消息
    private function responseImg()
    {

    }
    // 语音消息
    private function responseVoice()
    {

    }
    // 视频消息
    private function responseVideo()
    {

    }  
    // 小视频消息
    private function responseShortvideo()
    {

    } 

    // 地理位置消息
    private function responseLocation()
    {

    }   
    // 地理位置消息
    private function responseLink()
    {

    }

    private function responseEvent()
    {

    }


}





 ?>