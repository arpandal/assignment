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

            <!-- For php part and category -->
                    <?php
                        // For showing categories and it's article
                        $category_id = $_GET['cid'];
						
						$arpqrry = $pdo->query("SELECT * FROM categories WHERE category_id = {$category_id}");
						$arpqrry -> execute(); 
                          foreach($arpqrry as $row){
                            
                      }?>
                        <h2><?php echo $row['category_name']; ?> News</h2>

                          <?php 
                           $arpqry ="SELECT articles.article_id, articles.title, articles.description, articles.date, categories.category_name, admins.username, articles.image FROM articles
                           LEFT JOIN categories ON articles.category = categories.category_id
                           LEFT JOIN admins ON articles.author = admins.admin_id
                           WHERE articles.category = {$category_id}
                           ORDER BY articles.article_id";
                           
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
                                    <span>Author:
                                    <a href='author.php?aid=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>   
                                    </span></div>
                                    <div>
                                  <a class=""href="article.php?id=<?php echo $row['article_id']; ?>"> <img src="images/<?=$row['image'];?>" height ="150px"></a>
                                </div>

                                <div>
                                <?php echo substr($row['description'], 0, 130) . "..." ?>

                                </p>
                                      <a  href='article.php?id=<?php echo $row['article_id']; ?>'>read more</a>
                                  </div>
                                
                                <?php  
						}
						}
						else{
							?>
                             <p>
							<h3>No Record found.</h3>
                            </p>
						
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


