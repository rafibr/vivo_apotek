<?php



$koneksi = new mysqli("localhost", "root", "", "apotek2");
// get last id
$sql = "SELECT * from gudang order by kode_barang desc limit 1";
$result = $koneksi->query($sql);
$kode_barang = '';
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
$kode_barang = "BAR-" . $bulan . $tahun . "00" . $id;

$jumlah = 0;

?>





<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tambah Stok</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">

				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_barang" class="form-control" id="kode_barang" value="<?= $kode_barang; ?>" readonly />
							</div>
						</div>

						<label for="">Nama Barang</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_barang" class="form-control" required />
							</div>
						</div>

						<label for="">Jenis Barang</label>
						<div class="form-group">
							<div class="form-line">
								<select name="jenis_barang" class="form-control" required>
									<option value="">-- Pilih Jenis Barang --</option>
									<?php
									$sql = $koneksi->query("select * from jenis_barang order by id");
									while ($data = $sql->fetch_assoc()) {
										echo "<option value='$data[id]'>$data[jenis_barang]</option>";
									}
									?>
								</select>
							</div>
						</div>

						<label for="">Jumlah</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="jumlah" class="form-control" id="jumlah" value="<?= $jumlah; ?>" required />
							</div>
						</div>

						<!-- Expired Date -->
						<label for="">Expired Date</label>
						<div class="form-group">
							<div class="form-line">
								<input type="date" name="expired_date" class="form-control" required />
							</div>
						</div>

						<!-- Harga Beli -->
						<label for="">Harga Beli</label>
						<div class="form-group">
							<!-- prepend Rp -->
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="harga_beli" class="form-control" id="harga_beli" required />
							</div>
						</div>

						<!-- Harga Jual -->
						<label for="">Harga Jual</label>
						<div class="form-group">
							<!-- prepend Rp -->
							<div class="input-group">
								<div class="input-group-prepend">
									<span class="input-group-text">Rp</span>
								</div>
								<input type="text" name="harga_jual" class="form-control" id="harga_jual" required />
							</div>
						</div>

						<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
					</form>

					<?php

					if (isset($_POST['simpan'])) {

						$kode_barang = $_POST['kode_barang'];
						$nama_barang = $_POST['nama_barang'];
						$jenis_barang = $_POST['jenis_barang'];
						$jumlah = $_POST['jumlah'];
						$stok_awal = $_POST['jumlah'];
						$expired_date = $_POST['expired_date'];
						$harga_beli = $_POST['harga_beli'];
						$harga_jual = $_POST['harga_jual'];

						// id	
						// kode_barang	
						// nama_barang	
						// id_jenis	
						// jumlah	
						// stok_awal	
						// exp_date	
						// harga_beli	
						// harga_jual
						$query = "INSERT INTO gudang (kode_barang, nama_barang, id_jenis, jumlah, stok_awal, exp_date, harga_beli, harga_jual) VALUES ('$kode_barang', '$nama_barang', '$jenis_barang', '$jumlah', '$stok_awal', '$expired_date', '$harga_beli', '$harga_jual')";
						$sql = $koneksi->query($query);

						// add to barang_masuk

						// id kode_transaksi nama_operator tanggal kode_barang nama_barang kode_supplier nama_supplier jumlah jumlah_sisa harga_barang sub_total


						if ($sql) {
					?>
							<script type="text/javascript">
								alert("Data Berhasil Disimpan");
								window.location.href = "?page=gudang";
							</script>
					<?php
						}
					}
					?>