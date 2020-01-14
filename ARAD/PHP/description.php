<form action = "adddescription.php?nume=<?php echo $row['username'];?>&amp;code=0" method="post">
		<div style = "padding-bottom:5px;" align = "center">
			<textarea class="form-control" name="description" rows="8" style="resize: none;" maxlength="150" required placeholder="<?= _ABOUTU; ?>" cols="20"></textarea>
		</div>
		<div align="center">
			<button type="submit" class="btn btn-primary"><?= _UPDATE; ?></button>
		</div>
</form>
<link rel="stylesheet" type = "text/css" href="../CSS/description.css">