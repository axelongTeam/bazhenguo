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

namespace app\api\controller;
use think\Session;
use think\Controller;

class Base extends Controller {
	
	public function _initialize() {
		header('Access-Control-Allow-Origin:*');
		header("Content-Type: application/json; charset=UTF-8");
		logs(['status'=>1]);
	}
    
    public function get_captcha(){    
        //使用memcheck 设置session    
        Session::init(['prefix'=> 'captcha_','type'=> '','auto_start' => true]);
        $captcha = new \other\Captcha(86,48,4);
        echo $captcha->showImg();
        Session::set('code',$captcha->getCaptcha());//存session
        exit;    
    }
}
