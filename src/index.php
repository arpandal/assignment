<?php
// For connecting database
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
				<li><a href="login.php">Login</a></li>
				<?php 
				}
				?>
			</ul>
		</nav>
		<img src="images/banners/randombanner.php" />
		<main>
			<article>
				<h2>Recent News</h2>
				<?php
				// For displaying number of recent articles posted
				$limit = 6;
				$arpqry = "SELECT articles.article_id, articles.title, articles.date, categories.category_name, articles.image FROM articles
				LEFT JOIN categories ON articles.category = categories.category_id
				ORDER BY articles.article_id DESC LIMIT {$limit}";
				$arpstmt = $pdo->prepare($arpqry);
				$arpstmt->execute();

				$arpstmt->setFetchMode(PDO::FETCH_ASSOC);
				$rslt = $arpstmt -> fetchAll();
				if($rslt)
				{
				foreach($rslt as $row){
					?>
					<div>
					<h1><a href='article.php?id=<?php echo $row['article_id']; ?>'><?php echo $row['title']; ?></a></h1>
						</div>		

						<div><em>
                         Date: <?php echo $row['date']; ?>
                        </em></div>
						<span>Category:
                                    <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                    </span>
									<div>
                                  <a class=""href="article.php?id=<?php echo $row['article_id']; ?>"> <img src="images/<?=$row['image'];?>" height ="150px"></a>
                                </div>
									</p>
                                      <a  href='article.php?id=<?php echo $row['article_id']; ?>'>continue to read</a>
                                  
                        		 <?php  
						}
						}
						else{
							?>
                             <?php
						}
						?> 
    		</article>
		</main>

<!-- For footer part -->
		<footer>
			&copy; Northampton News 2022
		</footer>
	</body>
</html>
