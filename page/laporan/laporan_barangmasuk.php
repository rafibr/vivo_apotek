<?php
if (isset($_POST['cari'])) {
	$bulan = $_POST['bulan'] == '' ? date('m') : $_POST['bulan'];
	$tahun = $_POST['tahun'] == '' ? date('Y') : $_POST['tahun'];
	$bulan2 = $_POST['bulan2'] == '' ? date('m') : $_POST['bulan2'];
	$tahun2 = $_POST['tahun2'] == '' ? date('Y') : $_POST['tahun2'];
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">

			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Laporan Perbulan dan Pertahun Barang Masuk</h6>
				</div>
				<div class="col-md-4 text-right">
					<!-- button export to excel -->
				</div>
			</div>
		</div>
		<div class="card-body">
			<form action="" method="POST">
				<div class="row">
					<!-- search month and year from - month year to -->
					<div class="col-md-3">
						<div class="form-group">
							<label>Bulan</label>
							<select class="form-control" id="bulan" name="bulan">
								<option value="">Pilih Bulan</option>
								<option value="1" <?php
													if (isset($_POST['cari'])) {
														if ($bulan == '1') {
															echo 'selected';
														}
													}
													?>>Januari</option>
								<option value="2" <?php
													if (isset($_POST['cari'])) {
														if ($bulan == '2') {
															echo 'selected';
														}
													}
													?>>Februari</option>
								<option value="3" <?php
													if (isset($_POST['cari'])) {
														if ($bulan == '3') {
															echo 'selected';
														}
													}
													?>>Maret</option>
								<option value="4" <?php
													if (isset($_POST['cari'])) {
														if ($bulan == '4') {
															echo 'selected';
														}
													}
													?>>April</option>
								<option value="5" <?php
													if (isset($_POST['cari'])) {
														if ($bulan == '5') {
															echo 'selected';
														}
													}
													?>>Mei</option>
								<option value="6" <?php
													if (isset($_POST['cari'])) {
														if ($bulan == '6') {
															echo 'selected';
														}
													}
													?>>Juni</option>
								<option value="7" <?php if (isset($_POST['cari'])) {
														if ($bulan == '7') {
															echo 'selected';
														}
													} ?>>Juli</option>
								<option value="8" <?php if (isset($_POST['cari'])) {
														if ($bulan == '8') {
															echo 'selected';
														}
													} ?>>Agustus</option>
								<option value="9" <?php if (isset($_POST['cari'])) {
														if ($bulan == '9') {
															echo 'selected';
														}
													} ?>>September</option>
								<option value="10" <?php if (isset($_POST['cari'])) {
														if ($bulan == '10') {
															echo 'selected';
														}
													} ?>>Oktober</option>
								<option value="11" <?php if (isset($_POST['cari'])) {
														if ($bulan == '11') {
															echo 'selected';
														}
													} ?>>November</option>
								<option value="12" <?php if (isset($_POST['cari'])) {
														if ($bulan == '12') {
															echo 'selected';
														}
													} ?>>Desember</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>Tahun</label>
							<select class="form-control" id="tahun" name="tahun">
								<option value="">Pilih Tahun</option>
								<!-- loop year from 2015 -->
								<?php
								for ($i = 2020; $i <= date('Y'); $i++) { ?>
									<option value="<?= $i ?>" <?php if (isset($_POST['cari'])) {
																	if ($tahun == $i) {
																		echo 'selected';
																	}
																} ?>><?= $i ?></option>
								<?php }
								?>
							</select>
						</div>
					</div>

					<div class="col-md-3">
						<div class="form-group">
							<label>s/d Bulan</label>
							<select class="form-control" id="bulan2" name="bulan2">
								<option value="">Pilih Bulan</option>
								<option value="1" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '1') {
															echo 'selected';
														}
													} ?>>Januari</option>
								<option value="2" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '2') {
															echo 'selected';
														}
													} ?>>Februari</option>
								<option value="3" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '3') {
															echo 'selected';
														}
													} ?>>Maret</option>
								<option value="4" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '4') {
															echo 'selected';
														}
													} ?>>April</option>
								<option value="5" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '5') {
															echo 'selected';
														}
													} ?>>Mei</option>
								<option value="6" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '6') {
															echo 'selected';
														}
													} ?>>Juni</option>
								<option value="7" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '7') {
															echo 'selected';
														}
													} ?>>Juli</option>
								<option value="8" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '8') {
															echo 'selected';
														}
													} ?>>Agustus</option>
								<option value="9" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '9') {
															echo 'selected';
														}
													} ?>>September</option>
								<option value="10" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '10') {
															echo 'selected';
														}
													} ?>>Oktober</option>
								<option value="11" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '11') {
															echo 'selected';
														}
													} ?>>November</option>
								<option value="12" <?php if (isset($_POST['cari'])) {
														if ($bulan2 == '12') {
															echo 'selected';
														}
													} ?>>Desember</option>
							</select>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label>s/d Tahun</label>
							<select class="form-control" id="tahun2" name="tahun2">
								<option value="">Pilih Tahun</option>
								<!-- loop year from 2015 -->
								<?php
								for ($i = 2020; $i <= date('Y'); $i++) {
								?>
									<option value="<?php echo $i; ?>" <?php if (isset($_POST['cari'])) {
																			if ($tahun2 == $i) {
																				echo 'selected';
																			}
																		} ?>><?php echo $i; ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8"></div>
					<div class="col-md-4 text-right">
						<!-- button cari dan export group -->
						<div>
							<button type="submit" class="btn btn-primary" id="cari" name="cari" value="cari"><i class="fas fa-search"></i> Cari</button>
							<div class="btn-group" role="group" aria-label="Basic example">
								<button type="button" class="btn btn-info" id="exportxls"><i class="fas fa-file-excel"></i> Xls</button>
								<button type="button" class="btn btn-dark" id="exportpdf"><i class="fas fa-file-pdf"></i> Pdf</button>
							</div>
						</div>
					</div>
				</div>
			</form>
			<hr>
			<div class="tampung2">
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Kode Transaksi</th>
								<th>Tanggal Masuk</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah Masuk</th>
								<th>Harga Beli</th>
								<th>Supplier</th>
								<th>Total Harga</th>

							</tr>
						</thead>

						<!-- if isset cari then show table based on search -->
						<?php
						$query = "SELECT * FROM barang_masuk join gudang on barang_masuk.kode_barang=gudang.kode_barang join tb_supplier on barang_masuk.kode_supplier=tb_supplier.kode_supplier";
						// script untuk cari data
						if (isset($_POST['cari'])) {
							$bulan1 = $_POST['bulan'] == '' ? date('m') : $_POST['bulan'];
							$tahun1 = $_POST['tahun'] == '' ? date('Y') : $_POST['tahun'];
							$bulan2 = $_POST['bulan2'] == '' ? date('m') : $_POST['bulan2'];
							$tahun2 = $_POST['tahun2'] == '' ? date('Y') : $_POST['tahun2'];

							// select data berdasarkan tanggal
							$query = "SELECT * FROM barang_masuk join gudang on barang_masuk.kode_barang=gudang.kode_barang join tb_supplier on barang_masuk.kode_supplier=tb_supplier.kode_supplier WHERE MONTH(tanggal) BETWEEN '$bulan1' AND '$bulan2' AND YEAR(tanggal) BETWEEN '$tahun1' AND '$tahun2'";
						}
						?>
						<tbody>
							<?php
							$no = 1;
							$sql = $koneksi->query($query);
							while ($data = $sql->fetch_assoc()) {
							?>
								<tr>
									<td><?= $no++; ?></td>
									<td><?= $data['kode_transaksi'] ?></td>
									<td><?= date_format_indo($data['tanggal']) ?></td>
									<td><?= $data['kode_barang'] ?></td>
									<td><?= $data['nama_barang'] ?></td>
									<td><?= $data['jumlah'] ?></td>
									<td><?= rupiah($data['harga_beli']) ?></td>
									<td><?= $data['nama_supplier'] ?></td>
									<td><?= rupiah($data['sub_total']) ?></td>
								</tr>
							<?php } ?>

						</tbody>
					</table>

				</div>
			</div>
		</div>
	</div>
</div>

<script>
	// script untuk ajax post data ke page/laporan/export_laporan_barangmasuk_excel.php',
	// script untuk ajax post data ke page/laporan/export_laporan_barangkeluar_excel.php',
	$('#exportxls').click(function() {
		var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		var bulan2 = $('#bulan2').val();
		var tahun2 = $('#tahun2').val();
		var type = 'xls';
		$.ajax({
			type: 'GET',
			url: 'page/laporan/export_laporan_barangmasuk_excel.php?type=' + type + '&bulan=' + bulan + '&tahun=' + tahun + '&bulan2=' + bulan2 + '&tahun2=' + tahun2,
			success: function(data) {
				window.location.href = 'page/laporan/export_laporan_barangmasuk_excel.php?type=' + type + '&bulan=' + bulan + '&tahun=' + tahun + '&bulan2=' + bulan2 + '&tahun2=' + tahun2;
			}
		});
	});
	$('#exportpdf').click(function() {
		var bulan = $('#bulan').val();
		var tahun = $('#tahun').val();
		var bulan2 = $('#bulan2').val();
		var tahun2 = $('#tahun2').val();
		var type = 'pdf';
		$.ajax({
			type: 'GET',
			url: 'page/laporan/export_laporan_barangmasuk_excel.php?type=' + type + '&bulan=' + bulan + '&tahun=' + tahun + '&bulan2=' + bulan2 + '&tahun2=' + tahun2,
			success: function(data) {
				window.location.href = 'page/laporan/export_laporan_barangmasuk_excel.php?type=' + type + '&bulan=' + bulan + '&tahun=' + tahun + '&bulan2=' + bulan2 + '&tahun2=' + tahun2;
			}
		});
	});
</script>