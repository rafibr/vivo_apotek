<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<div class="row">
				<div class="col-md-8">
					<h6 class="m-0 font-weight-bold text-primary">Data User</h6>
				</div>
				<div class="col-md-4 text-right">
					<a href="?page=pengguna&aksi=tambahpengguna" class="btn btn-primary">Tambah</a>
				</div>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" cellspacing="0">
					<thead>
						<tr>
							<th>No</th>
							<th>NIK</th>
							<th>Foto</th>
							<th>Nama</th>
							<th>Telepon</th>
							<th>Username</th>
							<th>Password</th>
							<th>Level</th>
							<th>Aksi</th>
						</tr>
					</thead>

					<tbody>
						<?php

						$no = 1;
						$sql = $koneksi->query("select * from users");
						while ($data = $sql->fetch_assoc()) {

							if ($_SESSION['level'] == "admin") {
								continue;
							}
							if ($_SESSION['level'] == "penjualan") {
								if ($data['level'] != "penjualan") {
									continue;
								}
							}

							if ($_SESSION['level'] == "persediaan") {
								if ($data['level'] != "persediaan") {
									continue;
								}
							}

						?>

							<tr>
								<td><?= $no++; ?></td>
								<td><?= $data['nik'] ?></td>
								<td><img src="img/<?= $data['foto'] ?>" width="50" height="50" alt="" class="rounded-circle"></td>
								<td><?= $data['nama']; ?> </td>
								<td><?= $data['telepon'] ?></td>
								<td><?= $data['username'] ?></td>
								<td><?= $data['password'] ?></td>
								<td><?= $data['level'] ?></td>
								<td>
									<!-- button group small -->
									<div class="btn-group btn-group-sm">
										<a href="?page=pengguna&aksi=ubahpengguna&id=<?= $data['id'] ?>" class="btn btn-success">Ubah</a>
										<a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="?page=pengguna&aksi=hapuspengguna&id=<?php echo $data['id'] ?>" class="btn btn-danger">Hapus</a>
									</div>
								</td>
							</tr>
						<?php } ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>

</div>