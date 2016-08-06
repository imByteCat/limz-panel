<?php
	// 引入全局配置文件
	require_once '../lib/global.php';

	// 创建一个用户对象
	$user = new User($db);

	// 销毁用户会话
	$user->logout();

	// 重定向至登录页
	header('location: login.php');
 ?>
