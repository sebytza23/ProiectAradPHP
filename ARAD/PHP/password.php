<form method="post" action="insertpass.php?nume=<?php echo $row['username'];?>&amp;code=3">
	<div style = "padding-bottom:5px;" align = "center" style="padding-top:5px;padding-bottom:5px;">
		<input class="form-control" type='password'  name="pprin" rows="8" style="resize: none;" maxlength="150" required placeholder="<?= _PASSWORD3; ?>" cols="20">
	</div>
	<div style = "padding-bottom:5px;" align = "center" style="padding-top:5px;padding-bottom:5px;">
		<input class="form-control" type='password' name="p1" rows="8" style="resize: none;" maxlength="150" required placeholder="<?= _PASSNEW; ?>" cols="20">
	</div>
	<div style = "padding-bottom:5px;" align = "center" style="padding-top:5px;padding-bottom:5px;">
		<input class="form-control" type='password' name="p2" rows="8" style="resize: none;" maxlength="150" required placeholder="<?= _PASSWORD2; ?>" cols="20">
	</div>
	<div align="center">
			<button type="submit" class="btn btn-primary" ><?= _UPDATE5; ?></button>
	</div>
</form>