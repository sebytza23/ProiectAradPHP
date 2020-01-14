<!Doctype HTML>
<?php // Sistem vizualizari topic
function viewssubctop($parent_id,$child_id,$child2_id){
	$CD = mysqli_connect('localhost', 'root', '', 'projectv2','3307');
		$rezultat = mysqli_query($CD, "Select valoare from views where ($parent_id = views.ct_id) and ($child_id = views.sct_id) and ($child2_id = views.tp_id)");
		while($view = mysqli_fetch_assoc($rezultat)){
			echo $view['valoare'];
	}
}//sfarsit sistem
?>
<?php 
// Set Language variable
	include ('..\REGISTER\server.php');

if(isset($_GET['lang']) && !empty($_GET['lang'])){
 $_SESSION['lang'] = $_GET['lang'];

 if(isset($_SESSION['lang']) && $_SESSION['lang'] != $_GET['lang']){
  echo "<script type='text/javascript'> location.reload(); </script>";
 }
}

// Include Language file
if(isset($_SESSION['lang'])){
 include "../PHP/".$_SESSION['lang'].".php";
}else{
 include "../PHP/english.php";
}
?>
<html>
<head>
	<link rel="stylesheet" rel="stylesheet" href="..\CSS\categories.css">
	<link href="..\CSS2\categories.css" rel="stylesheet" type="text/css">
	<script src="..\JS\functii.js"></script>
</head>
<body>
	<?php
		$parent_id = $_GET['idcat'];
		$child_id = $_GET['idsubcat'];
		$selectare = mysqli_query($db, "SELECT cat_id, subcat_id, topic_id, title, content, date_posted,author,cond FROM categories, subcategories, topics WHERE ($parent_id = subcategories.parent_id) and ($parent_id = topics.category_id) and ($parent_id = categories.cat_id) and ($child_id = topics.subcategory_id) and ($child_id = subcategories.subcat_id)ORDER BY date_posted DESC"); 
	?>
		<div align="center" class = "text" ><h1 data-heading="<?= _TOP; ?>"><?= _TOP; ?></h1></div><!-- imaginea cu Welcome Stranger(daca esti deconectat) -->
	
	<!-- Buton Subcategorie Noua,pentru Admini-->
	
	<?php if (isset($_SESSION['username'])) : ?>
			<a href="newtop.php?idcat=<?php echo $parent_id; ?>&amp;idsubcat=<?php echo $child_id;?>" class="link-to-portfolio" target="opener"></a>
	<?php endif; ?>
	<!-- Buton Topic Nou,pentru utilizatori normali-->
	
	
	<!--Sfarsit Buton Topic Nou -->
	
	<div class="mainbody">
		<table class="clasacategorie"> 
			<?php 
			while ($row = mysqli_fetch_assoc($selectare))  :?>
				<tr>
					<?php 
						$nrtopic= $row['topic_id'];
						$datanoua = $row['date_posted'];
						$newDate = date("d-m-Y H:i:s", strtotime($datanoua));
						$nrreply = mysqli_query($db, "SELECT reply_id FROM replies WHERE '$parent_id' = replies.category_id and '$child_id' = replies.subcategory_id and '$nrtopic' = replies.topic_id");
						$reply = mysqli_num_rows($nrreply);
					?>
					<?php if ($row['cond']) {?>
					<td class="categorie cat"><div align = "left" class = "aligned" ><img width="20" height="20" style = "position:relative;top:3px;right:3px;" src="..\IMG\topic.png" >
							<a style= "padding-left:3px;font-size:28px;"class = "titlu" href="topic2.php?idcat=<?php echo $row['cat_id'];?>&amp;idsubcat=<?php echo $row['subcat_id'];?>&amp;idtopic=<?php echo $row['topic_id'];?>&amp;idnume=<?php echo $row['author']; ?>&amp;cod=1" target="opener"><?php echo $row['title']; ?></a></br></div> <!--titlul categoriei cu legatura la zona de subcategorie din categoria respectiva -->
							<p class="descriere" style="margin-top:4px;margin-left:3px;font-size:22px;" ><?php echo $row['content'] ?> <!-- descrierea categoriei -->
					</td>
					<td class="categorie cat mobile"><div align = "right" title="<?= _VIEWS; ?>" data-placement="bottom" style= "font-size:16px;position:absolute;cursor:pointer;color:#007bff;right:2.5em;margin-top:-2.4em;;"><img style = "position:relative;top:2px;right:2px;" width="18" height="18" src="..\IMG\view.png" ><b><?php viewssubctop($parent_id,$child_id,$row['topic_id']); ?></b></div></td>
					<td class="categorie cat mobile"><div align = "right" title="<?= _REPLIES; ?>" data-placement="bottom" style= "font-size:16px;position:absolute;cursor:pointer;color:#007bff;right:5.9em;margin-top:-2.4em;;"><img style = "position:relative;top:4px;right:6px;" width="18" height="18" src="..\IMG\reply.png" ><b><?php echo $reply;?></b></div></td>
					<td class="categorie cat mobile"><div align = "right" style= "font-size:14px;position:absolute;color:#007bff;right:2.5em;margin-top:0.1em;cursor:default;"><?= _DATE; ?> <?php echo $newDate;?></div></td>
					<td class="util mobile"><div align = "right" style= "font-size:14px;position:absolute;color:#007bff;right:2.5em;margin-top:1.5em;cursor:default;"><?= _USR; ?> <a style = "text-decoration:none;color:rgb(134,107,176);"href="panel.php?idnume=<?php echo $row['author']; ?>&amp;code=0"><b><?php echo ucfirst($row['author']); ?></b></a></div></td>
					</tr>
					<?php } endwhile ?>	
		</table>
	</div>
</body>
</html>
