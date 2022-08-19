<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

	</div>
	<h2>Selamat Datang di Sistem Informasi Penjualan Barang</h2>
	<br></br>

	<!-- Content Row -->
	<div class="row">

		<!-- Data Users -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-primary shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<a href="?page=pengguna">
								<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
									<i class="fas fa-user"></i> Data Users
								</div>
								<?php
								$sql = "SELECT * FROM users";
								$query = mysqli_query($koneksi, $sql);
								$total = mysqli_num_rows($query);

								echo "<h4>$total Users</h4>";
								?>

						</div>
						<div class="col-auto">
							<i class="fas fa-calendar fa-2x text-black-300"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Data Jumlah stok obat -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<a href="?page=gudang">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<i class="fas fa-user"></i> Data Gudang
								</div>
								<?php
								$sql = "SELECT * FROM gudang";
								$query = mysqli_query($koneksi, $sql);
								$total = mysqli_num_rows($query);

								echo "<h4 class='text-info'>$total Barang</h4>";
								?>

						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-black-300 fa-2x text-info"></i>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Pembelian Obat -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-info shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<a href="?page=barangmasuk">
								<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
									<i class="fas fa-user"></i> Data Gudang
								</div>
								<?php
								$sql = "SELECT * FROM barang_masuk";
								$query = mysqli_query($koneksi, $sql);
								$total = mysqli_num_rows($query);

								echo "<h4 class='text-info'>$total Barang</h4>";
								?>

						</div>
						<div class="col-auto">
							<i class="fas fa-clipboard-list fa-2x text-black-300 fa-2x text-info"></i>
						</div>
					</div>
				</div>
			</div>
		</div>


		<!-- Penjualan -->
		<div class="col-xl-3 col-md-6 mb-4">
			<div class="card border-left-warning shadow h-100 py-2">
				<div class="card-body">
					<div class="row no-gutters align-items-center">
						<div class="col mr-2">
							<a href="?page=barangkeluar">
								<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
									<i class="fas fa-user"></i> Barang Keluar
								</div>

								<?php
								$sql = "SELECT * FROM barang_keluar";
								$query = mysqli_query($koneksi, $sql);
								$total = mysqli_num_rows($query);

								echo "<h4 class='text-warning'>$total Barang</h4>";
								?>

						</div>
						<div class="col-auto">
							<i class="fas fa-comments fa-2x text-black-300 fa-2x text-warning"></i>
						</div>
					</div>
				</div>
			</div>
		</div>






	</div>