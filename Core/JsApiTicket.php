<?php
/**
*获取jsApiTicket
*/
namespace PointWxChat\Core;

class JsApiTicket extends Curls{

	public $access_token;//access_token
	public function __construct($access_token){
		$this->access_token = $access_token;
	}
	public function getJsApiTicket() {
        // jsapi_ticket 应该全局存储与更新，以下代码以写入到文件中做示例
        $filename = POINTWXCHAT_ROOT_PATH . 'Autofile/jsapi_ticket.php';
        $data = json_decode($this->get_php_file($filename));
	    if ($data->expire_time < time()) {
	        // 如果是企业号用以下 URL 获取 ticket
	        // $url = "https://qyapi.weixin.qq.com/cgi-bin/get_jsapi_ticket?access_token=$accessToken";
	        $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=".$this->access_token;
	        $res = json_decode($this->httpGet($url));
	        $ticket = $res->ticket;
	        if ($ticket) {
	            $data->expire_time = time() + 7000;
	            $data->jsapi_ticket = $ticket;
	            $this->set_php_file($filename, json_encode($data));
	        }
        } else {
        	$ticket = $data->jsapi_ticket;
        }

        return $ticket;
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