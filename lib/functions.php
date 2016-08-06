<?php
	/*
	 * Ferry 函数设置文件
	 * Author: ByteCat
	 * http://www.bytecat.net
	 */

	/**
	 * 用户注册与登录等函数
	 */
	class User
	{

		private $db;  // 存储数据库信息
		private $error;  // 存储错误信息

		// 构建用户类，需要一个数据库连接
		function __construct($db_conn)
		{
			$this->db = $db_conn;

			// 开启 session
			session_start();
		}

		// 用户注册函数
		public function register($name, $email, $password)
		{
			try
			{
				// 加密用户密码
				$hashPasswd = password_hash($password, PASSWORD_DEFAULT);

				// 插入一条新的用户数据
				$query = $this->db->prepare("INSERT INTO users(name, email, password) VALUES(:name, :email, :pass)");
				$query->bindParam(":name", $name);
				$query->bindParam(":email", $email);
				$query->bindParam(":pass", $hashPasswd);
				$query->execute();

				return true;
			}catch(PDOException $e){
				// 如果发生错误
				if($e->errorInfo[0] == 23000){
					// errorInfor[0] 包含有关执行 SQL 查询时的错误信息
					// 23000是一个代码错误，插入数据失败
					$this->error = "邮箱已存在！";
					return false;
				}else{
					echo $e->getMessage();
					return false;
				}
			}
		}

		// 用户登录函数
		public function login($email, $password)
		{
			try
			{
				// 从数据库中检索数据
				$query = $this->db->prepare("SELECT * FROM users WHERE email = :email");
				$query->bindParam(":email", $email);
				$query->execute();
				$data = $query->fetch();

				// 如果行数 > 0
				if($query->rowCount() > 0){
					// 如果密码和数据库中存储的密码匹配
					if(password_verify($password, $data['password'])){
						$_SESSION['user_session'] = $data['id'];
						return true;
					}else{
						$this->error = "邮箱或密码错误！";
						return false;
					}
				}else{
					$this->error = "邮箱或密码错误！";
					return false;
				}
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}

		// 检查用户是否已经登录的函数
		public function isLoggedIn(){
			// user_session 是否已经存在
			if(isset($_SESSION['user_session']))
			{
				return true;
			}
		}

		// 拉取已登录用户数据
		public function getUserInfo(){
			// 检查是否已登录
			if(!$this->isLoggedIn()){
				return false;
			}

			try {
				// 从数据库中请求用户数据
				$query = $this->db->prepare("SELECT * FROM users WHERE id = :id");
				$query->bindParam(":id", $_SESSION['user_session']);
				$query->execute();
				return $query->fetch();
			} catch (PDOException $e) {
				echo $e->getMessage();
				return false;
			}
		}

		// 用户登出函数
		public function logout(){
			// 清除 session
			session_destroy();
			// 清除 user_session
			unset($_SESSION['user_session']);
			return true;
		}

		// 取出变量错误中的最后一个错误
		public function getLastError(){
			return $this->error;
		}
	}

?>