<?php 
namespace app\wechat\controller;

use app\common\controller\Common;
use think\Log;
use lib\Util;
use app\wechat\logic\Base as BaseLogic;
/**
 * 微信相关接口
 */
class Index extends Common
{
	//统一入口
	public function index()
	{
        Log::info('调试信息: '.json_encode(input('get')));
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
    private function responseText($obj)
    {
        switch ($obj->Content) {
            case 'hello':
                $content = 'Hi!';
                break;
            case 'love':
                $content = 'Congratulate';
                break;
            default:
                $content = '暂无此关键词相关信息,请试试其他词汇哦.例如:hello,love...';
                break;
        }
        $fromUserName = $obj->ToUserName;
        $toUserName   = $obj->FromUserName;
        $createTime   = NOW;
        $msgType      = strtolower($obj->MsgType);
        $template = '<xml>
                        <ToUserName><![CDATA[%s]]></ToUserName>
                        <FromUserName><![CDATA[%s]]></FromUserName>
                        <CreateTime>%s</CreateTime>
                        <MsgType><![CDATA[%s]]></MsgType>
                        <Content><![CDATA[%s]]></Content>
                    </xml>
                    ';
        $result = sprintf($template,$toUserName,$fromUserName,$createTime,$msgType,$content);
        e($result);
    }
    // 图片消息
    private function responseImg($obj)
    {

    }
    // 语音消息
    private function responseVoice($obj)
    {

    }
    // 视频消息
    private function responseVideo($obj)
    {

    }  
    // 小视频消息
    private function responseShortvideo($obj)
    {

    } 

    // 地理位置消息
    private function responseLocation($obj)
    {

    }   
    // 地理位置消息
    private function responseLink($obj)
    {

    }

    private function responseEvent($obj)
    {

    }


}





 ?>