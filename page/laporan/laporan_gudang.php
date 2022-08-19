<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-6">
					<h6 class="m-0 font-weight-bold text-primary">Kartu Persediaan</h6>
				</div>

			</div>
		</div>
		<div class="card-body">
			<div class="row">
				<div class="col-md-4">
					<!-- dropdown barang from table gudang -->
					<div class="form-group">
						<label for="kode_barang">Barang</label>
						<select name="kode_barang" id="kode_barang" class="form-control select2">
							<option value="">Pilih Barang</option>
							<?php
							$sql = $koneksi->query("SELECT * FROM gudang");
							while ($data = $sql->fetch_assoc()) {
								echo '<option value="' . $data['kode_barang'] . '">' . $data['nama_barang'] . '</option>';
							}
							?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<!-- dropdown bulan -->
					<div class="form-group">
						<label for="bulan">Bulan</label>
						<select name="bulan" id="bulan" class="form-control">
							<option value="">Pilih Bulan</option>
							<option value="1">Januari</option>
							<option value="2">Februari</option>
							<option value="3">Maret</option>
							<option value="4">April</option>
							<option value="5">Mei</option>
							<option value="6">Juni</option>
							<option value="7">Juli</option>
							<option value="8">Agustus</option>
							<option value="9">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<!-- dropdown tahun 2019 - now -->
					<div class="form-group">
						<label for="tahun">Tahun</label>
						<select name="tahun" id="tahun" class="form-control">
							<option value="">Pilih Tahun</option>
							<?php
							$tahun_skr = date('Y');
							for ($x = 2019; $x <= $tahun_skr; $x++) {
								echo '<option value="' . $x . '">' . $x . '</option>';
							}
							?>
						</select>
					</div>
				</div>

			</div>
			<div class="row">
				<div class="col-md-12 text-right">

					<!-- button group  -->
					<div class="btn-group">
						<button type="button" class="btn btn-info" id="export_xls"><i class="fas fa-file-excel"></i> Export</button>
						<button type="button" class="btn btn-dark" id="export_pdf"><i class="fas fa-file-pdf"></i> Export</button>
					</div>

				</div>
			</div>

			<hr>

			<div class="row">
				<div class="col-md-12">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Jenis Barang</th>
									<th>Jumlah Barang</th>
								</tr>
							</thead>


							<tbody>
								<?php

								$no = 1;
								$query = "SELECT * FROM gudang Join jenis_barang on gudang.id_jenis = jenis_barang.id";
								$sql = $koneksi->query($query);
								while ($data = $sql->fetch_assoc()) {

								?>
									<tr>
										<td><?= $no++; ?></td>
										<td><?= $data['kode_barang'] ?></td>
										<td><?= $data['nama_barang'] ?></td>
										<td><?= $data['jenis_barang'] ?></td>
										<td><?= $data['jumlah'] ?></td>
									</tr>
								<?php } ?>

							</tbody>
						</table>

					</div>
				</div>
			</div>

		</div>
	</div>

</div>

<script>
	// select2
	$(document).ready(function() {
		$('.select2').select2();
	});

	// export_xls
	$('#export_xls').click(function() {
		var kode_barang = $('#kode_barang').val();
		var bulan = $('#bulan').val() == '' ? <?= date('m') ?> : $('#bulan').val();
		var tahun = $('#tahun').val() == '' ? <?= date('Y') ?> : $('#tahun').val();
		var jenis = 'xls';

		var url = 'page/laporan/export_laporan_gudang.php?kode_barang=' + kode_barang + '&bulan=' + bulan + '&tahun=' + tahun + '&jenis=' + jenis;
		$.ajax({
			type: 'GET',
			url: url,
			success: function(data) {
				window.location.href = url;
			}
		});
	});
	// export_pdf
	$('#export_pdf').click(function() {
		var kode_barang = $('#kode_barang').val();
		var bulan = $('#bulan').val() == '' ? <?= date('m') ?> : $('#bulan').val();
		var tahun = $('#tahun').val() == '' ? <?= date('Y') ?> : $('#tahun').val();
		var jenis = 'pdf';

		var url = 'page/laporan/export_laporan_gudang.php?kode_barang=' + kode_barang + '&bulan=' + bulan + '&tahun=' + tahun + '&jenis=' + jenis;
		$.ajax({
			type: 'GET',
			url: url,
			success: function(data) {
				window.location.href = url;
			}
		});
	});
</script>