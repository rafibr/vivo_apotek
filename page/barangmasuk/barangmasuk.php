<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Pembelian</h6>
				</div>
				<div class="col-md-4 text-right">
					<a href="?page=barangmasuk&aksi=tambahbarangmasuk" class="btn btn-primary">Tambah</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover" id="dataTable" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Transaksi</th>
							<th>Tanggal Transaksi</th>
							<th>Supplier</th>
							<th>Jumlah Barang</th>
							<th>Nama Operator</th>
							<th>Pengaturan</th>
						</tr>
					</thead>


					<tbody>
						<?php

						$no = 1;
						$query = "select *, sum(jumlah) as total_item from barang_masuk group by kode_transaksi";
						// get data from database
						$result = mysqli_query($koneksi, $query);

						// array(8) { ["id"]=> string(1) "3" ["kode_transaksi"]=> string(3) "001" ["tanggal"]=> string(10) "2022-07-26" ["kode_barang"]=> string(11) "BAR-0722003" ["nama_barang"]=> string(2) "ss" ["kode_supplier"]=> string(11) "SUP-0722001" ["nama_supplier"]=> string(1) "a" ["jumlah"]=> string(2) "34" }
						while ($data = mysqli_fetch_assoc($result)) {
						?>
							<tr>
								<td><?= $no++; ?>.</td>
								<td>
									<a href="?page=barangmasuk&aksi=ubahbarangmasuk&kode_transaksi=<?= $data['kode_transaksi']; ?>">
										<?= $data['kode_transaksi']; ?>
									</a>
								</td>
								<td><?= date_format_indo($data['tanggal']); ?></td>
								<td><?= $data['nama_supplier']; ?></td>
								<td><?= $data['total_item']; ?></td>
								<td><?= $data['nama_operator']; ?></td>
								<td>
									<!-- button group   -->
									<div class="btn-group sm" role="group" aria-label="Basic example">
										<a href="?page=barangmasuk&aksi=ubahbarangmasuk&kode_transaksi=<?= $data['kode_transaksi']; ?>" class="btn btn-warning btn-sm">Detail</a>
										<!-- <a href="?page=barangmasuk&aksi=hapusbarangmasuk&kode_transaksi=</?= $data['kode_transaksi']; ?>" class="btn btn-danger btn-sm">Hapus</a> -->
									</div>
								</td>
							</tr>
						<?php
						}
						?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>