<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Data Pelanggan</h6>
				</div>
				<div class="col-md-4 text-right">
					<a href="?page=pelanggan&aksi=tambahpelanggan" class="btn btn-primary">Tambah Data Pelanggan</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Pelanggan</th>
							<th>Nama Pelanggan</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<th>Pengaturan</th>

						</tr>
					</thead>


					<tbody>
						<?php

						$no = 1;
						$sql = $koneksi->query("select * from tb_pelanggan");
						while ($data = $sql->fetch_assoc()) {

						?>

							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data['kode_pelanggan'] ?></td>
								<td><?= $data['nama_pelanggan'] ?></td>
								<td><?= $data['alamat'] ?></td>
								<td><?= $data['telpon'] ?></td>


								<td>
									<a href="?page=pelanggan&aksi=ubahpelanggan&kode_pelanggan=<?= $data['kode_pelanggan'] ?>" class="btn btn-success">Ubah</a>
									<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=pelanggan&aksi=hapuspelanggan&id=<?= $data['kode_pelanggan'] ?>" class="btn btn-danger">Hapus</a>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
				</tbody>
				</table>
			</div>
		</div>
	</div>

</div>