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

			<!-- For showing message if crud operation has done -->
			<?php
			if(isset($_SESSION['message'])):?>
			<h5><?=$_SESSION['message'];?></h5>
			<?php
			unset($_SESSION['message']);
			endif;
?>

<h3>All Admin Users <a href="addAdmin.php">Add Admin</a></h3>
 <table>  
	<thead>
		<!-- For showing table of admin's details -->
						 <tr>
                            <th>ID</th>
                            <th>FULL NAME</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
					<tbody>
												
					<!-- For php part -->
					<?php
						// For displaying results after added neew admins 
						$arpqry = "SELECT * FROM admins";
						$arpstmt = $pdo -> prepare($arpqry);
						$arpstmt->execute();

						$arpstmt->setFetchMode(PDO::FETCH_ASSOC);
						$rslt = $arpstmt -> fetchAll();
						if($rslt)
						{
						foreach($rslt as $row){
						?>
						<tr>
							<td><?=$row['admin_id']; ?></td>
							<td><?=$row['fullname']; ?></td>
							<td><?=$row['username']; ?></td>
							<td><?=$row['email']; ?></td>
							<td>
							<?php 
							if($row['role']==1){
								echo "Admin";
							}else{
								echo "Normal";
							}
							?> </td>
							<td>
								<!-- For editing admins -->
									<a href="editAdmin.php?admin_id=<?=$row['admin_id'];?>">Edit</a>
								</td>
								<!-- For deleting admins -->
								<td><form action="deleteAdmin.php" method=POST>
									<button type="submit" name="delete" value="<?=$row['admin_id'];?>">Delete</button></form>
								</td>
							</tr>
					<?php  
						}
						}
						else{
							?>
						<!-- If there is no record -->
						<tr>
							<td>No Record found</td>
						</tr>
						<?php
						}
						?> 
					</tbody>
				</table>
       </main>

<!-- For footer part --> 
		<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>