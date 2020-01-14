<?php
	include ('..\REGISTER\server.php');
	
	$parent_id = $_GET['idcat']; //numar categorie
	
	$child1_id = $_GET['idsubcat'];//numar subcategorie
	
	$child2_id = $_GET['idtopic'];//numartopic
	
	$cod = $_GET['cod'];//numartopic
	
	$user = $_GET['idnume'];//numele celui ce a postat topicul
	
	$selectare = mysqli_query($db,"Select * from topics where '$parent_id' = topics.category_id and '$child1_id' = topics.subcategory_id and '$child2_id' = topics.topic_id");

	while ($row = mysqli_fetch_assoc($selectare))
	{$sql= "UPDATE `topics` SET `cond`= 0 where '$parent_id' = topics.category_id and '$child1_id' = topics.subcategory_id and '$child2_id' = topics.topic_id";}
	
	if(mysqli_query($db, $sql))
		header("location: topic2.php?nume=".$user."&idcat=".$parent_id."&idsubcat=".$child1_id."&idtopic=".$child2_id."&idnume=".$user2."&cod=".$cod);
?>