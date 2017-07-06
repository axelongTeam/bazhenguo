<?php

// +----------------------------------------------------------------------
// | Think.Admin
// +----------------------------------------------------------------------
// | 版权所有 2014~2017 广州楚才信息科技有限公司 [ http://www.cuci.cc ]
// +----------------------------------------------------------------------
// | 官方网站: http://think.ctolog.com
// +----------------------------------------------------------------------
// | 开源协议 ( https://mit-license.org )
// +----------------------------------------------------------------------
// | github开源项目：https://github.com/zoujingli/Think.Admin
// +----------------------------------------------------------------------


use service\DataService;
use service\NodeService;
use Wechat\Loader;
use think\Db;

/**
 * 打印输出数据到文件
 * @param mixed $data
 * @param bool $replace
 * @param string|null $pathname
 */
function p($data, $replace = false, $pathname = NULL) {
    is_null($pathname) && $pathname = RUNTIME_PATH . date('Ymd') . '.txt';
    $str = (is_string($data) ? $data : (is_array($data) || is_object($data)) ? print_r($data, true) : var_export($data, true)) . "\n";
    $replace ? file_put_contents($pathname, $str) : file_put_contents($pathname, $str, FILE_APPEND);
}

/**
 * 获取微信操作对象
 * @param string $type
 * @return \Wechat\WechatReceive|\Wechat\WechatUser|\Wechat\WechatPay|\Wechat\WechatScript|\Wechat\WechatOauth|\Wechat\WechatMenu
 */
function & load_wechat($type = '') {
    static $wechat = array();
    $index = md5(strtolower($type));
    if (!isset($wechat[$index])) {
        $config = [
            'token'          => sysconf('wechat_token'),
            'appid'          => sysconf('wechat_appid'),
            'appsecret'      => sysconf('wechat_appsecret'),
            'encodingaeskey' => sysconf('wechat_encodingaeskey'),
            'mch_id'         => sysconf('wechat_mch_id'),
            'partnerkey'     => sysconf('wechat_partnerkey'),
            'ssl_cer'        => sysconf('wechat_cert_cert'),
            'ssl_key'        => sysconf('wechat_cert_key'),
            'cachepath'      => CACHE_PATH . 'wxpay' . DS,
        ];
        $wechat[$index] = Loader::get($type, $config);
    }
    return $wechat[$index];
}

/**
 * 安全URL编码
 * @param array|string $data
 * @return string
 */
function encode($data) {
    return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(serialize($data)));
}

/**
 * 安全URL解码
 * @param string $string
 * @return string
 */
function decode($string) {
    $data = str_replace(['-', '_'], ['+', '/'], $string);
    $mod4 = strlen($data) % 4;
    !!$mod4 && $data .= substr('====', $mod4);
    return unserialize(base64_decode($data));
}

/**
 * RBAC节点权限验证
 * @param string $node
 * @return bool
 */
function auth($node) {
    return NodeService::checkAuthNode($node);
}

/**
 * 设备或配置系统参数
 * @param string $name 参数名称
 * @param bool $value 默认是false为获取值，否则为更新
 * @return string|bool
 */
function sysconf($name, $value = false) {
    static $config = [];
    if ($value !== false) {
        $config = [];
        $data = ['name' => $name, 'value' => $value];
        return DataService::save('SystemConfig', $data, 'name');
    }
    if (empty($config)) {
        foreach (Db::name('SystemConfig')->select() as $vo) {
            $config[$vo['name']] = $vo['value'];
        }
    }
    return isset($config[$name]) ? $config[$name] : '';
}

/**
 * 照片上传
 */

function upload_files($file){
    // 移动到框架应用根目录/static/uploads/ 目录下
    $info = $file->validate(['size'=>156780,'ext'=>'jpg,png,gif'])->move(UPLOAD_PATH);
    if($info){
        // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
        return ['status'=>1,'desc'=>$info->getSaveName()];
    }else{
        // 上传失败获取错误信息
        return ['status'=>0,'desc'=>$file->getError()];
    }
}

function upload_base64($string){
	$time = time();
	$filename = UPLOAD_PATH . date("Y-m-d",$time) .DS. sha1($time) . '.jpg';
    if (is_file($filename) && filesize($filename) > 100) {
    }else{
        	$fileDir = pathinfo($filename, PATHINFO_DIRNAME);
            if (!is_dir($fileDir)) {
                mkdir($fileDir, 0777, true);
            }
            file_put_contents($filename, base64_decode($string), LOCK_EX);
        }
        return str_replace(ROOT_PATH, '/', $filename);
}
/**
     * 打印日志信息
     * @param array  $content
     * @param string $title
     * @return bool
     */
    function logs($content = [], $title = '') {
        if (empty($title)) {
            $title = '执行日志';
        }
        $request = \think\Request::instance();
        // 准备日志数据
        $startTime = date('Y-m-d H:i:s', time());
        $urlNode   = trim($request->module() . '/' . $request->controller() . '/' . $request->action());
        $logs      = "================[{$title} : {$startTime}  BEGIN]================\n";
        $logs      .= "node ： {$urlNode}\n";
        if (!empty($content) && is_array($content)) {
            $logs .= \think\Debug::dump($content, false);
        } else {
            $logs .= "value ：" . (string)$content . "\n";
        }
        $endTime = date('Y-m-d H:i:s', time());
        $logs    .= "================[{$title} : {$endTime}  END]================\n\n";
        // 开始写入日志文件
        $logsFilename = ROOT_PATH . 'logs';
        return (boolean)file_put_contents($logsFilename, $logs, FILE_APPEND | LOCK_EX);
    }

    /**
     * 返回API数据
     * @param string $message 返回的消息
     * @param int    $states  返回的状态码
     * @param array  $result  返回的数组
     */
    function rs($message = '', $states = 0, $result = []) {
        $return = [
            'state'   => urldecode($states),
            'message' => urldecode($message)
        ];
        // 如果有结果的话
        if (!empty($result)) {
            if (is_object($result)) {
                $result              = json_decode(json_encode($result), true);
                $result['page_size'] = intval(ceil($result['total'] / $result['per_page']));
                $return['result']    = $result;
            }
            if (is_array($result)) {
                $return['result'] = $result;
            }
        }
        die(json_encode($return));
        // echo '<pre>';
        // print_r($return);
        // die();
    }
/**
 * array_column 函数兼容
 */
if (!function_exists("array_column")) {

    function array_column(array &$rows, $column_key, $index_key = null) {
        $data = [];
        foreach ($rows as $row) {
            if (empty($index_key)) {
                $data[] = $row[$column_key];
            } else {
                $data[$row[$index_key]] = $row[$column_key];
            }
        }
        return $data;
    }

}