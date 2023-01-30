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
			<!-- For showing message if crud operation is performed -->
		<?php
			if(isset($_SESSION['message'])):?>
			<h5><?=$_SESSION['message'];?></h5>
			<?php
			unset($_SESSION['message']);
			endif;
			?>
		<img src="images/banners/randombanner.php" />
		<main>
			<article>
				<h2>Edit Article</h2>
				<?php
				
// For showing value of added article in edited form 
if(isset($_GET['article_id'])){
	$article_id = $_GET['article_id'];
	$arpqry = "SELECT * FROM articles WHERE article_id = :article_id";
	$arpstmt = $pdo -> prepare($arpqry);
	$dta =[':article_id' => $article_id];
	$arpstmt -> execute($dta);
	$rslt = $arpstmt -> fetch(PDO::FETCH_ASSOC);
} 
?>
				<!-- For form editing article -->
                <form  action="" method="POST" enctype="multipart/form-data">
				<input type="hidden" name="article_id" value="<?=$rslt['article_id'];?>"/>
					<label>Title</label>
						  <input type="text" name="title" autocomplete="off" value="<?=$rslt['title'];?>" required>
                      	<label>Description:</label>
                          <textarea name="description" value ="<?=$rslt['description'];?>" rows="20"  cols="30" required><?=$rslt['description'];?></textarea>
                          <label>Category:</label>
                          <select name="category"> <?=$rslt['category'];?>
                            <option disabled> Select Category</option>

						<?php
							$results = $pdo->prepare('SELECT * FROM categories');
							$results->execute();
							
							//For viewing select category in form
							foreach ($results as $row) {
								echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
							}
								?>
							<label>Post image</label>
                          <input type="file" name="image"required>
						  <img src="images/<?=$rslt['image'];?>" height ="150px">
                      <input type="submit" name="update" value="Update" required />
					 </form>
                    </article>
</main>

<!-- For php part -->
<?php 

// For updating article 
if(isset($_POST['update'])){
	$article_id = $_POST['article_id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$category = $_POST['category'];

try{
		$arpqery = "UPDATE articles SET title=:title, description=:description, category=:category WHERE article_id = :article_id";
		$arpstmnt = $pdo -> prepare($arpqery);

		$dta = [
			':title' => $title,
			':description' => $description,
			':category' => $category,
			':article_id' => $article_id
		];
		$qryexcute = $arpstmnt ->execute($dta);
		if($qryexcute){
			$_SESSION['message'] = "Updated Successfully!";
			echo "<script type='text/javascript'>window.top.location='adminArticles.php';</script>";
			exit(0);
		}
		else{
			$_SESSION['message'] = "Not Updated!";
			echo "<script type='text/javascript'>window.top.location='editArticle.php';</script>";
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
