<?php
//For connecting database
$pdo = new PDO("mysql:host=db;dbname=news", 'root', 'example');

// For deleting category part creating php script 
if(isset($_POST['delete'])){
    $category_id = $_POST['delete'];
    try{
        $qry = "DELETE FROM categories WHERE category_id=:category_id";
        $arpstmt = $pdo -> prepare($qry);
        $dta = [
            ':category_id' =>$category_id
    ];
        $qryext = $arpstmt -> execute($dta);


        if($qryext){
            $_SESSION['message'] = "`Deleted Successfully!";
			echo "<script type='text/javascript'>window.top.location='adminCategories.php';</script>";
			exit(0);
		}
		else{
			$_SESSION['message'] = "Not Deleted!";
			echo "<script type='text/javascript'>window.top.location='adminCategories.php';</script>";
			exit(0);
		}
		
		} 
		catch(PDOException $ex){
			echo $ex -> getMessage();
}
		}
        
    ?>
<?php require 'adminCategories.php'; ?>