<?php
	return [
		'default_return_type' => 'json',
		'null'            => ['status'=>0,'message'=>'没有值'],
		'success'         => ['status'=>1,'message'=>'成功'],
		'error'           => ['status'=>2,'message'=>'错误'],
		'add'             => ['status'=>3,'message'=>'添加'],
		'delete'          => ['status'=>4,'message'=>'删除'],
		'edit'            => ['status'=>5,'message'=>'编辑'],
		'underfind'       => ['status'=>6,'message'=>'未定义']
	];
?>