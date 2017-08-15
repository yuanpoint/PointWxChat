<?php
/**
*文件操作类
*/
class Files{

	public function get_php_file($filename) {
        return trim(substr(file_get_contents($filename), 15));
    }

    public function set_php_file($filename, $content) {
        $fp = fopen($filename, "w");
        fwrite($fp, "<?php exit();?>" . $content);
        fclose($fp);
    }
}

















?>