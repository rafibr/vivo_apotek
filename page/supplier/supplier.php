<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
				</div>
				<div class="col-md-4 text-right">
					<a href="?page=supplier&aksi=tambahsupplier" class="btn btn-primary">Tambah Data Supplier</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Supplier</th>
							<th>Nama Supplier</th>
							<th>Alamat</th>
							<th>Telepon</th>
							<th>Pengaturan</th>
						</tr>
					</thead>


					<tbody>
						<?php

						$no = 1;
						$sql = $koneksi->query("select * from tb_supplier");
						while ($data = $sql->fetch_assoc()) {
						?>
							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data['kode_supplier'] ?></td>
								<td><?= $data['nama_supplier'] ?></td>
								<td><?= $data['alamat'] ?></td>
								<td><?= $data['telepon'] ?></td>
								<td>
									<!-- button group small -->
									<div class="btn-group btn-group-sm">
										<a href="?page=supplier&aksi=ubahsupplier&kode_supplier=<?= $data['kode_supplier'] ?>" class="btn btn-success">Ubah</a>
										<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=supplier&aksi=hapussupplier&id=<?= $data['kode_supplier'] ?>" class="btn btn-danger">Hapus</a>
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