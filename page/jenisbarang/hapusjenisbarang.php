 <?php

	$id_barang = $_GET['id'];
	$sql = $koneksi->query("delete from jenis_barang where id = '$id_barang'");

	if ($sql) {

	?>



 	<script type="text/javascript">
 		alert("Data Berhasil Dihapus");
 		window.location.href = "?page=jenisbarang";
 	</script>

 <?php

	}

	?>