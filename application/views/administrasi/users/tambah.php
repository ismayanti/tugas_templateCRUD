<form action="<?php echo base_url() ?>index.php/administrator/simpan" method="post">
	<div class="form-group">
		<label>Nama Lengkap</label><br>
		<input type="text" name="fullname" class="form-control" placeholder="Nama Lengkap">
	</div>
	<div class="form-group">
		<label>Username</label><br>
		<input type="text" name="username" class="form-control" placeholder="username">
	</div>
	<div class="form-group">
		<label>Password</label><br>
		<input type="password" name="password" class="form-control" placeholder="password">
	</div>
	<div class="form-group">
		<input type="submit" name="simpan" class="btn btn-primary" value="simpan">
	</div>
</form>