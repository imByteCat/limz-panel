<?php
	// 引入数据库配置信息
	require_once('config.php');

	try {
		// 创建一个新的 PDO 连接并保存在 $db 里面
		$db = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASS);
		// 当有错误时抛出异常
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $exception){
		die("数据库连接失败！错误信息：" . $exception->getMessage());
	}
?>