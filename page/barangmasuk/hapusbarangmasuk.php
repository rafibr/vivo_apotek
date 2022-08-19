 <?php

	$kode_transaksi = $_GET['kode_transaksi'];
	$sql = $koneksi->query("delete from barang_masuk where kode_transaksi = '$kode_transaksi'");

	//  also delete from log_transaksi
	$sql = $koneksi->query("delete from log_transaksi where kode_transaksi = '$kode_transaksi'");

	if ($sql) {

	?>
 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=barangmasuk";
 	</script>

 <?php

	}


	?>