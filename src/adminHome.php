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
				<li><a href="adminHome.php">Admin Home</a></li>
				
				<!-- For php part -->
				<?php
				// For showing user account after logged in 
				if(isset($_SESSION['username'])){ ?>
				<li><a href=""><?php echo $_SESSION['username']; ?></a></li>
				<li><a href="logout.php">Logout</a></li>
				<?php
				}
				else{
					?>

				<li><a href="register.php">Register</a></li>
				<li><a href="adminLogin.php">Admin</a></li>
				<?php 
				}
				?>
			</ul>
			
		</nav>
		<img src="images/banners/randombanner.php" />
		<main>
			<nav>
				<ul>
					<!-- For managing admins, categories, and articles -->
					<li><a href="adminArticles.php">Admin Articles</a></li>
					<li><a href="adminCategories.php">Admin Categories</a></li>
					<li><a href="manageAdmins.php">Manage Admins</a></li>
					</ul>
			</nav>
			<h2>Admin Panel</h2>
			</ul>
</nav>
	</main>

<!-- For footer part -->
		<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
