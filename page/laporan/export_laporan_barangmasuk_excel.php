<?php
include '../../helper/helper.php';
// http://localhost/apotek/page/laporan/export_laporan_barangkeluar_excel.php?bulan=3&tahun=2022&bulan2=7&tahun2=2022

$bulan = $_GET['bulan'] == '' ? date('m') : $_GET['bulan'];
$tahun = $_GET['tahun'] == '' ? date('Y') : $_GET['tahun'];
$bulan2 = $_GET['bulan2'] == '' ? date('m') : $_GET['bulan2'];
$tahun2 = $_GET['tahun2'] == '' ? date('Y') : $_GET['tahun2'];
$type = $_GET['type'] == '' ? 'xls' : $_GET['type'];

// get data from database
$query = "SELECT * FROM barang_masuk join gudang on barang_masuk.kode_barang=gudang.kode_barang join tb_supplier on barang_masuk.kode_supplier=tb_supplier.kode_supplier WHERE MONTH(tanggal) BETWEEN '$bulan' AND '$bulan2' AND YEAR(tanggal) BETWEEN '$tahun' AND '$tahun2'";

$koneksi = new mysqli("localhost", "root", "", "apotek2");

if ($type == 'xls') {
	header("Content-type: application/vnd-ms-excel");
	header("Content-Disposition: attachment; filename=Laporan_Barang_Masuk (" . date('d-m-Y') . ").xls");
} else {
?>
	<!-- print this page to pdf if page already loaded -->
	<script>
		window.onload = function() {
			window.print();
		}
	</script>
<?php
}

?>


<div class="row">
	<h2>Laporan Barang Masuk</h2>
</div>

<div class="row">
	<!-- Header Periode : Februari 2018 - Desember 2018 -->
	<div class="col-md-12">
		<h4>Periode : <?= bulan_indonesia($bulan) . " " . $tahun . " - " . bulan_indonesia($bulan2) . " " . $tahun2; ?></h4>
	</div>
</div>

<table border="1">
	<!-- No	Id Transaksi	Tanggal Keluar	Kode Barang	Nama Barang	Jumlah Keluar	Tujuan -->
	<tr>
		<th>No</th>
		<th>Kode Transaksi</th>
		<th>Tanggal Masuk</th>
		<th>Kode Barang</th>
		<th>Nama Barang</th>
		<th>Supplier</th>
		<th>Harga Beli</th>
		<th>Jumlah Masuk</th>
		<th>Total Harga</th>
	</tr>
	<?php
	$no = 1;
	$total_jumlah = 0;
	$total_harga = 0;
	$sql = $koneksi->query($query);
	while ($data = $sql->fetch_assoc()) {
		$total_jumlah += $data['jumlah'];
		$total_harga += $data['sub_total'];
	?>
		<tr>
			<td><?= $no++; ?></td>
			<td><?= $data['kode_transaksi'] ?></td>
			<td><?= date_format_indo($data['tanggal']) ?></td>
			<td><?= $data['kode_barang'] ?></td>
			<td><?= $data['nama_barang'] ?></td>
			<td><?= $data['nama_supplier'] ?></td>
			<td align="right"> <?= rupiah($data['harga_beli']) ?></td>
			<td align="right"><?= $data['jumlah'] ?></td>
			<td align="right"><?= rupiah($data['sub_total']) ?></td>
		</tr>
	<?php
	}
	?>
	<tr>
		<td colspan="7" align="right">Total</td>
		<td align="right"><b><?= ($total_jumlah) ?></b></td>
		<td align="right"><b><?= rupiah($total_harga) ?></b></td>
	</tr>
</table>