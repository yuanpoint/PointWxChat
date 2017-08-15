<?php
/**
*微信公众平台开发工具包
*入口文件
*author yuanpoint
*time 2017.08.15
*/

namespace PointWxChat;

use PointWxChat\Core;

//Alipay要求PHP环境必须大于PHP5.3
if (!substr(PHP_VERSION, 0, 3) >= '5.3') {
    return "Fatal error: PointWxChat requires PHP version must be greater than 5.3(contain 5.3). Because PointWxChat used php-namespace";
}
// 定义根目录
define('POINTWXCHAT_ROOT_PATH',dirname(__FILE__) . '/');

//载入配置文件
require_once POINTWXCHAT_ROOT_PATH . 'Config.php';

//载入自动加载类
require_once POINTWXCHAT_ROOT_PATH . 'Autoload.php';















?>