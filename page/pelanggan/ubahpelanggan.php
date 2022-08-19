<?php
$kode_pelanggan = $_GET['kode_pelanggan'];
$sql = $koneksi->query("select * from tb_pelanggan where kode_pelanggan = '$kode_pelanggan'");
$data = $sql->fetch_assoc();

?>

<div class="container-fluid">

	<!-- DataTales Example -->
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Ubah Data Pelanggan</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<div class="body">
					<form method="POST" enctype="multipart/form-data">
						<label for="">Kode Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="kode_pelanggan" value="<?= $data['kode_pelanggan']; ?>" class="form-control" readonly />
							</div>
						</div>

						<label for="">Nama Supplier</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="nama_pelanggan" value="<?= $data['nama_pelanggan']; ?>" class="form-control" />
							</div>
						</div>

						<label for="">Alamat</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="alamat" value="<?= $data['alamat']; ?>" class="form-control" />
							</div>
						</div>

						<label for="">Telepon</label>
						<div class="form-group">
							<div class="form-line">
								<input type="number" name="telepon" value="<?= $data['telpon']; ?>" class="form-control" />
							</div>
						</div>

						<input type="submit" name="simpan" value="simpan" class="btn btn-primary">
					</form>

					<?php

					if (isset($_POST['simpan'])) {

						$kode_pelanggan = $_POST['kode_pelanggan'];
						$nama_pelanggan = $_POST['nama_pelanggan'];
						$alamat = $_POST['alamat'];
						$telepon = $_POST['telepon'];

						$query = "update tb_pelanggan set nama_pelanggan = '$nama_pelanggan', alamat = '$alamat', telpon = '$telepon' where kode_pelanggan = '$kode_pelanggan'";
						$sql = $koneksi->query($query);
						if ($sql) {
					?>

							<script type="text/javascript">
								alert("Data Berhasil Diubah");
								window.location.href = "?page=pelanggan";
							</script>

					<?php
						}
					}



					?>