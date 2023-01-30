<?php
//For connecting database
$pdo = new PDO("mysql:host=db;dbname=news", 'root', 'example');

// For deleting admin account creating php script 
if(isset($_POST['delete'])){
    $admin_id = $_POST['delete'];
    try{
        $qry = "DELETE FROM admins WHERE admin_id=:admin_id";
        $arpstmt = $pdo -> prepare($qry);
        $dta = [
            ':admin_id' =>$admin_id
    ];
        $qryext = $arpstmt -> execute($dta);

		if($qryext){
            $_SESSION['message'] = "`Deleted Successfully!";
			echo "<script type='text/javascript'>window.top.location='ManageAdmins.php';</script>";
			exit(0);
		}
		else{
			$_SESSION['message'] = "Not Deleted!";
			echo "<script type='text/javascript'>window.top.location='manageAdmins.php';</script>";
			exit(0);
		}
		
		} 
		catch(PDOException $ex){
			echo $ex -> getMessage();
		}
	}
        ?>
<?php require 'manageAdmins.php'; ?>