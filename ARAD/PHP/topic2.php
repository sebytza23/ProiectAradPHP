<?php 
	include ('..\REGISTER\server.php');
	include ('title.php');

// Set Language variable
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
<?php
	function viewstopic($parent_id,$child1_id,$child2_id){
		$CD = mysqli_connect('localhost', 'root', '', 'projectv2','3307');
			mysqli_query($CD, "Update views set valoare=valoare+1 where ($parent_id = views.ct_id) and ($child1_id = views.sct_id) and ($child2_id = views.tp_id)");
			$rezultat = mysqli_query($CD, "Select * from views where ($parent_id = views.ct_id) and ($child1_id = views.sct_id) and ($child2_id = views.tp_id)");
	}	
?>
<?php
		$parent_id = $_GET['idcat']; 
		$child1_id = $_GET['idsubcat'];
		$child2_id = $_GET['idtopic'];
		$selectare = mysqli_query($db, "SELECT author, title, content, date_posted FROM topics WHERE ($child1_id = topics.subcategory_id) and ($child2_id = topics.topic_id)"); 
		$user = strtolower($_GET['idnume']);//id-ul celui ce a postat
		$selectare2 = mysqli_query($db, "SELECT * FROM users WHERE '$user' = users.username"); 
		$gen = mysqli_fetch_assoc($selectare2)['gen'];//genul celui ce a postat,pentru momentul in care i se prezinta poza de profil
		$imagine = mysqli_query($db, "SELECT * FROM images where '$user' = images.username"); // selectarea pozei de profil daca exista din images dupa user
		$nrtopic = mysqli_query($db, "SELECT topic_id FROM topics WHERE '$user' = topics.author");
		$nrtopics = mysqli_num_rows($nrtopic); // numarul topicurilor create de utilizator
		$nrrasp = mysqli_query($db, "SELECT reply_id FROM replies WHERE '$user' = replies.author");
		$nrraspuns = mysqli_num_rows($nrrasp); // numarul de replys pe care l-a facut utilizatorul
		//mai jos se selecteaza continutul raspunsului la topic
		$selectare3 = mysqli_query($db, "SELECT author,comment,date_posted FROM replies WHERE ('$parent_id' = replies.category_id) and ('$child1_id' = replies.subcategory_id) and ('$child2_id' = replies.topic_id)"); 
		$n1 = mysqli_query($db, "SELECT category_title FROM categories WHERE '$parent_id' = categories.cat_id"); 
		$n2 = mysqli_query($db, "SELECT subcategory_title FROM subcategories WHERE ('$parent_id' = subcategories.parent_id) and ('$child1_id' = subcategories.subcat_id)"); 
		$n3 = mysqli_query($db, "SELECT author, title FROM topics WHERE ($child1_id = topics.subcategory_id) and ($child2_id = topics.topic_id)"); 
		$codu = $_GET['cod'];
	?>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../CSS/design.css">
