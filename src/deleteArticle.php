<?php
//For connecting database
$pdo = new PDO("mysql:host=db;dbname=news", 'root', 'example');

// For deleting article creating php script 
if(isset($_POST['delete'])){
    $article_id = $_POST['delete'];
    try{
        $qry = "DELETE FROM articles WHERE article_id=:article_id";
        $sql .= "UPDATE categories SET post= post - 1 WHERE category_id = :category_id";

        $arpstmt = $pdo -> prepare($qry);

        $dta = [
            ':article_id' =>$article_id
    ];
        $qryext = $arpstmt -> execute($dta);


        if($qryext){
            $_SESSION['message'] = "`Deleted Successfully!";
			echo "<script type='text/javascript'>window.top.location='adminArticles.php';</script>";
			exit(0);
		}
		else{
			$_SESSION['message'] = "Not Deleted!";
			echo "<script type='text/javascript'>window.top.location='adminArticles.php';</script>";
			exit(0);
		}
		
		} 
		catch(PDOException $ex){
			echo $ex -> getMessage();
    }
}
        ?>
<?php require 'adminArticles.php'; ?>