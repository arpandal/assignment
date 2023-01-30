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
				<h2>Add Admin User</h2>

			<!-- For admin adding form with different attributes -->	
		<form method="POST" action="" enctype="multipart/form-data">
		  <label>Full Name:</label> <input type="text" name="fullname" required/>
          <label>Email:</label> <input type="text" name="email" required/>
          <label>Username:</label> <input type="text" name="username" required/>
          <label>Password:</label> <input type="password" name="password" required/>
		  <label>User Role</label>
                          <select class="form-control" name="role" value ="<?=$rslt['role'];?>" >
                            <?php
                              if($row['role'] == 1){
                                echo "<option value='0'>Normal User</option>
                                      <option value='1' selected>Admin</option>";
                              }else{
                                echo "<option value='0' selected>Normal User</option>
                                      <option value='1'>Admin</option>";
                              }
                            ?>
                          </select>
          <input type="submit" name="submit" value="Add" />
				</form>
			</article>
		</main>

		<!-- For php part -->
    <?php

		// For adding new article 
		if(isset($_POST['submit'])){
			$fullname = $_POST['fullname'];
			$email = $_POST['email'];
			$username = $_POST['username'];
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			$role = $_POST['role'];

			$arpqry = "INSERT INTO admins(fullname, email, username, password, role) VALUES(:fullname, :email, :username, :password, :role)";
			$arpstmnt = $pdo -> prepare($arpqry);
			$dta = [
				':fullname' => $fullname,
				':email' => $email,
				':username' => $username,
				':password' => $password,
				':role' => $role
			];
			$qryexecute = $arpstmnt ->execute($dta);
			if($qryexecute){
				$_SESSION['message'] = "Added Successfully!";
				echo "<script type='text/javascript'>window.top.location='manageAdmins.php';</script>";
				exit(0);
			}
			else{
				$_SESSION['message'] = "Not Added!";
				echo "<script type='text/javascript'>window.top.location='addAdmin.php';</script>";
				exit(0);
			}
			}
		?>
<!-- For footer part -->
		<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
