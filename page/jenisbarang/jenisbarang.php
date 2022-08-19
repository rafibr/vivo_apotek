<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Jenis Barang</h6>
				</div>
				<div class="col-md-4 text-right">
					<a href="?page=jenisbarang&aksi=tambahjenisbarang" class="btn btn-primary">Tambah Jenis Barang</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Jenis Barang</th>
							<th>Pengaturan</th>
						</tr>
					</thead>

					<tbody>
						<?php
						$no = 1;
						$sql = $koneksi->query("select * from jenis_barang");
						while ($data = $sql->fetch_assoc()) {
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data['jenis_barang'] ?></td>
								<td>
									<!-- button group small -->
									<div class="btn-group btn-group-sm">
										<a href="?page=jenisbarang&aksi=ubahjenisbarang&id_barang=<?= $data['id'] ?>" class="btn btn-success">Ubah</a>
										<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=jenisbarang&aksi=hapusjenisbarang&id=<?= $data['id'] ?>" class="btn btn-danger">Hapus</a>
									</div>
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