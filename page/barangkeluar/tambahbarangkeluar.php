<?php

$koneksi = new mysqli("localhost", "root", "", "apotek2");
// get last id
$sql = "SELECT * FROM barang_keluar ORDER BY id DESC LIMIT 1";
$result = $koneksi->query($sql);
$kode_trKeluar = '';
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
$kode_trKeluar = "TRK-" . $bulan . $tahun . "00" . $id;

// date now for tanggal_masuk
$tanggal_now = date("Y-m-d");

?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
				</div>
				<div class="card-body">

					<div class="row">
						<div class="col-md-6">
							<!-- kode transaksi -->
							<div class="form-group">
								<label for="kode_trKeluar">Kode Transaksi</label>
								<input type="text" class="form-control" id="kode_trKeluar" name="kode_trKeluar" value="<?= $kode_trKeluar; ?>" readonly required>
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
						<div class="col-md-4">
							<!-- Tujuan -->
							<div class="form-group" id="tujuandiv">
								<label for="tujuan">Tujuan</label>
								<!-- get list from database tb_pelanggan -->
								<select class="form-control select2" id="tujuan" name="tujuan" required>
									<option value="">Pilih Tujuan</option>
									<?php
									$sql = $koneksi->query("select * from tb_pelanggan");
									while ($data = $sql->fetch_assoc()) {
									?>
										<option value="<?= $data['kode_pelanggan']; ?>|<?= $data['nama_pelanggan']; ?>"><?= $data['kode_pelanggan']; ?>|<?= $data['nama_pelanggan']; ?></option>
									<?php
									}
									?>
								</select>
							</div>

							<!-- tujuan with input text (hidden) -->
							<div class="form-group" id="tujuan_laindiv" style="display: none;">
								<label for="tujuan_lain">Tujuan Lain</label>
								<input type="text" class="form-control" id="tujuan_lain" name="tujuan_lain" placeholder="Tujuan Lain">
							</div>
						</div>
						<div class="col-md-2">
							<!-- check list apakah pelanggan baru? -->
							<div class="form-group">
								<label for="check_pelanggan">Pelanggan Baru?</label>
								<input type="checkbox" class="form-control" id="check_pelanggan" name="check_pelanggan" onclick="checkPelanggan()">
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
							<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
						</div>
						<div class="col-md-6">
							<button type="button" class="btn btn-primary float-right" data-toggle="modal" id="tambahbarangkeluar">
								<i class="fas fa-plus"></i>
								Tambah Barang Keluar
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

	<!-- Modal Tambah Barang Keluar -->
	<div class="modal fade" id="modalBarangKeluar" tabindex="-1" role="dialog" aria-labelledby="modalBarangKeluarLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<input type="checkbox" id="pelanggan_baru" name="pelanggan_baru">
						<h5 class="modal-title" id="modalBarangKeluarLabel">Tambah Barang Keluar</h5>
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
									<input type="text" class="form form-control" id="kode_transaksi" name="kode_transaksi" value="<?= $kode_trKeluar; ?>" readonly>
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
							<div class="col-md-12">
								<!-- tujuan_tambah -->
								<div class="form-group">
									<label for="tujuan_tambah">Tujuan</label>
									<input type="text" class="form-control" id="tujuan_tambah" name="tujuan_tambah" required readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!-- List Barang -->
								<div class="form-group">
									<label for="barang">Barang</label>
									<!-- select2 -->
									<select class="form-control select2" id="barang" name="barang" required>
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
	$jumlah = $_POST['jumlah'];
	$pelanggan_baru = false;
	if (isset($_POST['pelanggan_baru'])) {
		$pelanggan_baru = true;
	}



	// check if stok is enough
	$sql = "SELECT * FROM gudang WHERE kode_barang = '$_POST[kode_barang]'";
	$result = $koneksi->query($sql);
	$barang_jual = $result->fetch_assoc();

	// if stok is not enough
	if ($barang_jual['jumlah'] < $jumlah) {
		echo "<script>alert('Stok tidak cukup');</script>";
		return false;
	}

	// minimal penjualan 2 barang
	if ($jumlah < 2) {
		echo "<script>alert('Minimal penjualan 2 barang');</script>";
		return false;
	}

	// id
	// kode_transaksi
	// nama_operator
	// tanggal
	// kode_barang
	// nama_barang
	// jumlah
	// tujuan
	// harga_barang
	// sub_total

	// PEL-0722009|asdsad
	// split string

	$kode_pelanggan = '';
	$nama_pelanggan = '';
	// if pelanggan_baru is true, then insert new pelanggan to database
	if ($pelanggan_baru) {
		// get last id in tb_pelanggan
		$sql = "SELECT * FROM tb_pelanggan ORDER BY id DESC LIMIT 1";
		$result = $koneksi->query($sql);
		$last_id = $result->fetch_assoc();
		$last_id = $last_id['id'] + 1;

		// $kode_pelanggan = "PEL" mmyy00. $last_id;
		$kode_pelanggan = "PEL-" . date("my") . "00" . $last_id;
		$nama_pelanggan = $_POST['tujuan_tambah'];

		$query = "INSERT INTO tb_pelanggan (kode_pelanggan, nama_pelanggan) VALUES ('$kode_pelanggan', '$nama_pelanggan')";
		$result = mysqli_query($koneksi, $query);
	} else {
		$tujuan = explode("|", $_POST['tujuan_tambah']);
		$kode_pelanggan = $tujuan[0];
		$nama_pelanggan = $tujuan[1];
	}

	// get all input from modal
	$kode_transaksi = $_POST['kode_transaksi'];
	$nama_operator = $_POST['operator'];
	$tanggal = $_POST['tanggal_transaksi'];
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];

	$jumlah_sisa = $_POST['jumlah'];
	$kode_pelanggan = $kode_pelanggan;
	$tujuan = $nama_pelanggan;
	$harga_barang = $_POST['harga'];
	$sub_total = $_POST['sub_total'];

	// insert to database
	$query = "INSERT INTO barang_keluar (kode_transaksi, nama_operator, tanggal, kode_barang, nama_barang, jumlah, jumlah_sisa, tujuan, kode_pelanggan, harga_barang, sub_total) VALUES ('$kode_transaksi', '$nama_operator', '$tanggal', '$kode_barang', '$nama_barang', '$jumlah', '$jumlah', '$tujuan', '$kode_pelanggan', '$harga_barang', '$sub_total')";
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

	// Full texts
	// id	
	// kode_log	
	// kode_transaksi	
	// kode_barang	
	// keterangan	
	// barang_sisa	
	// tanggal


	// update barang_masuk jumlah_sisa where kode_barang = $kode_barang and from the lowest id
	$query = "Select * from barang_masuk where kode_barang = '$kode_barang' order by id";
	$result = mysqli_query($koneksi, $query);
	// get all data
	$row = mysqli_fetch_assoc($result);
	$id = 0;
	foreach ($result as $row) {
		if ($row['jumlah_sisa'] > 0) {
			$id = $row['id'];
			break;
		}
	}

	// update jumlah_sisa barang_masuk
	$barang_sekarang = 0; //jumlah_sisa = jumlah_sisa - $jumlah
	$query = "Select * from barang_masuk where id = '$id'";
	$result = mysqli_query($koneksi, $query);
	$row = mysqli_fetch_assoc($result);
	$barang_sekarang = $row['jumlah_sisa'];
	$barang_sisa = $barang_sekarang - $jumlah;
	$query = "UPDATE barang_masuk SET jumlah_sisa = '$barang_sisa' WHERE id = '$id'";
	$result = mysqli_query($koneksi, $query);

	$keterangan = "keluar";
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
		'$jumlah', 
		'$harga_barang', 
		'$sub_total', 
		'$barang_sekarang'
	)";
	$result = mysqli_query($koneksi, $query);

	// index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=TRM-0722001
	if ($result) {
		echo "<script>alert('Data berhasil ditambahkan');</script>";
		echo "<script>location='index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=$kode_transaksi';</script>";
	} else {
		echo "<script>alert('Data gagal ditambahkan');</script>";
		echo "<script>location='index.php?page=barangkeluar';</script>";
	}
}
?>


