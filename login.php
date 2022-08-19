<?php

session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
$koneksi = new mysqli("localhost", "root", "", "apotek2");


?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Sistem Apotek Namira</title>

	<!-- Bootstrap -->

	<link href="css/bootstrap.min.css" rel="stylesheet">
	<style>
		body {
			background: url(img/grey.jpg) no-repeat fixed;
			-webkit-background-size: 100% 100%;
			-moz-background-size: 100% 100%;
			-o-background-size: 100% 100%;
			background-size: 100% 100%;
		}

		.row {
			margin: 100px auto;
			width: 300px;
			text-align: center;
		}

		.login {
			background-color: #FFFFFF;
			padding: 20px;
			margin-top: 20px;
		}
	</style>
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>

	<div class="container">
		<div class="row">
			<div class="center">
				<div class="login">
					<form role="form" action="login.php" method="post">
						<h3> Sistem Apotek Namira</h3>
						<br>
						<div class="form-group">
							<input type="text" name="username" class="form-control" placeholder="Masukan Username" required autofocus />
						</div>
						<div class="form-group">
							<input type="password" name="password" class="form-control" placeholder="Masukan Password" required autofocus />
						</div>
						<div class="form-group">
							<button type="submit" name="login" class="btn btn-primary btn-block" value="login">Login</button>
						</div>
					</form>

				</div>

			</div>
		</div>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
</body>

</html>

<?php


// cek if button submit di klik
if (isset($_POST['login'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	// cek username dan password
	$sql = $koneksi->query("SELECT * FROM users WHERE username='$username' AND password='$password'");
	// jika ada hasilnya
	if ($sql->num_rows > 0) {


		// delete all session
		session_destroy();

		// buat session baru
		session_start();

		// ambil data dari database
		$data = $sql->fetch_assoc();

		$_SESSION['id'] = $data['id'];
		$_SESSION['nik'] = $data['nik'];
		$_SESSION['nama'] = $data['nama'];
		$_SESSION['alamat'] = $data['alamat'];
		$_SESSION['telepon'] = $data['telepon'];
		$_SESSION['username'] = $data['username'];
		$_SESSION['level'] = $data['level'];
		$_SESSION['foto'] = $data['foto'];


		// save data to session


		// redirect ke halaman index.php
		header("location:index.php");

		var_dump($_SESSION);
		
	} else {
		// jika tidak ada hasilnya alert bootstrap
		echo "<div class='alert alert-danger text-center'>Upss...!!! Login gagal. Silakan Coba Kembali</div>";
	}
}



?>