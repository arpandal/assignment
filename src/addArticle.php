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
				<h2>Add New Article</h2>

					<!-- For articles adding form with different attributes -->
                <form  action="" method="POST" enctype="multipart/form-data">
						<label>Title</label>
                          <input type="text" name="title" autocomplete="off" required>
                      	  <label>Description:</label>
                           <textarea name="description" rows="20"  cols="30" required></textarea>
                          <label>Category:</label>
                          <select name="category">
                            <option disabled selected> Select Category</option>
							<?php
							$results = $pdo->prepare('SELECT * FROM categories');
							$results->execute();
							
							//For viewing results in form
							foreach ($results as $row) {
								echo '<option value="' . $row['category_id'] . '">' . $row['category_name'] . '</option>';
							}
								?>
                            <label>Post image</label>
                          <input type="file" name="images" required>
                      </div>
                      <input type="submit" name="add" value="Add" required />
						</form>
                    </article>
</main>
		<!-- for php part -->
<?php
	//For checking if form submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   	 	//For  getting form data
    	$title = $_POST['title'];
    	$description = $_POST['description'];
    	$category = $_POST['category'];
    	$author = $_POST['author'] ?? 12;
		$image = $_FILES['images'];

	if ($image['error'] == 0) {
        // For getting file name and extension
        $file_name = pathinfo($image['name'], PATHINFO_FILENAME);
        $file_extension = pathinfo($image['name'], PATHINFO_EXTENSION);


		$new_file_name = uniqid($file_name . '_') . '.' . $file_extension;

        //For defining path to save image
        $upload_path = 'images/' . $new_file_name;

        //For moving the uploaded file into specified folder
        move_uploaded_file($image['tmp_name'], $upload_path);
    } else {
        $new_file_name = null;
    }
	// prepare and bind parameters
	 $arpstmt = $pdo->prepare("INSERT INTO articles (title, description, category, date, image, author) VALUES (:title, :description, :category, NOW(), :image, :author)");
	 $arpstmt->bindParam(':title', $title);
	 $arpstmt->bindParam(':description', $description);
	 $arpstmt->bindParam(':category', $category);
	 $arpstmt->bindParam(':image', $new_file_name);
	 $arpstmt->bindParam(':author', $author);

	// For executing the statement
	 $arpstmt->execute();
	 echo "<script type='text/javascript'>window.top.location='adminArticles.php';</script>";
}
?>
<!-- For footer part -->
<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
