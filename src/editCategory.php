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
				<h2>Edit Category</h2>
				<?php
				
// For showing added value of categoies in edit form -->
if(isset($_GET['category_id'])){
	$category_id = $_GET['category_id'];
	$arpqry = "SELECT * FROM categories WHERE category_id = :category_id";
	$arpstmt = $pdo -> prepare($arpqry);
	$dta =[':category_id' => $category_id];
	$arpstmt -> execute($dta);

	$rslt = $arpstmt -> fetch(PDO::FETCH_ASSOC);
} 
?>
			<!-- For editing categories form is cretaed -->
                <form  action="" method="POST" enctype="multipart/form-data">
                    <label>Category Name:</label>
					<input type="hidden" name="category_id" value="<?=$rslt['category_id'];?>"/>
                    <input type="text" name="category_name" value ="<?=$rslt['category_name'];?>"/>
                    <input type="submit" name="update" value="Update" required />
						</form>
                    </article>
</main>

<!-- For php part -->
<?php 
// For updating categories 
if(isset($_POST['update'])){
	$category_id = $_POST['category_id'];
	$category_name = $_POST['category_name'];
	try{
		$arpqery = "UPDATE categories SET category_name=:category_name WHERE category_id = :category_id";
		$arpstmnt = $pdo -> prepare($arpqery);

		$dta = [
			':category_name' => $category_name,
			':category_id' => $category_id
		];
		$qryexcute = $arpstmnt ->execute($dta);
		if($qryexcute){
			$_SESSION['message'] = "Updated Successfully!";
			echo "<script type='text/javascript'>window.top.location='adminCategories.php';</script>";
			exit(0);
		}
		else{
			$_SESSION['message'] = "Not Updated!";
			echo "<script type='text/javascript'>window.top.location='editCategories.php';</script>";
			exit(0);
		}
		
		}
		catch(PDOException $ex){
			echo $ex -> getMessage();

	}
}
?>


<!-- For footer part -->
<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
