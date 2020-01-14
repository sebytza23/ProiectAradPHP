<?php
	
	include ('..\REGISTER\server.php');
	
	$content = $_POST['content'];//titlu subcategorie
	
	$descriere = $_POST['descriere'];//descriere subcategorie
	
	$parent_id = $_GET['idcateg'];//numarul categoriei
	
	$nrsubcat = mysqli_query($db, "SELECT subcat_id FROM subcategories");
	
	$nrscat = mysqli_num_rows($nrsubcat);//numarul subcategoriei
	
	$numeuser = $_SESSION['username'];//id-ul celui ce trimite datele
	
	$dt2=date("Y-m-d H:i:s");//data
	//insereaza in subcategories valorile primite
	$sql = "INSERT INTO `subcategories`(`subcat_id`, `parent_id`, `subcategory_title`, `subcategory_desc`, `username` ,  `dataa2`) VALUES ($nrscat+1,$parent_id,'$content','$descriere', '$numeuser', '$dt2')";
								  
	if(mysqli_query($db, $sql))
			header("location: pagecat.php?idcat=".$parent_id);

?>