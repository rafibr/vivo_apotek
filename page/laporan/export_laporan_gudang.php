 <?php
	include '../../helper/helper.php';

	$koneksi = new mysqli("localhost", "root", "", "apotek2");
	$kode_barang = $_GET['kode_barang'];
	$bulan = $_GET['bulan'];
	$tahun = $_GET['tahun'];
	$jenis = $_GET['jenis'];


	$query = "SELECT * FROM gudang WHERE kode_barang = '$kode_barang'";
	$result = mysqli_query($koneksi, $query);
	// get all data
	$row = mysqli_fetch_assoc($result);
	// get one data
	$kode_barang = $row['kode_barang'];
	$nama_barang = $row['nama_barang'];
	$harga_jual = $row['harga_jual'];
	$jumlah = $row['stok_awal'];

	if ($jenis == 'xls') {
		header("Content-type: application/vnd-ms-excel");
		header("Content-Disposition: attachment; filename=kartu-persediaan.xls");
	} elseif ($jenis == 'pdf') {
	?>
 	<script>
 		window.onload = function() {
 			window.print();
 		}
 	</script>
 <?php } ?>

 <table border="1">
 	<tr>
 		<td colspan="10" style="text-align: center;">
 			<h2>
 				Kartu Persediaan
 			</h2>
 		</td>
 	</tr>
 	<tr>
 		<td colspan="5">
 			Apotek Namira Banjarmasin
 		</td>
 		<td colspan="5" align="right">
 			Rumus Biaya : (Rata-Rata Bergerak) <i>Perpetual</i>
 		</td>
 	</tr>
 	<tr>
 		<td colspan="5">
 		</td>
 		<td colspan="5" align="right">
 			Nama Obat : <?= $nama_barang ?>
 		</td>
 	</tr>
 	<tr>
 		<td rowspan="2">
 			Tanggal
 		</td>
 		<td colspan="3" align="center">
 			Masuk
 		</td>
 		<td colspan="3" align="center">
 			Keluar
 		</td>
 		<td colspan="3" align="center">
 			Saldo
 		</td>
 	</tr>
 	<tr>
 		<td>
 			Unit
 		</td>
 		<td>
 			Harga Satuan (Rp)
 		</td>
 		<td>
 			Jumlah Biaya (Rp)
 		</td>
 		<td>
 			Unit
 		</td>
 		<td>
 			Harga Satuan (Rp)
 		</td>
 		<td>
 			Jumlah Biaya (Rp)
 		</td>
 		<td>
 			Unit
 		</td>
 		<td>
 			Harga Satuan (Rp)
 		</td>
 		<td>
 			Jumlah Biaya (Rp)
 		</td>
 	</tr>
 	<?php
		$saldo_harga = 0;
		$saldo_total = 0;
		?>
 	<tr>
 		<td>
 		</td>
 		<td>
 		</td>
 		<td>
 		</td>
 		<td>
 		</td>
 		<td>
 		</td>
 		<td>
 		</td>
 		<td>
 		</td>
 		<td>
 			<?= $jumlah ?>
 		</td>
 		<td>
 			<?= rupiah($harga_jual) ?>
 		</td>
 		<td>
 			<?= rupiah($jumlah * $harga_jual) ?>
 			<?php $saldo_total = ($jumlah * $harga_jual) ?>
 		</td>
 	</tr>

 	<?php
		// get from barang_keluar union with barang_masuk 
		$query = "SELECT barang_masuk.id as id_persediaan,
		barang_masuk.kode_transaksi as kode_transaksi_persediaan,
		barang_masuk.nama_operator as nama_operator_persediaan,
		barang_masuk.tanggal as tanggal_persediaan,
		barang_masuk.kode_barang as kode_barang_persediaan,
		barang_masuk.nama_barang as nama_barang_persediaan,
		barang_masuk.kode_supplier as kode_tujuan_persediaan,
		barang_masuk.nama_supplier as nama_tujuan_persediaan,
		barang_masuk.jumlah as jumlah_persediaan,
		barang_masuk.jumlah_sisa as jumlah_sisa_persediaan,
		barang_masuk.harga_barang as harga_barang_persediaan,
		barang_masuk.sub_total as sub_total_persediaan,
		'masuk' as tipe_persediaan
	FROM barang_masuk
	UNION ALL
	SELECT barang_keluar.id as id_persediaan,
		barang_keluar.kode_transaksi as kode_transaksi_persediaan,
		barang_keluar.nama_operator as nama_operator_persediaan,
		barang_keluar.tanggal as tanggal_persediaan,
		barang_keluar.kode_barang as kode_barang_persediaan,
		barang_keluar.nama_barang as nama_barang_persediaan,
		barang_keluar.kode_pelanggan as kode_tujuan_persediaan,
		barang_keluar.tujuan as nama_tujuan_persediaan,
		barang_keluar.jumlah as jumlah_persediaan,
		barang_keluar.jumlah_sisa as jumlah_sisa_persediaan,
		barang_keluar.harga_barang as harga_barang_persediaan,
		barang_keluar.sub_total as sub_total_persediaan,
		'keluar' as tipe_persediaan
	FROM barang_keluar
	WHERE kode_barang = '$kode_barang'
		AND MONTH(tanggal) = '$bulan'
		AND YEAR(tanggal) = '$tahun'
	ORDER BY tanggal_persediaan ASC";

		$sql = $koneksi->query($query);

		$total_unit = 0;
		$total_keluar = 0;
		$total_unit_akhir = 0;
		$total_saldo_akhir = 0;


		while ($data = $sql->fetch_assoc()) :
		?>

 		<tr>
 			<td>
 				<?= $data['tanggal_persediaan']; ?>
 				<?= $data['kode_transaksi_persediaan']  ?>
 			</td>

 			<!-- ------------------------------------------------------  -->
 			<?php if ($data['tipe_persediaan'] == 'masuk') : ?>
 				<td>
 					<?= $data['jumlah_persediaan'] ?>
 				</td>
 				<td>
 					<?= rupiah($data['harga_barang_persediaan']) ?>
 				</td>
 				<td>
 					<?= rupiah($data['sub_total_persediaan']) ?>
 				</td>

 				<!-- ------------------------------------------------------  -->

 				<td>

 				</td>
 				<td>

 				</td>
 				<td>

 				</td>

 			<?php else : ?>

 				<td>

 				</td>
 				<td>

 				</td>
 				<td>

 				</td>

 				<!-- ------------------------------------------------------  -->

 				<td>
 					<?= $data['jumlah_persediaan'] ?>
 					<?php $total_unit += $data['jumlah_persediaan']; ?>
 				</td>
 				<td>
 					<?= rupiah($data['harga_barang_persediaan']) ?>
 				</td>
 				<td>
 					<?= rupiah($data['sub_total_persediaan']) ?>
 					<?php $total_keluar += $data['sub_total_persediaan']; ?>
 				</td>

 			<?php endif ?>

 			<!-- ------------------------------------------------------  -->

 			<td>
 				<?php
					if ($data['tipe_persediaan'] == 'masuk') {
						$jumlah = $jumlah + $data['jumlah_persediaan'];
					} else {
						$jumlah = $jumlah - $data['jumlah_persediaan'];
					}

					echo $jumlah;
					$total_unit_akhir = $jumlah;
					?>
 			</td>
 			<td>
 				<?php
					if ($data['tipe_persediaan'] == 'masuk') {
						// echo $jumlah / ($saldo_total + $data['sub_total_persediaan']);
						echo rupiah(($saldo_total + $data['sub_total_persediaan']) / $jumlah);
						// echo rupiah($data['harga_barang_persediaan']);

					} else {
						// echo rupiah($harga_jual);
						echo rupiah($data['harga_barang_persediaan']);
						// $jumlah = $jumlah - $data['jumlah_persediaan'];
					}

					?>
 			</td>
 			<td>
 				<?php
					if ($data['tipe_persediaan'] == 'masuk') {
						echo rupiah($saldo_total + $data['sub_total_persediaan']);
						$saldo_total = $saldo_total + $data['sub_total_persediaan'];
					} else {
						echo rupiah($jumlah * $data['harga_barang_persediaan']);
						$saldo_total = $jumlah * $data['harga_barang_persediaan'];


						// $jumlah = $jumlah - $data['jumlah_persediaan'];
					}

					$total_saldo_akhir = $saldo_total;
					?>
 			</td>
 		</tr>


 	<?php
		endwhile;
		?>
 	<tr>
 		<td colspan="4">
 			<b>Total</b>
 		</td>
 		<td>
 			<b><?= $total_unit ?></b>
 		</td>
 		<td></td>
 		<td>
 			<b><?= rupiah($total_keluar) ?></b>
 		</td>
 		<td>
 			<b><?= ($total_unit_akhir) ?></b>
 		</td>
 		<td></td>
 		<td>
 			<b><?= rupiah($total_saldo_akhir) ?></b>
 		</td>
 	</tr>

 </table>

 <br>
 <br>

 <table border="1">
 	<tr>
 		<td></td>
 		<td>Unit</td>
 		<td>Total Harga</td>
 	</tr>
 	<tr>
 		<td>HPP</td>
 		<td><?= $total_unit ?></td>
 		<td><?= rupiah($total_keluar) ?></td>
 	</tr>
 	<tr>
 		<td>Persediaan Akhir</td>
 		<td><?= $total_unit_akhir ?></td>
 		<td><?= rupiah($total_saldo_akhir) ?></td>
 	</tr>
 </table>