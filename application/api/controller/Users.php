<?php

namespace app\api\controller;
use think\Session;
use app\api\controller\Base;
use think\Db;
/**
 * 计记宝 api入口
 */
class Users extends Base {
	
	public function _initialize(){
         parent::_initialize();
    }
    
    public function lists(){
    	$users = Db::name('YysUsers')->where('status', '1')->order('level desc,points desc')->select();
    	rs('获取用户列表成功', 1, $users);
    	
    }
    
    public function contents(){
    	$id = input('get.id');
    	$user = Db::name('YysUsers')->where('id', '{$id}')->find();
    	rs('获取用户成功', 1, $user);
    }
    
    public function register(){
//  	$data['nickname'] = input('post.nickname');
    	$data['userpwd'] = sha1(input('post.userpwd'));
    	$data['phone'] = input('post.phone');
//  	$data['headpic'] = upload_base64(input('post.headpic'));
    	$data['regtime'] = time();
    	$data['area'] = !empty(input('post.area'))?input('post.area'):'224';
    	logs($data);
    	$add = Db::name('YysUsers')->insert($data);
    	if($add !== false){
    		rs('用户添加成功!', 1);
    	}
    }
    
    public function login(){
//  	logs(request()->post());
    	$map['phone'] = input('post.phone');
    	$map['userpwd'] = sha1(input('post.userpwd'));
    	$map['status'] = '1';
    	$user = Db::name('YysUsers')->where($map)->find();
    	if(count($user) > 0){
    		return json_encode($user);
    	}else{
    		return json_encode(config('error'));
    	}
//  	echo json_encode(["status"=>"1","data"=>$data]);
//  	$code = Session::get('code','captcha_');//取session
//  	echo $code;
    }
    
    public function edit(){
    	
    }
}
