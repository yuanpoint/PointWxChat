<?php
/**
*获取AccessToken类
*/
namespace PointWxChat\Core;

class AccessToken extends Curls{

	public function getAccessToken(){
		// access_token 应该全局存储与更新，以下代码以写入到文件中做示例
		$filename = POINTWXCHAT_ROOT_PATH . 'Autofile/access_token.php';
        $data = json_decode($this->get_php_file($filename));
        if ($data->expire_time < time()) {
	        // 如果是企业号用以下URL获取access_token
	        // $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid=$this->appId&corpsecret=$this->appSecret";
	        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".APPID."&secret=".APPSECRET;
	        $res = json_decode($this->httpGet($url));
	        $access_token = $res->access_token;
	        if ($access_token) {
		        $data->expire_time = time() + 7000;
		        $data->access_token = $access_token;
		        $this->set_php_file($filename, json_encode($data));
	        }
        } else {
        	$access_token = $data->access_token;
        }
        return $access_token;
		
	}
	/**
	*获取文件内容
	*/
    private function get_php_file($filename) {
    	return trim(substr(file_get_contents($filename), 15));
    }
    /**
    *设置文件内容
    */
    private function set_php_file($filename, $content) {
	    $fp = fopen($filename, "w");
	    fwrite($fp, "<?php exit();?>" . $content);
	    fclose($fp);
    }
   
}

?>