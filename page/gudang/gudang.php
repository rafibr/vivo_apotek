<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Stok Gudang</h6>
				</div>
				<div class="col-md-4 text-right">
					<a href="?page=gudang&aksi=tambahgudang" class="btn btn-primary">Tambah Data Barang</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Barang</th>
							<th>Nama Barang</th>
							<th>Jenis Barang</th>
							<th>Jumlah Barang</th>
							<th>Expired Date</th>
							<th>Harga Beli</th>
							<th>Harga Jual</th>
							<th>Pengaturan</th>

						</tr>
					</thead>

					<tbody>
						<?php

						$no = 1;
						$query = "SELECT * FROM gudang join jenis_barang on gudang.id_jenis = jenis_barang.id";
						// get data from database
						$result = mysqli_query($koneksi, $query);
						$datas = mysqli_fetch_all($result, MYSQLI_ASSOC);
						// array(1) { [0]=> array(8) { ["id"]=> string(2) "10" ["kode_barang"]=> string(11) "BAR-0722003" ["nama_barang"]=> string(6) "sacsac" ["id_jenis"]=> string(1) "8" ["jumlah"]=> string(1) "2" ["id_satuan"]=> string(2) "10" ["jenis_barang"]=> string(6) "Kapsul" ["satuan"]=> string(5) "Butir" } }

						foreach ($datas as $data) {
						?>
							<tr>
								<td><?= $no++ ?></td>
								<td><?= $data['kode_barang'] ?></td>
								<td><?= $data['nama_barang'] ?></td>
								<td><?= $data['jenis_barang'] ?></td>
								<td><?= $data['jumlah'] ?></td>
								<td><?= date_format_indo($data['exp_date']) ?></td>
								<td><?= rupiah($data['harga_beli']) ?></td>
								<td><?= rupiah($data['harga_jual']) ?></td>
								<td>
									<div class="btn-group btn-group-sm">
										<a href="?page=gudang&aksi=ubahgudang&kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-success">Ubah</a>
										<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=gudang&aksi=hapusgudang&kode_barang=<?= $data['kode_barang'] ?>" class="btn btn-danger">Hapus</a>
									</div>
								</td>
							</tr>
						<?php
						}

						?>
					</tbody>
				</table>
				</tbody>
				</table>
			</div>
		</div>
	</div>

</div>