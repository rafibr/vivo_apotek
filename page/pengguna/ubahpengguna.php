<?php
$id = $_GET['id'];
$sql2 = $koneksi->query("select * from users where id = '$id'");
$tampil = $sql2->fetch_assoc();

$level = $tampil['level'];




?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah User</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">


				<div class="body">

					<form method="POST" enctype="multipart/form-data">

						<label for="">NIK</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="nik" value="<?= $tampil['nik']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Nama</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama" value="<?= $tampil['nama']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" value="<?= $tampil['telepon']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Username</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="username" value="<?= $tampil['username']; ?>" class="form-control" />

							</div>
						</div>

						<label for="">Password</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="password" value="<?= $tampil['password']; ?>" class="form-control" />

							</div>
						</div>


						<label for="">Level</label>
						<div class="form-group">
							<div class="form-line">
								<select name="level" class="form-control show-tick">
									<option value="">-- Pilih Level --</option>
									<option value="superadmin" <?php if ($level == 'superadmin') {
																	echo "selected";
																} ?>>Super Admin</option>
									<option value="penjualan" <?php if ($level == 'penjualan') {
																echo "selected";
															} ?>>Penjualan</option>
									<option value="persediaan" <?php if ($level == 'persediaan') {
																echo "selected";
															} ?>>Persediaan</option>

								</select>
							</div>
						</div>


						<label for="">Foto</label>
						<div class="form-group">
							<div class="form-line text-center">
								<img src="img/<?= $tampil['foto']; ?> " width="150px" height="150px" class="rounded-circle" />
							</div>
						</div>


						<label for="">Ganti Foto</label>
						<div class="form-group">
							<div class="form-line">
								<input type="file" name="foto" class="form-control" />

							</div>
						</div>



						<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						$nik = $_POST['nik'];
						$nama = $_POST['nama'];
						$telepon = $_POST['telepon'];
						$username = $_POST['username'];
						$password = $_POST['password'];
						$level = $_POST['level'];

						$foto = $_FILES['foto']['name'];
						$lokasi = $_FILES['foto']['tmp_name'];

						if (!empty($lokasi)) {
							$upload = move_uploaded_file($lokasi, "img/" . $foto);



							$sql = $koneksi->query("update users set nik='$nik', nama='$nama', telepon='$telepon', username='$username', level='$level', foto='$foto' where id='$id'");

							if ($sql) {
					?>

								<script type="text/javascript">
									alert("Data Berhasil Diubah");
									window.location.href = "?page=pengguna";
								</script>

							<?php
							}
						} else {

							$sql = $koneksi->query("update users set nik='$nik', username='$username', nama='$nama', telepon='$telepon', level='$level' where id='$id'");

							if ($sql) {
							?>

								<script type="text/javascript">
									alert("Data Berhasil Diubah");
									window.location.href = "?page=pengguna";
								</script>

					<?php
							}
						}
					}
					?>