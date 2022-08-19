<?php
$koneksi = new mysqli("localhost", "root", "", "apotek2");

// get last id
$sql = "SELECT * FROM tb_pelanggan ORDER BY id DESC LIMIT 1";
$result = $koneksi->query($sql);
$kode_pelanggan = '';
if ($result->num_rows > 0) {
	$data = $result->fetch_assoc();
	// check if data is empty
	$id = $data['id'] + 1;
} else {
	$id = 1;
}

// PEl-072200 + id
$bulan = date("m");
$tahun = date("y");
$kode_pelanggan = "PEL-" . $bulan . $tahun . "00" . $id;
?>




<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Pelanggan</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">

				<div class="body">

					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Pelanggan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_pelanggan" class="form-control" id="kode_pelanggan" value="<?= $kode_pelanggan; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Pelanggan</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_pelanggan" class="form-control" />
							</div>
						</div>

						<label for="">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="alamat" class="form-control" />
							</div>
						</div>


						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" class="form-control" />
							</div>
						</div>

						<input type="submit" name="simpan" value="simpan" class="btn btn-primary">

					</form>




					<?php

					if (isset($_POST['simpan'])) {
						$kode_pelanggan = $_POST['kode_pelanggan'];
						$nama_pelanggan = $_POST['nama_pelanggan'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						$sql = $koneksi->query("insert into tb_pelanggan (kode_pelanggan, nama_pelanggan, alamat, telpon) values('$kode_pelanggan','$nama_pelanggan','$alamat','$telepon')");

						if ($sql) {
					?>
							<script type="text/javascript">
								alert("Data Berhasil Disimpan");
								window.location.href = "?page=pelanggan";
							</script>

					<?php
						}
					}


					?>