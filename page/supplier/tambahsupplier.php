<?php

$koneksi = new mysqli("localhost", "root", "", "apotek2");

// get last id
$sql = "SELECT * FROM tb_supplier ORDER BY id DESC LIMIT 1";
$result = $koneksi->query($sql);
$kode_supplier = '';
if ($result->num_rows > 0) {
	$data = $result->fetch_assoc();
	// check if data is empty
	$id = $data['id'] + 1;
} else {
	$id = 1;
}

// SUP-072200 + id
$bulan = date("m");
$tahun = date("y");
$kode_supplier = "SUP-" . $bulan . $tahun . "00" . $id;


?>




<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Supplier</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_supplier" class="form-control" id="kode_supplier" value="<?= $kode_supplier; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_supplier" class="form-control" />
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
						$kode_supplier = $_POST['kode_supplier'];
						$nama_supplier = $_POST['nama_supplier'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						$query = "INSERT INTO tb_supplier (kode_supplier, nama_supplier, alamat, telepon) VALUES ('$kode_supplier', '$nama_supplier', '$alamat', '$telepon')";
						$sql = $koneksi->query($query);
						var_dump($query);

						if ($sql) {
					?>
							<script type="text/javascript">
								alert("Data Berhasil Disimpan");
								window.location.href = "?page=supplier";
							</script>

					<?php
						}
					}


					?>