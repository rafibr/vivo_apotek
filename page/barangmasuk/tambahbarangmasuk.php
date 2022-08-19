<?php

$koneksi = new mysqli("localhost", "root", "", "apotek2");
// get last id
$sql = "SELECT * FROM barang_masuk ORDER BY id DESC LIMIT 1";
$result = $koneksi->query($sql);
$kode_trMasuk = '';
if ($result->num_rows > 0) {
	$data = $result->fetch_assoc();
	// check if data is empty
	$id = $data['id'] + 1;
} else {
	$id = 1;
}

// TRM-072200 + id
$bulan = date("m");
$tahun = date("y");
$kode_trMasuk = "TRM-" . $bulan . $tahun . "00" . $id;

// date now for tanggal_masuk
$tanggal_now = date("Y-m-d");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk</h6>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-6">
							<!-- kode transaksi -->
							<div class="form-group">
								<label for="kode_trMasuk">Kode Transaksi</label>
								<input type="text" class="form-control" id="kode_trMasuk" name="kode_trMasuk" value="<?= $kode_trMasuk; ?>" readonly required>
							</div>
						</div>
						<div class="col-md-6">
							<!-- Nama Operator -->
							<div class="form-group">
								<label for="nama_operator">Nama Operator</label>
								<input type="text" class="form-control" id="nama_operator" name="nama_operator" value="<?= $_SESSION['nama']; ?>" readonly required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<!-- Tanggal Masuk -->
							<div class="form-group">
								<label for="tanggal_masuk">Tanggal Masuk</label>
								<input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $tanggal_now; ?>" required>
							</div>
						</div>
						<div class="col-md-6">
							<!-- List Supplier -->
							<div class="form-group">
								<label for="supplier">Supplier</label>
								<!-- select2 -->
								<select class="form-control select2" id="supplier" name="supplier" required>
									<option value="">Pilih Supplier</option>
									<?php
									$sql = "SELECT * FROM tb_supplier";
									$result = $koneksi->query($sql);
									if ($result->num_rows > 0) {
										while ($data = $result->fetch_assoc()) {
									?>
											<option value="<?= $data['kode_supplier']; ?>|<?= $data['nama_supplier']; ?>"><?= $data['nama_supplier']; ?></option>
									<?php
											// echo "<option value='" . $data['kode_supplier'] . "'>" . $data['nama_supplier'] . "</option>";
										}
									}
									?>
								</select>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- table barang masuk tambah dengan modal javascript -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<div class="row">
						<div class="col-md-6">
							<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Masuk</h6>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary float-right" data-toggle="modal" id="tambahBarangMasuk">
								<i class="fas fa-plus"></i>
								Tambah Barang Masuk
							</button>
						</div>
					</div>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataBarang" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Subtotal</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<div class="list-barang">
								</div>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Barang Masuk -->
	<div class="modal fade" id="modalTambahBarangMasuk" tabindex="-1" role="dialog" aria-labelledby="modalTambahBarangMasukLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalTambahBarangMasukLabel">Tambah Barang Masuk</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-6">
								<!-- Kode Transaksi input -->
								<div class="form-group">
									<label for="kode_transaksi">Kode Transaksi</label>
									<input type="text" class="form form-control" id="kode_transaksi" name="kode_transaksi" value="<?= $kode_trMasuk; ?>" readonly>
								</div>
							</div>
							<div class="col-md-6">
								<!-- Nama Operator -->
								<div class="form-group">
									<label for="operator">Operator</label>
									<input type="text" class="form form-control" id="operator" name="operator" value="<?= $_SESSION['nama']; ?>" readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!-- tanggal transaksi -->
								<div class="form-group">
									<label for="tanggal_transaksi">Tanggal Transaksi</label>
									<input type="date" class="form form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="<?= date('Y-m-d'); ?>">
								</div>
							</div>
						</div>

						<div class="row">
							<!-- kode supplier -->
							<div class="col-md-6">
								<div class="form-group">
									<label for="kode_supplier">Kode Supplier</label>
									<input type="text" class="form-control" id="kode_supplier" name="kode_supplier" required readonly>
								</div>
							</div>
							<div class="col-md-6">
								<!-- supplier name -->
								<div class="form-group">
									<label for="supplier_name">Nama Supplier</label>
									<input type="text" class="form-control" id="supplier_name" name="supplier_name" required readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!-- List Barang -->
								<div class="form-group">
									<div class="row">
										<div class="col-md-12">
											<label for="barang">Barang</label>
										</div>
									</div>

									<div class="row">
										<div class="col-md-12">
											<!-- select2 -->
											<select class="form-control select2" id="barang" name="barang" width="100%" required>
												<option value="">Pilih Barang</option>
												<?php
												$sql = "SELECT * FROM gudang";
												$result = $koneksi->query($sql);
												if ($result->num_rows > 0) {
													while ($data = $result->fetch_assoc()) {
														// echo "<option value='" . $data['kode_barang'] . "'>" . $data['nama_barang'] . "</option>";
												?>
														<option value="<?= $data['kode_barang']; ?>|<?= $data['nama_barang']; ?>|<?= $data['harga_beli']; ?>
											"><?= $data['kode_barang']; ?> | <?= $data['nama_barang']; ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
									</div>

								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<!-- kode barang -->
								<div class="form-group">
									<label for="kode_barang">Kode Barang</label>
									<input type="text" class="form-control" id="kode_barang" name="kode_barang" required readonly>
								</div>
							</div>
							<div class="col-md-6">
								<!-- Nama Barang -->
								<div class="form-group">
									<label for="nama_barang">Nama Barang</label>
									<input type="text" class="form-control" id="nama_barang" name="nama_barang" required readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<!-- Harga -->
								<div class="form-group">
									<!-- prepend -->
									<label for="harga">Harga</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp.</span>
										</div>
										<input type="text" class="form-control" id="harga" name="harga" required>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<!-- Jumlah -->
								<div class="form-group">
									<label for="jumlah">Jumlah</label>
									<input type="text" class="form-control" id="jumlah" name="jumlah" required>
								</div>
							</div>
						</div>

						<div class="row">
							<!-- sub total -->
							<div class="col-md-12">
								<div class="form-group">
									<label for="sub_total">Sub Total</label>
									<div class="input-group">
										<div class="input-group-prepend">
											<span class="input-group-text">Rp.</span>
										</div>
										<input type="text" class="form-control" id="sub_total" name="sub_total" required readonly>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="tambah" value="tambah">Tambah</button>
					</div>
				</div>
			</form>
		</div>
	</div>

</div>


<!-- save data to database -->
<?php
if (isset($_POST['tambah'])) {
	// kode_transaksi
	// nama_operator	
	// tanggal	
	// kode_barang	
	// nama_barang	
	// kode_supplier	
	// nama_supplier	
	// jumlah	
	// sub_total

	// get all input from modal
	$kode_transaksi = $_POST['kode_transaksi'];
	$nama_operator = $_POST['operator'];
	$tanggal = $_POST['tanggal_transaksi'];
	$kode_supplier = $_POST['kode_supplier'];
	$nama_supplier = $_POST['supplier_name'];
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$harga_barang = $_POST['harga'];
	$jumlah = $_POST['jumlah'];
	$jumlah_sisa = $_POST['jumlah'];
	$sub_total = $_POST['sub_total'];

	// check jumlah barang
	$query_check_jumlah = mysqli_query($koneksi, "SELECT * FROM gudang WHERE kode_barang = '$kode_barang'");
	$row_check_jumlah = mysqli_fetch_assoc($query_check_jumlah);
	$jumlah_barang = $row_check_jumlah['jumlah'];

	
	// jika jumlah_barang + jumlah_beli > 2000, then show error
	if ($jumlah_barang + $jumlah > 2000) {
		echo "<script>alert('Jumlah barang melebihi batas maksimal 2000')</script>";
		echo "<script>window.location='index.php?page=barangmasuk'</script>";
		return false;
	} 

	// insert to database
	$query = "INSERT INTO barang_masuk (kode_transaksi, nama_operator, tanggal, kode_supplier, nama_supplier, kode_barang, nama_barang, harga_barang, jumlah, jumlah_sisa, sub_total) VALUES ('$kode_transaksi', '$nama_operator', '$tanggal', '$kode_supplier', '$nama_supplier', '$kode_barang', '$nama_barang', '$harga_barang', '$jumlah', '$jumlah', '$sub_total')";
	$result = mysqli_query($koneksi, $query);

	// get last id from log_transaksi
	// if not found, set id to 1
	$query = "SELECT id FROM log_transaksi ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_assoc($result);
	$id = 0;
	if (mysqli_num_rows($result) > 0) {
		$id = $row['id'] + 1;
	} else {
		$id = 1;
	}

	$keterangan = "masuk";
	// LOG-month + year + 00 + id
	$kode_log = "LOG-" . date("m") . date("y") . "00" . $id;

	// insert into log_transaksi
	$query = "INSERT INTO log_transaksi (
		kode_log, 
		kode_transaksi, 
		kode_barang, 
		keterangan, 
		barang_diproses, 
		harga_satuan,
		harga_total,
		barang_sekarang
	) VALUES (
		'$kode_log',
		'$kode_transaksi',
		'$kode_barang',
		'$keterangan',
		'$jumlah_sisa',
		'$harga_barang',
		'$sub_total',
		'$jumlah_sisa')";
	$result = mysqli_query($koneksi, $query);

	// index.php?page=barangmasuk&aksi=ubahbarangmasuk&kode_transaksi=TRM-0722001
	if ($result) {
		echo "<script>alert('Data berhasil ditambahkan');</script>";
		echo "<script>location='index.php?page=barangmasuk&aksi=ubahbarangmasuk&kode_transaksi=$kode_transaksi';</script>";
	} else {
		echo "<script>alert('Data gagal ditambahkan');</script>";
		echo "<script>location='index.php?page=barangmasuk';</script>";
	}
}
?>


<script>
	$(document).ready(function() {
		$('#barang').select2({
			placeholder: 'Pilih Barang',
			allowClear: true,
			width: '100%',
		});

		$('#supplier').select2({
			placeholder: 'Pilih Supplier',
			allowClear: true,
			width: '100%',
		});
	});

	// tambahBarangMasuk
	$('#tambahBarangMasuk').click(function() {
		// supplier
		var supplier_id = $('#supplier').val();

		console.log(supplier_id);
		if (supplier_id == '') {
			alert('Pilih Supplier');
			return false;
		}

		// set supplier_id to modal
		var supplier = supplier_id.split('|');
		var kode_supplier = supplier[0];
		var nama_supplier = supplier[1];

		$('#kode_supplier').val(kode_supplier);
		$('#supplier_name').val(nama_supplier);


		$('#modalTambahBarangMasuk').modal('show');
	});

	// barang
	$('#barang').change(function() {
		// barang
		var barang_id = $('#barang').val();

		// set barang_id to modal
		var barang = barang_id.split('|');
		// delete space
		var kode_barang = (barang[0]).replace(/\s/g, '');
		var nama_barang = (barang[1]).replace(/\s/g, '');
		var harga = (barang[2]).replace(/\s/g, '');

		$('#kode_barang').val(kode_barang);
		$('#nama_barang').val(nama_barang);
		$('#harga').val(harga);

		// sub total
		var jumlah = $('#jumlah').val();
		var sub_total = harga * jumlah;
		$('#sub_total').val(sub_total);
	});

	// harga onchange jumlah onchange,keyup sub_total
	$('#harga, #jumlah').change(function() {
		var harga = $('#harga').val();
		var jumlah = $('#jumlah').val();

		// check if harga and jumlah is empty, then 0
		if (harga == '') {
			harga = 0;
		}
		if (jumlah == '') {
			jumlah = 0;
		}

		// calculate sub total
		var sub_total = harga * jumlah;

		// set sub total to modal
		$('#sub_total').val(sub_total);
	});
	$('#harga, #jumlah').keyup(function() {
		var harga = $('#harga').val();
		var jumlah = $('#jumlah').val();

		// check if harga and jumlah is empty, then 0
		if (harga == '') {
			harga = 0;
		}
		if (jumlah == '') {
			jumlah = 0;
		}

		// calculate sub total
		var sub_total = harga * jumlah;

		// set sub total to modal
		$('#sub_total').val(sub_total);
	});
</script>