<?php
	// 引入全局配置文件
	require_once '../lib/global.php';

	// 创建一个用户对象
	$user = new User($db);

	// 若已登录
	if($user->isLoggedIn()){
		header("location: index.php"); // 重定向至主页
	}

	// 如果木有发送过的数据
	if(isset($_POST['submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		// 注册新用户
		if($user->register($name, $email, $password)){
			// 如果注册成功则返回真
			$success = true;
		}else{
			// 失败的话抛出错误信息
			$error = $user->getLastError();
		}
	}
 ?>


<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>注册</title>
		<link rel="stylesheet" href="../asset/css/land.css" media="screen" title="no title" charset="utf-8">
	</head>
	<body>
		<div class="login-page">
		  <div class="form">
			  <form class="register-form" method="post">
			  <?php if (isset($error)): ?>
				  <div class="error">
					  <?php echo $error ?>
				  </div>
			  <?php endif; ?>
			  <?php if (isset($success)): ?>
				  <div class="success">
					  注册成功！<a href="login.php">点此登录</a>
				  </div>
			  <?php endif; ?>

			   <input type="text" name="name" placeholder="用户名" required/>
			   <input type="email" name="email" placeholder="邮箱" required/>
			   <input type="password" name="password" placeholder="密码" required/>
			   <button type="submit" name="submit">注册</button>
			   <p class="message">已有账户？<a href="login.php">点此登录</a></p>
			 </form>
		  </div>
		</div>
	</body>
</html>
