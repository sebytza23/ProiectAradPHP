<?php
	
	include ('..\REGISTER\server.php');
	
	$titlu = $_POST['titlu'];//titlul categoriei
	
	$descr = $_POST['descri'];//descrierea categoriei
	
	$ncat = mysqli_query($db, "SELECT cat_id FROM CATEGORIES");
	
	$nrcat = mysqli_num_rows($ncat);//numarul categoriei		
	
	$numeuser = $_SESSION['username'];//numele utilizatorului ce trimite datele
	
	$dt2=date("Y-m-d H:i:s");//data postarii
	//insereaza in categories valorile primite
	$sql = "INSERT INTO `categories`(`cat_id`, `category_title`, `numeuser`, `descriere`, `dataa` ) VALUES ($nrcat+1,'$titlu', '$numeuser', '$descr' , '$dt2' )";	  
	
	if(mysqli_query($db, $sql))
			header("location: categories.php");
		

?>