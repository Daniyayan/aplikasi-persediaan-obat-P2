<?php
session_start();

// Include database.php for database connection
require_once "../../config/database.php";

// Check the login status of the user
// If the user is not logged in, redirect to the login page with alert=1
if (empty($_SESSION['username']) && empty($_SESSION['password'])) {
    echo "<meta http-equiv='refresh' content='0; url=index.php?alert=1'>";
} else {
    if ($_GET['act'] == 'insert') {
        if (isset($_POST['simpan'])) {
            // Retrieve data from the submitted form
            $kode_transaksi = mysqli_real_escape_string($mysqli, trim($_POST['kode_transaksi']));

            $tanggal         = mysqli_real_escape_string($mysqli, trim($_POST['tanggal_keluar']));
            $exp             = explode('-', $tanggal);
            $tanggal_keluar  = $exp[2] . "-" . $exp[1] . "-" . $exp[0];

            $kode_obat       = mysqli_real_escape_string($mysqli, trim($_POST['kode_obat']));
            $jumlah_keluar   = mysqli_real_escape_string($mysqli, trim($_POST['jumlah_keluar']));
            $total_stok      = mysqli_real_escape_string($mysqli, trim($_POST['total_stok']));

            $created_user    = $_SESSION['id_user'];

            // Query to insert data into the outgoing medicine table
            $query = mysqli_query($mysqli, "INSERT INTO is_obat_keluar(kode_transaksi, tanggal_keluar, kode_obat, jumlah_keluar, created_user) 
                                            VALUES('$kode_transaksi', '$tanggal_keluar', '$kode_obat', '$jumlah_keluar', '$created_user')")
                or die('Error in the insert query: ' . mysqli_error($mysqli));

            // Check the query
            if ($query) {
                // Query to update data in the medicine table
                $query1 = mysqli_query($mysqli, "UPDATE is_obat SET stok = '$total_stok'
                                                  WHERE kode_obat = '$kode_obat'")
                    or die('Error in the update query: ' . mysqli_error($mysqli));

                // Check the update query
                if ($query1) {
                    // If successful, display a success message
                    header("location: ../../main.php?module=obat_keluar&alert=1");
                }
            }
        }
    }
}
?>