<body style ="background-color:transparent;">
<div class="container">
    <div class="col-sm-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
			<?php 
				if ($codu) { ?>
                <li class="breadcrumb-item"><a href="pagecat.php?idcat=<?php echo $parent_id;?>&amp;idsubcat=<?php echo $child1_id;?>"><?php echo mysqli_fetch_assoc($n1)['category_title'];?></a></li>
                <li class="breadcrumb-item"><a href="subcategories.php?idcat=<?php echo $parent_id;?>&amp;idsubcat=<?php echo $child1_id;?>&amp;idtopic=<?php echo $child2_id;?>"><?php echo mysqli_fetch_assoc($n2)['subcategory_title'];?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo mysqli_fetch_assoc($n3)['title'];?> </li>
				<?php } else { ?>
				<li class="breadcrumb-item"><a href="categories.php?>"><?= _HOME; ?></a></li>
                <li class="breadcrumb-item"><a href="archived.php"><?= strtoupper(_ARC); ?></a></li>
                <li class="breadcrumb-item active" aria-current="page"><?php echo mysqli_fetch_assoc($n3)['title'];?> </li>
				<?php } ?>
            </ol>
        </nav>
	<?php 
		while ($row = mysqli_fetch_assoc($selectare))  :?>
        <div class="card post-header">
            <h1><?php echo ucfirst($row['title']); ?></h1>
			<h4><?php echo ucfirst($row['content']); ?></h4>
			<?php 
				$datanoua = $row['date_posted'];
				$newDate = date("d-m-Y", strtotime($datanoua)); //data postarii topicului
				 viewstopic($parent_id,$child1_id,$child2_id);?>
		
            <div class="row">
                <div class="col-sm-12 text-center"><span class="tag"> <?php echo $newDate; ?></span> <span class="tag"><a target="opener" href = "panel.php?idnume=<?php echo $user;?>&amp;code=0"><?php echo $row['author']; ?></a></span>  <span class="tag"><?php titlu($row['author'],$nrraspuns); ?></span></div>
				</div>
			<?php 
				if(isset($_SESSION['username'])) {
					$user3 = strtolower($_SESSION['username']);
					$select = mysqli_query($db, "SELECT * FROM users where (username='$user3')");
					$groupAdmin = mysqli_fetch_array($select);
					if ($groupAdmin['groupadmin']=='1' AND $codu == '1')  {?>				
						<div class="col-sm-12 text-center" style = "padding-top:5px;"><span class="tag"> <a href="archive.php?idcat=<?php echo $parent_id;?>&amp;idnume=<?php echo $row['author']; ?>&amp;idsubcat=<?php echo $child1_id;?>&amp;idtopic=<?php echo $child2_id;?>" target="opener"><?= _ARCH ?></a></span>
					</div>
				<?php } }?>
        </div>
    </div>
	<?php while ($row2 = mysqli_fetch_assoc($selectare3))  
				{
					$imagine2 = mysqli_query($db, "SELECT * FROM images where ('$row2[author]' = images.username)");//imaginea celui ce da raspunsul,daca exista una
					$genul = mysqli_query($db, "SELECT * FROM users WHERE '$row2[author]' = users.username"); 
					$gen2 = mysqli_fetch_assoc($genul)['gen'];//genul celui ce da raspunsul
					$nrtopic2 = mysqli_query($db, "SELECT topic_id FROM topics WHERE '$row2[author]' = topics.author");
					$nrtopics2 = mysqli_num_rows($nrtopic2);//numarul de topicuri create a celui ce da raspunsul
					$nrrasp2 = mysqli_query($db, "SELECT reply_id FROM replies WHERE '$row2[author]' = replies.author");
					$nrraspuns2 = mysqli_num_rows($nrrasp2); //numarul de raspunsuri date a celui ce da raspunsul
				?>
    <div class="col-sm-12">
        <div class="card post">
            <span class="date"><?php echo $row2['date_posted']; ?> <span class="span-post-no" style = "font-size;15px;"><?= ucfirst(strtolower(_REPLYED)); ?></span> </span>
            <div class="row">
                <div class="col-sm-3 user">
                    <div class="text-center">
					<?php if ($rand3 = mysqli_fetch_assoc($imagine2)){ ?> 
							<img width="90" height="140" style = "border-radius:50%;" class='img-fluid center-block' src="images/<?php echo $rand3['image']; ?>">
						<?php } elseif($gen2 == 'NEUTRU') { ?>
							<img width="90" height="140" style = "border-radius:50%;" class='img-fluid center-block' src='images/neutru.png' >
						<?php }
						elseif($gen2 == 'MASCULIN'){?>
							<img width="90" height="140" style = "border-radius:50%;" class='img-fluid center-block' src='images/masculin.png' >
						<?php } elseif($gen2 == 'FEMININ'){ ?>
							<img width="90" height="140" style = "border-radius:50%;" class='img-fluid center-block' src='images/feminin.png' >
						<?php }
							$datanoua = $row2['date_posted'];
							$newDate2 = date("d-m-Y H:i", strtotime($datanoua));//data la care acesta a postat raspunsul
					?>
                        <h3><?php echo $row2['author']; ?></h3>
                        <span class="tag"><?php titlu($row2['author'],$nrraspuns2); ?></span>
                        <table style="width:100%;margin-bottom:1.5em;margin-left:3px;">
                            <tr>
                                <td colspan="2" align="center" style="padding-top:5px;"> <a href="panel.php?idnume=<?php echo $row2['author'];?>&amp;code=0" class="profile-link">View profile</a></td>
                                <td></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="col-sm-9 post-content">
                    <?php echo $row2['comment']; ?>
                </div>
            </div>
        </div>
    </div>
				<?php }
				endwhile; ?>
<?php if (isset($_SESSION['username'])) 
{ $user2 = $_SESSION['username']; ?>				
    <div class="col-sm-12">
        <form action = "comment.php?nume1=<?php echo $user2;?>&amp;nume2=<?php echo $user;?>&amp;idcat=<?php echo $parent_id;?>&amp;idsubcat=<?php echo $child1_id;?>&amp;idtopic=<?php echo $child2_id;?>&amp;cod=<?php echo $codu;?>" method="post">
            <fieldset>
                <div class="form-group">
                    <textarea class="form-control" name="comment" rows="5" style="resize: none;" required cols="50"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Reply</button>
            </fieldset>
        </form>
    </div>
</div>
<?php } ?>
</body>
<!-- INSPIRED BY: https://www.thephotoforum.com/threads/dslr-vs-iphone-camera.430860/-->