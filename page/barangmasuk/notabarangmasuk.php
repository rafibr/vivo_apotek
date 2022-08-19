<?php
include '../../helper/helper.php';

$koneksi = new mysqli("localhost", "root", "", "apotek2");
// get last id
$kode_trMasuk = $_GET['kode_transaksi'];
$query = "select * from barang_masuk where kode_transaksi ='" . $kode_trMasuk . "'";
$result = mysqli_query($koneksi, $query);

// if data is not found, then redirect to index.php?page=barangmasuk
if (mysqli_num_rows($result) < 1) {
?>
	<script>
		alert("Data tidak ditemukan");
		window.location.href = "index.php?page=barangmasuk";
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
<center>
<div class="container-fluid">
	<table>
		<tr>
			<td>
				<h4>Nota Pembelian: <?= $_GET['kode_transaksi'] ?></h4>
			</td>
			<td>
				<h4><b> ------ </b></h4>
			</td>
			<td>
				<h4>Tanggal: <?= $tanggal_now ?></h4>
			</td>
		</tr>
	</table>


	<!-- table barang masuk tambah dengan modal javascript -->
	<div class="row">
		<div class="col-md-12">
			<div class="card shadow mb-4">

				<div class="card-body">
					<div class="table-responsive">
						<table border="1" width="100%">
							<thead>
								<tr>
									<th>No</th>
									<th>Kode Barang</th>
									<th>Nama Barang</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Subtotal</th>
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
									</tr>

								<?php
								}
								?>

								<!-- tr for total -->
								<tr class="font-weight-bold">
									<td colspan="3" align="right">
										<h5>Total: </h5>
									</td>
									<td></td>
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


</div>
</center>


<!-- print this page to pdf if page already loaded -->
<script>
	window.onload = function() {
		window.print();
	}
</script>