<?php
$kode_barang = $_GET['kode_barang'];

$query = "select * from gudang join jenis_barang on gudang.id_jenis=jenis_barang.id where kode_barang='$kode_barang'";
$sql = $koneksi->query($query);

// get data from database
$tampil = $sql->fetch_assoc();

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

						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?= $tampil['kode_barang']; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" value="<?= $tampil['nama_barang']; ?>" class="form-control" />
							</div>
						</div>

						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="jenis_barang" class="form-control" />
								<?php
								$sql = $koneksi->query("select * from jenis_barang order by jenis_barang asc");
								while ($data = $sql->fetch_assoc()) {
								?>
									<option value="<?= $data['id']; ?>" <?php if ($tampil['jenis_barang'] == $data['jenis_barang']) {
																			echo "selected";
																		} ?>><?= $data['jenis_barang']; ?></option>
								<?php
								}
								?>
								</select>
							</div>
						</div>

						<!-- exp_date -->
						<label for="">Expired Date</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="exp_date" value="<?= $tampil['exp_date']; ?>" class="form-control" />
							</div>
						</div>

						<!-- Harga Beli -->
						<label for="">Harga Beli</label>
						<!-- prepend Rp -->
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="harga_beli" value="<?= $tampil['harga_beli']; ?>" class="form-control" />
							</div>
						</div>


						<!-- Harga Jual -->
						<label for="">Harga Jual</label>
						<div class="form-group">
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="harga_jual" value="<?= $tampil['harga_jual']; ?>" class="form-control" />
							</div>
						</div>


						<input type="submit" name="simpan" value="simpan" class="btn btn-primary">

					</form>



					<?php

					if (isset($_POST['simpan'])) {

						$kode_barang = $_POST['kode_barang'];
						$nama_barang = $_POST['nama_barang'];
						$jenis_barang = $_POST['jenis_barang'];
						$exp_date = $_POST['exp_date'];
						$harga_beli = $_POST['harga_beli'];
						$harga_jual = $_POST['harga_jual'];

						$query = "update gudang set nama_barang='$nama_barang', id_jenis='$jenis_barang', exp_date='$exp_date', harga_beli='$harga_beli', harga_jual='$harga_jual' where kode_barang='$kode_barang'";
						$sql = $koneksi->query($query);

						if ($sql) {
					?>

							<script type="text/javascript">
								alert("Data Berhasil Diubah");
								window.location.href = "?page=gudang";
							</script>

						<?php
						} else {
						?>

							<script type="text/javascript">
								alert("Data Gagal Diubah");
								window.location.href = "?page=gudang";
							</script>
					<?php
						}
					}
					?>
				</div>
			</div>
		</div>