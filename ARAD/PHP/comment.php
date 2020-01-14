<?php
	include ('..\REGISTER\server.php');
	
	$parent_id = $_GET['idcat']; //numar categorie
	
	$child1_id = $_GET['idsubcat'];//numar subcategorie
	
	$child2_id = $_GET['idtopic'];//numartopic
	
	$cod = $_GET['cod'];//numartopic
	
	$user = $_GET['nume1'];//numele celui ce a postat topicul
	
	$user2 = $_GET['nume2'];//numele celui ce a raspuns la topic
	
	$comment1 = $_POST['comment'];//comentariul trimis
	$com = '<pre style="white-space:pre-wrap">';
	$comment = "$comment1</pre>";
	
	$sql = "INSERT INTO `replies`(`category_id`, `subcategory_id`, `topic_id`, `author`, `comment`, `date_posted`) VALUES ($parent_id,$child1_id,$child2_id,'$user','$com$comment',NOW())";
	if(mysqli_query($db, $sql))
		header("location: topic2.php?nume=".$user."&idcat=".$parent_id."&idsubcat=".$child1_id."&idtopic=".$child2_id."&idnume=".$user2."&cod=".$cod);
?>