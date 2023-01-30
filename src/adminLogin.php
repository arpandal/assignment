<?php
//For connecting database
session_start();
$pdo = new PDO("mysql:host=db;dbname=news", 'root', 'example');
?>

<!-- For html part -->
<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="styles.css"/>
		<title>Northampton News - Home</title>
	</head>
	<body>
		<header>
			<section>
				<h1>Northampton News</h1>
			</section>
		</header>
		<nav>
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="latestnewsarticle.php">Latest Articles</a></li>
				<li><a href="#">Select Category</a>

			<ul>
			<?php 
							// For selecting categories 
							$arpstmt = $pdo->query('SELECT category_id, category_name FROM categories');
							$arpstmt->execute();
							foreach ($arpstmt as $row) {
								?>
								<li>
								<?php
								echo '<a href="category.php?cid='.$row['category_id'].'">'.$row['category_name'].'</a>';
								?>
								</li>
								<?php
							}
						?>
						</ul>
					</li>

				<li><a href="adminLogin.php">Admin</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
				
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
		<main>
			<article>
				<h2>Admin Login Page</h2>
				 <form action="" method ="POST" enctype="multipart/form-data">
          <label>Username:</label> <input type="text" name="username"required/>
					<label>Password:</label> <input type="password" name="password"required/>

          <input type="submit" name="login" value="Login" />
				</form>

      </article>
		</main>
		<!-- For php part -->
<?php

error_reporting(0);
if(isset($_POST['username'], $_POST['password'])) {

	//For selecting users from user table using prepare statements
	$arpstmt = $pdo-> prepare('SELECT * FROM admins WHERE username = :username;');

	$arpcriteria = [
		'username' => $_POST['username']
	];
	$arpstmt -> execute($arpcriteria);
	$usrs = $arpstmt -> fetch();

	//For hashing password
	if(password_verify($_POST['password'], $usrs['password'])) {
		$_SESSION['user_logged_in'] = true;
  $_SESSION['username'] = $_POST['username'];

  //For re-directing user into homapage after logged in

  echo "<script type='text/javascript'>window.top.location='adminHome.php';</script>"; exit;
}
// For displaying if username or password do not match
	else {
		echo "<p style='text-align:center'>Username or Password is incorrect!</p>";
	}
}
   
?>

	<!-- For footer part -->
		<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
