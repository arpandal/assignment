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
				<h2>Modify Admin User</h2>

				<?php
				
	// For showing data of added admin in edited form  			
if(isset($_GET['admin_id'])){
	$admin_id = $_GET['admin_id'];
	$arpqry = "SELECT * FROM admins WHERE admin_id = :admin_id";
	$arpstmt = $pdo -> prepare($arpqry);
	$dta =[':admin_id' => $admin_id];
	$arpstmt -> execute($dta);

	$rslt = $arpstmt -> fetch(PDO::FETCH_ASSOC);
} 
?>

	<!-- For editing admins using form -->			
		<form method="POST" action="" enctype="multipart/form-data">
		<input type="hidden" name="admin_id" value="<?=$rslt['admin_id'];?>"/>
		  <label>Full Name:</label> <input type="text" name="fullname" value ="<?=$rslt['fullname'];?>" required/>
          <label>Email:</label> <input type="text" name="email" value ="<?=$rslt['email'];?>" required/>
          <label>Username:</label> <input type="text" name="username" value ="<?=$rslt['username'];?>" required/>
          <label>Password:</label> <input type="password" name="password" value ="<?=$rslt['password'];?>" required/>
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
          <input type="submit" name="update" value="Update" />
				</form>
			</article>
		</main>

		<!-- For php part -->
        <?php 

		// For editing admin using different arrtibutes 
if(isset($_POST['update'])){
	$admin_id = $_POST['admin_id'];
	$fullname = $_POST['fullname'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$role = $_POST['role'];

try{
		$arpqery = "UPDATE admins SET fullname=:fullname, email=:email, username=:username, password=:password, role=:role WHERE admin_id = :admin_id";
		$arpstmnt = $pdo -> prepare($arpqery);

		$dta = [
			':fullname' => $fullname,
			':admin_id' => $admin_id,
			':email' => $email,
			':username' => $username,
			':password' => $password,
			':role' => $role
			];
		$qryexcute = $arpstmnt ->execute($dta);
		if($qryexcute){
			$_SESSION['message'] = "Updated Successfully!";
			echo "<script type='text/javascript'>window.top.location='manageAdmins.php';</script>";
			exit(0);
		}
		else{
			$_SESSION['message'] = "Not Updated!";
			echo "<script type='text/javascript'>window.top.location='editAdmin.php';</script>";
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
