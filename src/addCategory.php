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
			<article>
				<h2>Add New Category</h2>

				<!-- For adding categories -->
                <form  action="" method="POST" enctype="multipart/form-data">
                    <label>Category Name:</label>
                    <input type="text" name="category_name" placeholder="Category Name" required>
                    <input type="submit" name="save" value="Add" required />
						</form> 
                    </article>
</main>

<!-- For the part of php -->
<?php 

	if (isset($_POST['category_name'])) {

	//For the comparison of database if category already exists 
   $checkcategoryqry = $pdo->prepare('SELECT count(*) FROM categories WHERE category_name="' . $_POST['category_name'] . '"');
   $checkcategoryqry -> execute();
   $countingcategory = $checkcategoryqry->fetchColumn();

   	$category_name = $_POST['category_name'];
	
		//For preparing statement to add category name in catgegory table
		$arpstmt = $pdo->prepare('INSERT INTO categories (category_name)
															VALUES (:category_name)');
	
			$arpcriteria = [
				'category_name' => $_POST['category_name'],

			];
	
			unset($_POST['save']);
			$arpstmt -> execute($arpcriteria);
		//For displaying message if category is already used 
		if($countingcategory > 0) {
	        echo "<p style='text-align:center;'>Category is not available!</p>";

	}
		else{
			echo "<script type='text/javascript'>alert('New Category is added!');</script>";
			echo "<script type='text/javascript'>window.top.location='adminCategories.php';</script>"; 

		}
	}
		 
?>



<!-- For footer part -->
<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
