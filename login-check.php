
<?php
// panggil file untuk koneksi ke database
require_once "config/database.php";
// ambil data hasil submit dari form
$username = mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['username'])))));
$password = md5(mysqli_real_escape_string($mysqli, stripslashes(strip_tags(htmlspecialchars(trim($_POST['password']))))));
var_dump($username);

// pastikan username dan password adalah berupa huruf atau angka.
if (!ctype_alnum($username) OR !ctype_alnum($password)) {
	header("Location: index.php?alert=1");
}
else {
	// ambil data dari tabel user untuk pengecekan berdasarkan inputan username dan passrword
	$query = mysqli_query($mysqli, "SELECT * FROM is_users WHERE username='$username' AND password='$password'")

									or die('Ada kesalahan pada query user: '.mysqli_error($mysqli));
	//print_r($password) ;
	//print_r($username) ;
	//die;

	$rows  = mysqli_num_rows($query);

	// jika data ada, jalankan perintah untuk membuat session
	if ($rows > 0) {
		$data  = mysqli_fetch_assoc($query);

		session_start();
		
		$_SESSION['username']  = $data['username'];
		$_SESSION['password']  = $data['password'];
		$_SESSION['id_user']  = $data['id_user'];
		$_SESSION['hak_akses']  = $data['hak_akses'];
		$_SESSION['']  = $data[''];

		
	
		
		// lalu alihkan ke halaman user
		header("Location: main.php?module=beranda");
	}

	// jika data tidak ada, alihkan ke halaman login dan tampilkan pesan = 1
	else {
		header("Location: index.php?alert=1");
	}
}
?>