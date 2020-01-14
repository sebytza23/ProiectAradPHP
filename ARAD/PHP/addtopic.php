<?php
	
	include ('..\REGISTER\server.php');
	
	$content = $_POST['content'];//titlu topic
	
	$descriere = $_POST['descriere'];//descriere topic
	
	$parent_id = $_GET['idcateg'];//numar categorie
	
	$child_id = $_GET['idsubcat'];//numar subcategorie
	
	$nrtpc = mysqli_query($db, "SELECT topic_id FROM topics");
	
	$nrtopic = mysqli_num_rows($nrtpc);	//numar topic	
	
	$numeuser = $_SESSION['username'];//numele celui ce face topicul
	//insereaza in topics valorile
	$sql = "INSERT INTO `topics`(`topic_id`, `category_id`, `subcategory_id`, `author`, `title`, `content`, `date_posted`, `cond`) VALUES ($nrtopic+1,$parent_id,$child_id,'$numeuser','$content', '$descriere', NOW(),1)";
	//insereaza si zona de vizualizari
	$view = "INSERT INTO `views`(`valoare`, `tp_id`, `ct_id`, `sct_id`) VALUES (0,$nrtopic+1,$parent_id,$child_id)";						  
	
	if(mysqli_query($db, $sql) and mysqli_query($db, $view))
			header("location: subcategories.php?idcat=".$parent_id."&idsubcat=".$child_id);

?>