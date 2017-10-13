<?php 
/**
 * 日常开发中用到的工具类
 *
 * X-wolf
 *
 * 2017/9/22
 */

namespace lib;

class Util
{
	// 通过file_get_contents方式获取数据
    public static function urlGet($url,$options = [])
    {
        $option = [
            'http'  => [
                    'method'    => 'GET',
                    'timeout'   => 3,
            ],
        ];

        if(!empty($options)) $option = array_merge($option,$options);

        return file_get_contents($url,false,stream_context_create($option)); 
    }

    public static function http_post_curl($url,$data,$is_ssl = false)
	{
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_HEADER, false);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		if($is_ssl){
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		}


		curl_setopt($ch, CURLOPT_POST, true);

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

		$ret = curl_exec($ch);

		if(curl_errno($ch)){
			return curl_error($ch);
		}

		curl_close($ch);

		return $ret;
	}

	public static function http_get($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 500);
		// 为保证第三方服务器与微信服务器之间数据传输的安全性，所有微信接口采用https方式调用，必须使用下面2行代码打开ssl安全校验。
	    // 如果在部署过程中代码在此处验证失败，请到 http://curl.haxx.se/ca/cacert.pem 下载新的证书判别文件。
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);//生产环境默认使用2
	    curl_setopt($ch, CURLOPT_URL, $url);

	    $res = curl_exec($ch);
	    if(curl_errno($ch)){
	    	$res = curl_error($ch);
	    }
	    curl_close($ch);
	    return $res;
	}
}









 ?>