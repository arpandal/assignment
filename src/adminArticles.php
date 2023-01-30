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

		<h3>All Articles <a href="addArticle.php">Add Article</a></h3>
		 <table>  
		<thead>
			<!-- For showing message of article's details -->
                        <tr>
                            <th>S.NO.</th>
                            <th>TITLE</th>
                            <th>CATEGORY</th>
                            <th>DATE</th>
                            <th>AUTHOR</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
					<tbody>
						<!-- For php part -->
						<?php
						// For displaying results after added new articles 
						$arpqry = "SELECT articles.article_id, articles.title, articles.description, articles.date, categories.category_name, admins.username FROM articles
						LEFT JOIN categories ON articles.category = categories.category_id
						LEFT JOIN admins ON articles.author = admins.admin_id
						ORDER BY articles.article_id";
						
						$arpstmt = $pdo->prepare($arpqry);
						$arpstmt->execute();

						$arpstmt->setFetchMode(PDO::FETCH_ASSOC);
						$rslt = $arpstmt -> fetchAll();
						if($rslt)
						{
						foreach($rslt as $row){
							?>
							<tr>
								<td><?=$row['article_id']; ?></td>
								<td><?=$row['title']; ?></td>
								<td><?=$row['category_name']; ?></td>
								<td><?=$row['date']; ?></td>
								<td><?=$row['username']; ?></td>




								<td>
									<!-- For editing articles -->
									<a href="editArticle.php?article_id=<?=$row['article_id'];?>">Edit</a>
								</td>
								<!-- For deleting articles -->
								<td><form action="deleteArticle.php" method=POST>
									<button type="submit" name="delete" value="<?=$row['article_id'];?>">Delete</button></form>
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