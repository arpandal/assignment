<?php
//For connecting databse
$pdo = new PDO("mysql:host=db;dbname=news", 'root', 'example');
?>

<!-- For the html part -->
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
				<li><a href="contact.php">Contact us</a></li>
				<li><a href="adminLogin.php">Admin</a></li>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
				
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
		<main>
			<article>
				<h2>Register to news portal</h2>

	<!-- For making form to registered users -->			
	<form action="" method="POST" enctype="multipart/form-data">
		<p>Enter your Details:</p>
          <label>Firstname:</label> <input type="text" name="firstname" required/>
          <label>Lastname:</label> <input type="text" name="lastname" required/>
          <label>Email:</label> <input type="text" name="email" required/>
          <label>Username:</label> <input type="text" name ="username" required/>
          <label>Password:</label> <input type="password" name="password" required/>
          <label>Confirm Password:</label> <input type="password" name="confirmpassword" require/> 
          <input type="submit" name="submit" value="Register" />
				</form>
			 </article>
		</main>
	
		<!-- For php part -->
		<?php 
		// For the part of submission 
		if (isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST ['username'], $_POST['password'])) {


//For the comparison of database if username already exists 
$checkusernameqry = $pdo->prepare('SELECT count(*) FROM users WHERE username="' . $_POST['username'] . '"');
$checkusernameqry -> execute();
$countingusername = $checkusernameqry->fetchColumn();

//For displaying message if username is already used 
if($countingusername > 0) {
	echo "<p style='text-align:center'>Username is not available!</p>";
}
else {
	//For the comparison of database if email already exists
	$checkemailqry = $pdo->prepare('SELECT count(*) FROM users WHERE email="' . $_POST['email'] . '"');
	$checkemailqry -> execute();
	$countingemail = $checkemailqry->fetchColumn();

	//For displaying message if email is already used
	if($countingemail > 0){
		echo "<p style='text-align:center'>Email address is not available!</p>";
	}
	else {

		//For checking password whether it matched or not
		if ($_POST['password'] == $_POST['confirmpassword']) {

			//For security purpose password is hashing 
			$psword=$_POST['password'];
			$phash = password_hash($psword, PASSWORD_DEFAULT);

				//For inserting database using prepared statements
				$arpstmt = $pdo->prepare('INSERT INTO users (firstname, lastname, email, username, password)
															VALUES ( :firstname, :lastname, :email, :username, :password)');

				$arpcriteria = [
					'firstname' => $_POST['firstname'],
					'lastname' => $_POST['lastname'],
					'email'=> $_POST['email'],
					'username'=> $_POST['username'],
					'password'=> $phash
				];
				//For displaying the message
				unset($_POST['submit']);
				$arpstmt -> execute($arpcriteria);

						$usrname = ($_POST['username']);

						echo "<p style='text-align:center'>Successfully Registered <a href='login.php'>Login</a></p>";
					}

					else {
						echo "<p style='text-align:center'>Incorrect Password, Enter matching password!</p>";
		}
	}
}
		}		
?>
<!-- For the footer part -->
		<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
