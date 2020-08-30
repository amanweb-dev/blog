<?php 
include "../lib/session.php";
Session::check_login();

 ?>
<?php include "../config/config.php" ?>
<?php include "../lib/database.php" ?>
<?php include "../helpers/formate.php" ?>

<?php 
$db = new Database();
$fm = new formate();



 ?>


<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Login</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
		<?php 
			if ($_SERVER['REQUEST_METHOD'] == 'POST') {
				$username = $fm->validation($_POST['username']);
				$password =  $fm->validation(md5($_POST['password']));
				$username = mysqli_real_escape_string($db->link,$username);
				$password = mysqli_real_escape_string($db->link,$password);

				$query = "select * from user where username ='$username' and password = '$password' ";
				$login = $db->select($query);
				if ($login != false) {
					$value = mysqli_fetch_array($login);
					$row=mysqli_num_rows($login);
					if ($row>0) {
						Session::set("login", true);
						Session::set("username", $value['username']);
						Session::set("userId", $value['id']);
						Session::set("user_role", $value['user_role']);
						header("Location:index.php");
					}else{
						echo "<span style='color:red;text-align:center;font-size:20px;'>No record found</span>";
					}
				}else{
					echo "<span style='color:red;text-align:center;font-size:20px;'>username or password not matched</span>";
				}
			}



		 ?>
		<form action="login.php" method="post">
			<h1>Admin Login</h1>
			<div>
				<input type="text" placeholder="Username" required="" name="username"/>
			</div>
			<div>
				<input type="password" placeholder="Password" required="" name="password"/>
			</div>
			<div>
				<input type="submit" name="login" value="Log in" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="#">Training with live project</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>