<script>
	$(document).ready(function() {
		// class select2 

		$('.select2').select2({
			width: '100%'
		});


	});

	// tambahbarangkeluar
	$('#tambahbarangkeluar').click(function() {
		// supplier
		var tujuan = $('#tujuan').val();
		var tujuan_lain = $('#tujuan_lain').val();
		var baru = $('#check_pelanggan').is(':checked');
		console.log(baru);

		if (tujuan == '' && baru == false) {
			alert('Masukkan Tujuan');
			return false;
		}

		if (tujuan_lain == '' && baru == true) {
			alert('Masukkan Tujuan Lain');
			return false;
		}

		// set tujuan to modal
		if (baru == true) {
			$('#tujuan_tambah').val(tujuan_lain);
		} else {
			$('#tujuan_tambah').val(tujuan);
		}

		$('#modalBarangKeluar').modal('show');
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

	// checkPelanggan = change dropdown to input
	function checkPelanggan() {
		// get from check box
		var baru = $('#check_pelanggan').is(':checked');

		// set pelanggan_baru checkbox in modal to true or false
		$('#pelanggan_baru').prop('checked', baru);

		console.log(baru);

		// hide #tujuan, and show #tujuan_input
		if (baru) {
			$('#tujuandiv').hide();

			$('#tujuan_laindiv').show();
		} else {
			$('#tujuandiv').show();

			$('#tujuan_laindiv').hide();
		}



	}
</script>