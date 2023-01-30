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
		<h3>All Categories <a href="addCategory.php">Add Category</a></h3>
			<table>  
		<thead>

			<!-- For showing table of admin's details -->
						<tr>
                            <th>S.NO.</th>
                            <th>CATEGORY NAME</th>
							<th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
					<tbody>

						<!-- For php part -->
						<?php

						// For displaying results after added neew admins 
						$arpqry = "SELECT * FROM categories";
						$arpstmt = $pdo -> prepare($arpqry);
						$arpstmt->execute();

						$arpstmt->setFetchMode(PDO::FETCH_ASSOC);
						$rslt = $arpstmt -> fetchAll();
						if($rslt)
						{
						foreach($rslt as $row){
							?>
							<tr>
								<td><?=$row['category_id']; ?></td>
								<td><?=$row['category_name']; ?></td>
								<td>
									<!-- For editing categories -->
									<a href="editCategory.php?category_id=<?=$row['category_id'];?>">Edit</a>
								</td>
								<!-- For deleting categories -->
								<td><form action="deleteCategory.php" method=POST>
									<button type="submit" name="delete" value="<?=$row['category_id'];?>">Delete</button></form>
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