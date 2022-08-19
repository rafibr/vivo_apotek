<?php

$koneksi = new mysqli("localhost", "root", "", "apotek2");
// get last id
$kode_trKeluar = $_GET['kode_transaksi'];
$query = "select *,barang_keluar.id as id_barang_keluar from barang_keluar join tb_pelanggan on barang_keluar.kode_pelanggan = tb_pelanggan.kode_pelanggan where kode_transaksi ='" . $kode_trKeluar . "'";
$result = mysqli_query($koneksi, $query);

// if data is not found, then redirect to index.php?page=barangkeluar
if (mysqli_num_rows($result) < 1) {
?>
	<script>
		alert("Data tidak ditemukan");
		window.location.href = "index.php?page=barangkeluar";
	</script>
<?php
}
$data = [];
while ($row = mysqli_fetch_assoc($result)) {
	$data[] = $row;
}

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
								<input type="text" class="form-control" id="nama_operator" name="nama_operator" value="<?= $data[0]['nama_operator']; ?>" readonly required>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<!-- Tanggal Masuk -->
							<div class="form-group">
								<label for="tanggal_masuk">Tanggal Masuk</label>
								<input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk" value="<?= $data[0]['tanggal']; ?>" readonly required>
							</div>
						</div>
						<div class="col-md-6">
							<!-- Tujuan -->
							<div class="form-group">
								<label for="tujuan">Tujuan</label>
								<input type="text" class="form-control" id="tujuan" name="tujuan" value="<?= $data[0]['kode_pelanggan']; ?>|<?= $data[0]['tujuan']; ?>" readonly required>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>

	<!-- table Barang Keluar tambah dengan modal javascript -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">
				<div class="card-header py-3">
					<div class="row">
						<div class="col-md-6">
							<h6 class="m-0 font-weight-bold text-primary">Tambah Barang Keluar</h6>
						</div>
						<div class="col-md-6">
							<!-- button group  -->
							<div class="btn-group float-right">
								<button type="button" class="btn btn-primary" data-toggle="modal" id="tambahbarangkeluar">
									<i class="fas fa-plus"></i>
									Tambah Barang Keluar
								</button>
								<button type="button" class="btn btn-success" id="exportnota">
									<i class="fas fa-file-export"></i>
									Export Nota
								</button>
							</div>
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
								<?php
								$no = 1;
								$total_harga = 0;
								$total_jumlah = 0;
								foreach ($data as $data) {
									$total_jumlah += $data['jumlah'];
									$total_harga += $data['sub_total'];
								?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $data['kode_barang']; ?></td>
										<td><?= $data['nama_barang']; ?></td>
										<td align="right"><?= rupiah($data['harga_barang']); ?></td>
										<td align="right"><?= $data['jumlah']; ?></td>
										<td align="right"><?= rupiah($data['sub_total']); ?></td>
										<td>
											<div class="btn-group">
												<!-- <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editbarangkeluar<?= $data['id_barang_keluar']; ?>" data-id="<?= $data['id_barang_keluar']; ?>">
													<i class="fas fa-edit"></i>
												</button> -->
												<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#hapusbarangkeluar<?= $data['id_barang_keluar']; ?>" data-id="<?= $data['id_barang_keluar']; ?>">
													<i class="fas fa-trash"></i>
												</button>
											</div>
										</td>
									</tr>


									<!-- Modal Edit -->
									<div class="modal fade" id="editbarangkeluar<?= $data['id_barang_keluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<form action="" method="POST">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Edit Barang Keluar</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<input type="text" value="<?= $data['id_barang_keluar']; ?>" name="id_barang_keluar" hidden>
														<?php
														// Data from database :
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
														?>
														<div class="row">
															<div class="col-md-6">
																<!-- Kode Transaksi input -->
																<div class="form-group">
																	<label for="kode_transaksi<?= $data['id_barang_keluar']; ?>">Kode Transaksi</label>
																	<input type="text" class="form form-control" id="kode_transaksi<?= $data['id_barang_keluar']; ?>" value="<?= $data['kode_transaksi']; ?>" name="kode_transaksi" readonly>
																</div>
															</div>
															<div class="col-md-6">
																<!-- Nama Operator -->
																<div class="form-group">
																	<label for="operator<?= $data['id_barang_keluar']; ?>">Operator</label>
																	<input type="text" class="form form-control" id="operator<?= $data['id_barang_keluar']; ?>" value="<?= $data['nama_operator']; ?>" name="nama_operator" readonly>
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-12">
																<!-- tanggal transaksi -->
																<div class="form-group">
																	<label for="tanggal_transaksi<?= $data['id_barang_keluar']; ?>">Tanggal Transaksi</label>
																	<input type="date" class="form form-control" id="tanggal_transaksi<?= $data['id_barang_keluar']; ?>" value="<?= $data['tanggal']; ?>" name="tanggal_transaksi" readonly>
																</div>
															</div>
														</div>

														<div class="row">
															<!-- Tujuan -->
															<div class="col-md-12">
																<div class="form-group">
																	<label for="tujuan_edit<?= $data['id_barang_keluar']; ?>">Tujuan</label>
																	<input type="text" class="form form-control" id="tujuan_edit<?= $data['id_barang_keluar']; ?>" value="<?= $data['kode_pelanggan']; ?>|<?= $data['tujuan']; ?>" name="tujuan" readonly>
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-12">
																<!-- List Barang -->
																<div class="form-group">
																	<label for="barang<?= $data['id_barang_keluar']; ?>">Barang</label>
																	<!-- select2 -->
																	<select class="form-control select2" id="barang<?= $data['id_barang_keluar']; ?>" onchange="changeHargaBarang(<?= $data['id_barang_keluar']; ?>, this.value)" name="barang">
																		<option value="">Pilih Barang</option>
																		<?php
																		$sql = "SELECT * FROM gudang";
																		$result = $koneksi->query($sql);
																		if ($result->num_rows > 0) {
																			while ($dataGudang = $result->fetch_assoc()) {
																		?>
																				<option value="<?= $dataGudang['kode_barang']; ?>|<?= $dataGudang['nama_barang']; ?>|<?= $dataGudang['harga_beli']; ?>" <?= $data['kode_barang'] == $dataGudang['kode_barang'] ? 'selected' : ''; ?>>
																					<?= $dataGudang['kode_barang']; ?> | <?= $dataGudang['nama_barang']; ?>
																				</option>
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
																	<label for="kode_barang<?= $data['id_barang_keluar']; ?>">Kode Barang</label>
																	<input type="text" class="form form-control" id="kode_barang<?= $data['id_barang_keluar']; ?>" value="<?= $data['kode_barang']; ?>" name="kode_barang" readonly>
																</div>
															</div>
															<div class="col-md-6">
																<!-- Nama Barang -->
																<div class="form-group">
																	<label for="nama_barang<?= $data['id_barang_keluar']; ?>">Nama Barang</label>
																	<input type="text" class="form form-control" id="nama_barang<?= $data['id_barang_keluar']; ?>" value="<?= $data['nama_barang']; ?>" name="nama_barang" readonly>
																</div>
															</div>
														</div>

														<div class="row">
															<div class="col-md-6">
																<!-- Harga -->
																<div class="form-group">
																	<!-- prepend -->
																	<label for="harga<?= $data['id_barang_keluar']; ?>">Harga</label>
																	<div class="input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text">Rp</span>
																		</div>
																		<input type="text" class="form form-control" id="harga<?= $data['id_barang_keluar']; ?>" value="<?= $data['harga_barang']; ?>" onkeyup="changeSubTotal(<?= $data['id_barang_keluar']; ?>)" onchange="changeSubTotal(<?= $data['id_barang_keluar']; ?>)" name="harga">
																	</div>
																</div>
															</div>
															<div class="col-md-6">
																<!-- Jumlah -->
																<div class="form-group">
																	<label for="jumlah<?= $data['id_barang_keluar']; ?>">Jumlah</label>
																	<input type="text" class="form form-control" id="jumlah<?= $data['id_barang_keluar']; ?>" value="<?= $data['jumlah']; ?>" onkeyup="changeSubTotal(<?= $data['id_barang_keluar']; ?>)" onchange="changeSubTotal(<?= $data['id_barang_keluar']; ?>)" name="jumlah">
																</div>
															</div>
														</div>

														<div class="row">
															<!-- sub total -->
															<div class="col-md-12">
																<div class="form-group">
																	<label for="sub_total<?= $data['id_barang_keluar']; ?>">Sub Total</label>
																	<div class="input-group">
																		<div class="input-group-prepend">
																			<span class="input-group-text">Rp</span>
																		</div>
																		<input type="text" class="form form-control" id="sub_total<?= $data['id_barang_keluar']; ?>" value="<?= $data['sub_total']; ?>" name="sub_total" readonly>
																	</div>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="update" value="update">Update</button>
													</div>
												</div>
											</form>
										</div>
									</div>

									<!-- Modal Hapus -->
									<div class="modal fade" id="hapusbarangkeluar<?= $data['id_barang_keluar']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<form action="" method="POST">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Hapus Data</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														<ul class="list-group">
															<li class="list-group-item">
																<h5>Apakah anda yakin ingin menghapus data ini?</h5>
															</li>
															<li class="list-group-item">
																<h5>ID Barang Keluar : <?= $data['id_barang_keluar']; ?></h5>
															</li>
															<li class="list-group-item">
																<h5>Nama Barang : <?= $data['nama_barang']; ?></h5>
															</li>
															<li class="list-group-item">
																<h5>Harga Barang : <?= rupiah($data['harga_barang']); ?></h5>
															</li>
															<li class="list-group-item">
																<h5>Jumlah Barang : <?= $data['jumlah']; ?></h5>
															</li>
															<li class="list-group-item">
																<h5>Sub Total : <?= $data['sub_total']; ?></h5>
															</li>
														</ul>
														<input type="hidden" name="id_barang_keluar" value="<?= $data['id_barang_keluar']; ?>">
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
														<button type="submit" class="btn btn-primary" name="hapus" value="hapus">Hapus</button>
													</div>
												</div>
											</form>
										</div>
									</div>


								<?php
								}
								?>

								<!-- tr for total -->
								<tr class="font-weight-bold">
									<td colspan="4" align="right">
										<h5>Total: </h5>
									</td>
									<td align="right">
										<h5><?= $total_jumlah; ?></h5>
									</td>
									<td align="right">
										<h5><?= rupiah($total_harga); ?></h5>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal Tambah Barang Keluar -->
	<div class="modal fade" id="modalTambahbarangkeluar" tabindex="-1" role="dialog" aria-labelledby="modalTambahbarangkeluarLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<form action="" method="POST">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="modalTambahbarangkeluarLabel">Tambah Barang Keluar</h5>
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
									<input type="date" class="form form-control" id="tanggal_transaksi" name="tanggal_transaksi" value="<?= date('Y-m-d'); ?>" readonly>
								</div>
							</div>
						</div>

						<div class="row">
							<!--  Tujuan -->
							<div class="col-md-12">
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
// add new data to database
if (isset($_POST['tambah'])) {
	$jumlah = $_POST['jumlah'];

	// check if stok is enough
	$sql = "SELECT * FROM gudang WHERE kode_barang = '$_POST[kode_barang]'";
	$result = $koneksi->query($sql);
	$data = $result->fetch_assoc();

	// if stok is not enough
	if ($data['jumlah'] < $jumlah) {
		echo "<script>alert('Stok tidak cukup');</script>";
		echo "<script>location='index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=$kode_trKeluar';</script>";
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
	$tujuan = explode("|", $_POST['tujuan_tambah']);
	$kode_pelanggan = $tujuan[0];
	$nama_pelanggan = $tujuan[1];


	// get all input from modal
	$kode_transaksi = $_POST['kode_transaksi'];
	$nama_operator = $_POST['operator'];
	$tanggal = $_POST['tanggal_transaksi'];
	$kode_barang = $_POST['kode_barang'];
	$nama_barang = $_POST['nama_barang'];
	$jumlah = $_POST['jumlah'];
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

	// index.php?page=barangmasuk&aksi=ubahbarangmasuk&kode_transaksi=TRM-0722001

	// index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=TRM-0722001
	if ($result) {
		echo "<script>alert('Data berhasil ditambahkan');</script>";
		echo "<script>location='index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=$kode_transaksi';</script>";
	} else {
		echo "<script>alert('Data gagal ditambahkan');</script>";
		echo "<script>location='index.php?page=barangkeluar';</script>";
	}
}

// delete data to database
if (isset($_POST['hapus'])) {

	$id_barang_keluar = $_POST['id_barang_keluar'];

	$transaksiKeluar = "Select * FROM barang_keluar WHERE id = '$id_barang_keluar'";
	$result = mysqli_query($koneksi, $transaksiKeluar);
	$row = mysqli_fetch_assoc($result);

	$jumlah_barang = $row['jumlah'];

	// update gudang
	$query = "UPDATE gudang SET jumlah = jumlah + $jumlah_barang WHERE kode_barang='$row[kode_barang]'";
	$result = mysqli_query($koneksi, $query);

	// get all input from modal edit
	$id_barang_keluar = $_POST['id_barang_keluar'];
	$kode_transaksi = $_GET['kode_transaksi'];
	$query = "DELETE FROM barang_keluar WHERE id='$id_barang_keluar'";
	$result = mysqli_query($koneksi, $query);

	// index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=TRM-0722001
	if ($result) {
		echo "<script>alert('Data berhasil dihapus');</script>";
		echo "<script>location='index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=$kode_transaksi';</script>";
	} else {
		echo "<script>alert('Data gagal dihapus');</script>";
		echo "<script>location='index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=$kode_transaksi';</script>";
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
		if (tujuan == '') {
			alert('Masukkan Tujuan');
			return false;
		}
		// set tujuan to modal
		$('#tujuan_tambah').val(tujuan);

		$('#modalTambahbarangkeluar').modal('show');
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

	// changeHargaBarang(id) -> for edit
	function changeHargaBarang(id, item) {
		console.log(id);
		console.log(item);
		// // BAR-0722007|ssd|2
		var barang = item.split('|');
		var kode_barang = barang[0];
		var nama_barang = barang[1];
		var harga = barang[2];

		// set kode_barang to modal_edit with id
		$('#kode_barang' + id).val(kode_barang);
		$('#nama_barang' + id).val(nama_barang);
		$('#harga' + id).val(harga);

		// sub total
		var jumlah = $('#jumlah' + id).val();
		var sub_total = harga * jumlah;
		$('#sub_total' + id).val(sub_total);
	}

	// changeSubTotal(id) -> for edit
	function changeSubTotal(id) {
		// BAR-0722007|ssd|2
		var harga = $('#harga' + id).val();
		var jumlah = $('#jumlah' + id).val();

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
		$('#sub_total' + id).val(sub_total);
	}

	// #exportnota
	$('#exportnota').click(function() {
		// get all get variabel
		var page = 'barangkeluar';
		var aksi = 'exportnota';
		var kode_transaksi = $('#kode_transaksi').val();

		console.log(page);
		console.log(aksi);
		console.log(kode_transaksi);

		// index.php?page=barangkeluar&aksi=ubahbarangkeluar&kode_transaksi=TRK-0722001
		$.ajax({
			type: 'GET',
			url: 'page/barangkeluar/notabarangkeluar.php?page=' + page + '&aksi=' + aksi + '&kode_transaksi=' + kode_transaksi,
			success: function(data) {
				// console.log(data);
				window.location.href = 'page/barangkeluar/notabarangkeluar.php?page=' + page + '&aksi=' + aksi + '&kode_transaksi=' + kode_transaksi;
			}
		});
	});
</script>