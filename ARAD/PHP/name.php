<form method="post" action="insertname.php?nume=<?php echo $row['username'];?>&amp;code=2">
	<textarea class="form-control" type='text' style="resize: none;" name="numrl" required placeholder="<?= _NAME; ?>" minlength=8></textarea>
	<div align="center" style = "margin-bottom:-10px;margin-top:3px;">
			<button type="submit" class="btn btn-primary" ><?= _UPDATE2; ?></button>
	</div>
</form>
<link rel="stylesheet" type = "text/css" href="../CSS/description.css">