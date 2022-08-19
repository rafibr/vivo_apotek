<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "apotek2");

// check if user is already logged in
if (!isset($_SESSION['username'])) {
	// if user is not logged in, redirect to login page
	header("location:login.php");
}

include 'helper/helper.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Sistem Penjualan Obat</title>

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin-2.min.css" rel="stylesheet">
	<!-- Custom styles for this page -->
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

	<!-- select2 -->
	<link href="vendor/select2/css/select2.min.css" rel="stylesheet">
	<script src="vendor/select2/js/select2.min.js"></script>
</head>

<body id="page-top">

	<!-- Page Wrapper -->
	<div id="wrapper">

		<!-- Sidebar -->
		<!-- <ul class="navbar-nav bg-gradient-warning sidebar sidebar-dark accordion" id="accordionSidebar"> -->
		<ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #276938;">

			<!-- Sidebar - Brand -->
			<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-building"></i>
				</div>
				<div class="sidebar-brand-text mx-2">Apotek Namira</div>
			</a>

			<!-- Divider -->
			<hr class="sidebar-divider my-0">
			<?php

			$sql = $koneksi->query("select * from users where id='$_SESSION[id]'");
			$data = $sql->fetch_assoc();
			?>

			<!--sidebar start-->

			<li class="d-flex align-items-center justify-content-center">
				<a class="nav-link" href="index.php">
					<img src="img/<?= $_SESSION['foto'] ?>" class="rounded-circle" width="100px" height="100px">
				</a>

			</li>
			<li class="nav-item ">
				<a class="nav-link" href="index.php">
					<div class="d-flex align-items-center justify-content-center" class="name"> <?= $_SESSION['nama'] ?> </div>
					<div class="d-flex align-items-center justify-content-center" class="email"><strong> <?= $_SESSION['level'] ?> </strong></div>
				</a>
			</li>

			<!-- Nav Item - Dashboard -->
			<li class="nav-item active">
				<a class="nav-link" href="?page=home">
					<i class="fas fa-fw fa-home"></i>
					<span>Dashboard</span></a>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider">

			<!-- Heading -->
			<div class="sidebar-heading">
				Pilih Menu
			</div>

			<!-- Nav Item - Pages Collapse Menu -->
			<li class="nav-item active">
				<a class="nav-link" href="?page=pengguna">
					<i class="fas fa-fw fa-home"></i>
					<span>Data Pengguna</span></a>
			</li>
			<li class="nav-item active">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseData" aria-expanded="true" aria-controls="collapseData">
					<i class="fas fa-fw fa-folder"></i>
					<span>Data Master</span>
				</a>

				<div id="collapseData" class="collapse 
				<?php
				// if page one of this then 'active'
				// gudang
				// pelanggan
				// supplier
				// jenisbarang
				// satuanbarang
				if ($_GET['page'] == 'gudang' || $_GET['page'] == 'pelanggan' || $_GET['page'] == 'supplier' || $_GET['page'] == 'jenisbarang' || $_GET['page'] == 'satuanbarang') {
					echo 'show';
				}
				?>
				" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Menu:</h6>
						<!-- if($_SESSION['level'] == 'superadmin'){ -->
						<!-- <a class="collapse-item" href="?page=gudang">Gudang</a> -->
						<!-- } -->
						<a class="collapse-item <?= $_GET['page'] == 'gudang' ? 'active' : '' ?> " href="?page=gudang">Data Barang</a>
						<?php if ($_SESSION['level'] == 'superadmin' || $_SESSION['level'] == 'persediaan') { ?>
							<a class="collapse-item <?= $_GET['page'] == 'supplier' ? 'active' : '' ?>" href="?page=supplier">Data Supplier</a>
							<a class="collapse-item <?= $_GET['page'] == 'jenisbarang' ? 'active' : '' ?>" href="?page=jenisbarang">Jenis Barang</a>
						<?php } ?>
						<?php if ($_SESSION['level'] == 'superadmin' || $_SESSION['level'] == 'penjualan') { ?>
							<a class="collapse-item <?= $_GET['page'] == 'pelanggan' ? 'active' : '' ?>" href="?page=pelanggan">Data Pelanggan</a>
						<?php } ?>
					</div>
				</div>
			</li>

			<li class="nav-item active">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
					<i class="fas fa-fw fa-folder"></i>
					<span>Transaksi</span>
				</a>
				<div id="collapsePages" class="collapse
					<?php
					// if page one of this then 'active'
					// barangmasuk
					// barangkeluar
					if ($_GET['page'] == 'barangmasuk' || $_GET['page'] == 'barangkeluar') {
						echo 'show';
					}
					?>
				" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Menu:</h6>
						<?php if ($_SESSION['level'] == 'superadmin' || $_SESSION['level'] == 'persediaan') { ?>
							<a class="collapse-item <?= $_GET['page'] == 'barangmasuk' ? 'active' : '' ?> " href="?page=barangmasuk">Pembelian</a>
						<?php } ?>
						<?php if ($_SESSION['level'] == 'superadmin' || $_SESSION['level'] == 'penjualan') { ?>
							<a class="collapse-item <?= $_GET['page'] == 'barangkeluar' ? 'active' : '' ?> " href="?page=barangkeluar">Penjualan</a>
						<?php } ?>
					</div>
				</div>
			</li>

			<!-- Heading -->
			<div class="sidebar-heading">
				Laporan
			</div>
			<li class="nav-item active">
				<a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
					<i class="fas fa-fw fa-folder"></i>
					<span>Laporan</span>
				</a>
				<div id="collapseLaporan" class="collapse
					<?php
					// if page one of this then 'active'
					// laporan_gudang
					// laporan_barangkeluar
					// laporan_barangmasuk
					if ($_GET['page'] == 'laporan_gudang' || $_GET['page'] == 'laporan_barangkeluar' || $_GET['page'] == 'laporan_barangkeluar_jenis' || $_GET['page'] == 'laporan_barangmasuk' || $_GET['page'] == 'laporan_barangmasuk_jenis') {
						echo 'show';
					}
					?>
				" aria-labelledby="headingPages" data-parent="#accordionSidebar">
					<div class="bg-white py-2 collapse-inner rounded">
						<h6 class="collapse-header">Menu Laporan:</h6>
						<a class="collapse-item <?= $_GET['page'] == 'laporan_gudang' ? 'active' : '' ?>" href="?page=laporan_gudang">Kartu Persediaan</a>

						<hr>
						<a class="collapse-item <?= $_GET['page'] == 'laporan_barangkeluar' ? 'active' : '' ?>" href="?page=laporan_barangkeluar">Laporan Penjualan</a>
						<a class="collapse-item <?= $_GET['page'] == 'laporan_barangkeluar_jenis' ? 'active' : '' ?>" href="?page=laporan_barangkeluar_jenis">Laporan Penjualan Jenis</a>
						<hr>
						<a class="collapse-item <?= $_GET['page'] == 'laporan_barangmasuk' ? 'active' : '' ?>" href="?page=laporan_barangmasuk">Laporan Pembelian</a>
						<a class="collapse-item <?= $_GET['page'] == 'laporan_barangmasuk_jenis' ? 'active' : '' ?>" href="?page=laporan_barangmasuk_jenis">Laporan Pembelian Jenis</a>
					</div>
				</div>
			</li>

			<!-- Divider -->
			<hr class="sidebar-divider d-none d-md-block">

			<!-- Sidebar Toggler (Sidebar) -->
			<div class="text-center d-none d-md-inline">
				<button class="rounded-circle border-0" id="sidebarToggle"></button>
			</div>

		</ul>
		<!-- End of Sidebar -->

		<!-- Content Wrapper -->
		<div id="content-wrapper" class="d-flex flex-column">

			<!-- Main Content -->
			<div id="content">

				<!-- Topbar -->
				<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

					<!-- Sidebar Toggle (Topbar) -->
					<button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
						<i class="fa fa-bars"></i>
					</button>

					<!-- Topbar Navbar -->
					<ul class="navbar-nav ml-auto">

						<div class="topbar-divider d-none d-sm-block"></div>

						<!-- Nav Item - User Information -->
						<li class="nav-item dropdown no-arrow">
							<div class="top-menu">
								<ul class="nav pull-right top-menu">
									<li><a onclick="return confirm('Apakah anda yakin akan logout?')" class="btn btn-danger" class="logout" href="logout.php">Keluar</a></li>
								</ul>
							</div>

						</li>

					</ul>

				</nav>
				<!-- End of Topbar -->

				<!-- Begin Page Content -->
				<div class="container-fluid">

					<section class="content">
						<?php
						$page = "home";
						if (isset($_GET['page'])) {
							$page = $_GET['page'];
						}

						$aksi = "";
						if (isset($_GET['aksi'])) {
							$aksi = $_GET['aksi'];
						}

						if ($page == "pengguna") {
							if ($aksi == "") {
								include "page/pengguna/pengguna.php";
							}
							if ($aksi == "tambahpengguna") {
								include "page/pengguna/tambahpengguna.php";
							}
							if ($aksi == "ubahpengguna") {
								include "page/pengguna/ubahpengguna.php";
							}
							if ($aksi == "hapuspengguna") {
								include "page/pengguna/hapuspengguna.php";
							}
						}

						if ($page == "supplier") {
							if ($aksi == "") {
								include "page/supplier/supplier.php";
							}
							if ($aksi == "tambahsupplier") {
								include "page//supplier/tambahsupplier.php";
							}
							if ($aksi == "ubahsupplier") {
								include "page/supplier/ubahsupplier.php";
							}

							if ($aksi == "hapussupplier") {
								include "page/supplier/hapussupplier.php";
							}
						}

						if ($page == "pelanggan") {
							if ($aksi == "") {
								include "page/pelanggan/pelanggan.php";
							}
							if ($aksi == "tambahpelanggan") {
								include "page//pelanggan/tambahpelanggan.php";
							}
							if ($aksi == "ubahpelanggan") {
								include "page/pelanggan/ubahpelanggan.php";
							}

							if ($aksi == "hapuspelanggan") {
								include "page/pelanggan/hapuspelanggan.php";
							}
						}
						// jenisbarang
						if ($page == "jenisbarang") {
							if ($aksi == "") {
								include "page/jenisbarang/jenisbarang.php";
							}
							if ($aksi == "tambahjenisbarang") {
								include "page/jenisbarang/tambahjenisbarang.php";
							}
							if ($aksi == "ubahjenisbarang") {
								include "page/jenisbarang/ubahjenisbarang.php";
							}
							if ($aksi == "hapusjenisbarang") {
								include "page/jenisbarang/hapusjenisbarang.php";
							}
						}

						// satuanbarang
						// if ($page == "satuanbarang") {
						// 	if ($aksi == "") {
						// 		include "page/satuanbarang/satuan.php";
						// 	}
						// 	if ($aksi == "tambahsatuan") {
						// 		include "page/satuanbarang/tambahsatuan.php";
						// 	}
						// 	if ($aksi == "ubahsatuan") {
						// 		include "page/satuanbarang/ubahsatuan.php";
						// 	}
						// 	if ($aksi == "hapussatuan") {
						// 		include "page/satuanbarang/hapussatuan.php";
						// 	}
						// }

						if ($page == "barangmasuk") {
							if ($aksi == "") {
								include "page/barangmasuk/barangmasuk.php";
							}
							if ($aksi == "tambahbarangmasuk") {
								include "page/barangmasuk/tambahbarangmasuk.php";
							}
							if ($aksi == "ubahbarangmasuk") {
								include "page/barangmasuk/ubahbarangmasuk.php";
							}
							if ($aksi == "hapusbarangmasuk") {
								include "page/barangmasuk/hapusbarangmasuk.php";
							}
						}

						if ($page == "barangkeluar") {
							if ($aksi == "") {
								include "page/barangkeluar/barangkeluar.php";
							}
							if ($aksi == "tambahbarangkeluar") {
								include "page/barangkeluar/tambahbarangkeluar.php";
							}
							if ($aksi == "ubahbarangkeluar") {
								include "page/barangkeluar/ubahbarangkeluar.php";
							}

							if ($aksi == "hapusbarangkeluar") {
								include "page/barangkeluar/hapusbarangkeluar.php";
							}

							if ($aksi == "notabarangkeluar") {
								include "page/barangkeluar/notabarangkeluar.php";
							}
						}

						if ($page == "gudang") {
							if ($aksi == "") {
								include "page/gudang/gudang.php";
							}
							if ($aksi == "tambahgudang") {
								include "page/gudang/tambahgudang.php";
							}
							if ($aksi == "ubahgudang") {
								include "page/gudang/ubahgudang.php";
							}

							if ($aksi == "hapusgudang") {
								include "page/gudang/hapusgudang.php";
							}
						}

						if ($page == "laporan_supplier") {
							if ($aksi == "") {
								include "page/laporan/laporan_supplier.php";
							}
						}

						if ($page == "laporan_barangmasuk") {
							if ($aksi == "") {
								include "page/laporan/laporan_barangmasuk.php";
							}
						}

						if ($page == "laporan_barangmasuk_jenis") {
							if ($aksi == "") {
								include "page/laporan/laporan_barangmasuk_jenis.php";
							}
						}

						if ($page == "laporan_gudang") {
							if ($aksi == "") {
								include "page/laporan/laporan_gudang.php";
							}
						}

						if ($page == "laporan_barangkeluar") {
							if ($aksi == "") {
								include "page/laporan/laporan_barangkeluar.php";
							}
						}

						if ($page == "laporan_barangkeluar_jenis") {
							if ($aksi == "") {
								include "page/laporan/laporan_barangkeluar_jenis.php";
							}
						}

						if ($page == "") {
							include "home.php";
						}

						if ($page == "home") {
							include "home.php";
						}

						?>

					</section>

				</div>
				<!-- End of Main Content -->

			</div>
			<!-- End of Content Wrapper -->

		</div>
		<!-- End of Page Wrapper -->
	</div>

	<!-- Scroll to Top Button-->
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>

	<!-- Logout Modal-->
	<!-- Custom scripts for all pages-->
	<script src="js/sb-admin-2.min.js"></script>

	<!-- Page level plugins -->
	<script src="vendor/datatables/jquery.dataTables.min.js"></script>
	<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

	<!-- Page level custom scripts -->
	<script src="js/demo/datatables-demo.js"></script>

	<!--script for this page-->
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
				var tamp = $(this).val(); // Ciptakan variabel provinsi
				$.ajax({
					type: 'POST', // Metode pengiriman data menggunakan POST
					url: 'page/barangmasuk/get_barang.php', // File yang akan memproses data
					data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
					success: function(data) { // Jika berhasil
						$('.tampung').html(data); // Berikan hasil ke id kota
					}
				});
			});
		});

		jQuery(document).ready(function($) {
			$('#cmb_barang').change(function() { // Jika Select Box id provinsi dipilih
				var tamp = $(this).val(); // Ciptakan variabel provinsi
				$.ajax({
					type: 'POST', // Metode pengiriman data menggunakan POST
					url: 'page/barangmasuk/get_satuan.php', // File yang akan memproses data
					data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
					success: function(data) { // Jika berhasil
						$('.tampung1').html(data); // Berikan hasil ke id kota
					}
				});
			});
		});

		jQuery(document).ready(function($) {
			$(function() {
				$('#Myform1').submit(function() {
					$.ajax({
						type: 'POST',
						url: 'page/laporan/export_laporan_barangmasuk_excel.php',
						data: $(this).serialize(),
						success: function(data) {
							$(".tampung1").html(data);
							$('.table').DataTable();
						}
					});

					return false;
					e.preventDefault();
				});
			});
		});

		jQuery(document).ready(function($) {
			$(function() {
				$('#Myform2').submit(function() {
					$.ajax({
						type: 'POST',
						url: 'page/laporan/export_laporan_barangkeluar_excel.php',
						data: $(this).serialize(),
						success: function(data) {
							$(".tampung2").html(data);
							$('.table').DataTable();
						}
					});

					return false;
					e.preventDefault();
				});
			});
		});
	</script>
</body>

</html>