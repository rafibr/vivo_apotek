  <div class="container-fluid">

  	<!-- DataTales Example -->
  	<div class="card shadow mb-4">
  		<div class="card-header py-3">
  			<h6 class="m-0 font-weight-bold text-primary">Tambah User</h6>
  		</div>
  		<div class="card-body">
  			<div class="table-responsive">


  				<div class="body">
  					<form method="POST" enctype="multipart/form-data" action="">

  						<label for="">NIK</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="number" name="nik" class="form-control" />
  							</div>
  						</div>



  						<label for="">Nama</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="nama" class="form-control" />
  							</div>
  						</div>




  						<label for="">Telepon</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="telepon" class="form-control" />
  							</div>
  						</div>


  						<label for="">Username</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="text" name="username" class="form-control" />

  							</div>
  						</div>

  						<label for="">Password</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="password" name="password" class="form-control" />


  							</div>
  						</div>

  						<label for="">Level</label>
  						<div class="form-group">
  							<div class="form-line">
  								<select name="level" class="form-control show-tick">
  									<option value="">-- Pilih Level --</option>
  									<option value="superadmin">Super Admin</option>
  									<option value="penjualan">Penjualan</option>
  									<option value="persediaan">Persediaan</option>

  								</select>
  							</div>
  						</div>

  						<label for="">Foto</label>
  						<div class="form-group">
  							<div class="form-line">
  								<input type="file" name="foto" class="form-control" />
  							</div>
  						</div>

  						<input type="submit" name="simpan" value="simpan" class="btn btn-primary">

  					</form>



  					<?php

						if (isset($_POST['simpan'])) {

							$nik = $_POST['nik'];
							$nama = $_POST['nama'];

							$telepon = $_POST['telepon'];
							$username = $_POST['username'];
							$password = md5($_POST['password']);
							$level = $_POST['level'];

							// change fotoName to profile_username.jpg
							$fotoExt = explode('.', $_FILES['foto']['name']);
							$fotoName = "profile_" . $username . "." . end($fotoExt);

							$lokasi = $_FILES['foto']['tmp_name'];
							$upload = move_uploaded_file($lokasi, "img/" . $fotoName);

							if ($upload) {

								// check if username already exist
								$sql = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$username'");
								$cek = mysqli_num_rows($sql);
								if ($cek > 0) {
									echo "<script>alert('Username sudah ada');</script>";
								} else {
									$sql = mysqli_query($koneksi, "INSERT INTO users VALUES ('$nik', '$nama', '$telepon', '$username', '$password', '$level', '$fotoName')");
									if ($sql) {
										echo "<script>alert('Data berhasil disimpan');</script>";
										echo "<script>location='index.php?page=pengguna';</script>";
									} else {
										echo "<script>alert('Data gagal disimpan');</script>";
									}
								}
							} else {
								echo "<script>alert('Gambar gagal diupload');</script>";
							}
						}

						?>