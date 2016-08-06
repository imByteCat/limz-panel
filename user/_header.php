<?php
	// 引入全局配置文件
	require_once '../lib/global.php';

	// 创建一个用户对象
	$user = new User($db);

	// 若用户未登录
	if(!$user->isLoggedIn()){
		header("location: login.php");  // 重定向至登录页
	}

	// 获取用户数据
	$currentUser = $user->getUserInfo();
	
	// 获取用户 Gravatar 头像
	$gravatar = 'http://cn.gravatar.com/avatar/' . md5($currentUser['email']) . '?s=128';
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<title>用户中心</title>

	<!-- 自适应屏幕宽度 -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

	<!-- Bootstrap 3.3.6 -->
	<link rel="stylesheet" href="../asset/css/bootstrap.min.css">
	<!-- Font Awesome 4.6.3 -->
	<link rel="stylesheet" href="../asset/css/font-awesome.min.css">
	<!-- Ionicons 2.0.1 -->
	<link rel="stylesheet" href="../asset/css/ionicons.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="../asset/css/AdminLTE.min.css">
	<!-- Panel Skin -->
	<link rel="stylesheet" href="../asset/css/skin-blue.min.css">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- 警告：如果使用 file:// 查看页面，则 Respond.js 无效 -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>


<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

	<!-- 主头部 -->
	<header class="main-header">

		<!-- Logo -->
		<a href="index.php" class="logo">
			<!-- 50x50 像素块的小 logo -->
			<span class="logo-mini"><?php echo $site_name2 ?></span>
			<!-- 标准大小 logo -->
			<span class="logo-lg"><?php echo $site_name ?></span>
		</a>

		<!-- 顶部导航栏 -->
		<nav class="navbar navbar-static-top" role="navigation">

			<!-- 侧边栏切换按钮 -->
			<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
				<span class="sr-only">切换侧栏</span>
			</a>

			<!-- 导航栏右侧按钮 -->
			<div class="navbar-custom-menu">

				<ul class="nav navbar-nav">

					<!-- 用户信息菜单 -->
					<li class="dropdown user user-menu">

						<!-- 个人信息简要 -->
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">

							<!-- 导航栏之上的用户头像图片 -->
							<img src="<?php echo $gravatar ?>" class="user-image" alt="User Image">

							<!-- 较小屏幕上仅显示头像而不显示称谓 -->
							<span class="hidden-xs"><?php echo $currentUser['name'] ?></span>

						</a>

						<!-- 个人信息详情菜单 -->
						<ul class="dropdown-menu">

							<!-- 在菜单中显示头像 -->
							<li class="user-header">

								<img src="<?php echo $gravatar ?>" class="img-circle" alt="User Image">

								<p>
									<?php echo $currentUser['name'] ?>
									<small>加入时间：2016-7-26</small>
								</p>

							</li>

							<!-- 菜单主体 -->
							<li class="user-body">

								<div class="row">

									<div class="col-xs-4 text-center">
										<a href="#">积分</a>
									</div>

									<div class="col-xs-4 text-center">
										<a href="#">余额</a>
									</div>

									<div class="col-xs-4 text-center">
										<a href="#">已购</a>
									</div>

								</div>

							</li>

							<!-- 菜单底部 -->
							<li class="user-footer">

								<div class="pull-left">
									<a href="#" class="btn btn-default btn-flat">个人信息</a>
								</div>

								<div class="pull-right">
									<a href="logout.php" class="btn btn-default btn-flat">登出</a>
								</div>

							</li>

						</ul>
						<!-- 详情菜单结束 -->

					</li>
					<!-- 用户信息菜单结束 -->

				</ul>

			</div>
			<!-- 导航栏右侧结束 -->

		</nav>
		<!-- 导航栏结束 -->

	</header>
	<!-- 页面顶部结束 -->


	<!-- 左侧侧边栏 -->
	<aside class="main-sidebar">

		<!-- 侧边栏内容开始 -->
		<section class="sidebar">

			<!-- 用户信息 -->
			<div class="user-panel">

				<div class="pull-left image">
					<img src="<?php echo $gravatar ?>" class="img-circle" alt="User Image">
				</div>

				<div class="pull-left info">

					<p><?php echo $currentUser['name'] ?></p>

					<!-- 状态 -->
					<a href="#"><i class="fa fa-circle text-success"></i> Online</a>

				</div>

			</div>

			<!-- 侧边栏菜单 -->
			<ul class="sidebar-menu">

				<li class="header">接下来……</li>

				<!-- 侧边栏链接导航开始 -->
				<li class="active"><a href="#"><i class="fa fa-dashboard"></i> <span>用户中心</span></a></li>

				<li><a href="#"><i class="fa fa-sitemap"></i> <span>节点列表</span></a></li>

				<li><a href="#"><i class="fa fa-user"></i> <span>我的信息</span></a></li>

				<li><a href="#"><i class="fa fa-pencil"></i> <span>修改资料</span></a></li>

				<!-- 侧边栏链接导航结束 -->

			</ul>
			<!-- 侧边栏菜单结束 -->

		</section>
		<!-- 侧边栏内容结束 -->

	</aside>
	<!-- 侧边栏结束 -->
