<?php
	// 引入全局配置文件
	require_once '../lib/global.php';

	// 创建一个用户对象
	$user = new User($db);

	// 若用户已登录
	if($user->isLoggedIn()){
		header("location: index.php"); // 重定向至主页面
	}

	// 若已发送数据
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$password = $_POST['password'];

		// 用户登录过程
		if($user->login($email, $password)){
			header("location: index.php");
		}else{
			// 如果登录失败，则显示错误信息
			$error = $user->getLastError();
		}
	}
 ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>登录</title>
		<link rel="stylesheet" href="../asset/css/land.css" media="screen" title="no title" charset="utf-8">
	</head>
	<body>
		<div class="login-page">
		  <div class="form">
			<form class="login-form" method="post">
			  <?php if (isset($error)): ?>
				  <div class="error">
					  <?php echo $error ?>
				  </div>
			  <?php endif; ?>
			  <input type="email" name="email" placeholder="邮箱" required/>
			  <input type="password" name="password" placeholder="密码" required/>
			  <button type="submit" name="submit">登录</button>
			  <p class="message">没有账号？ <a href="register.php">注册一个！</a></p>
			</form>
		  </div>
		</div>
	</body>
</html>
