<?php
session_start();

// Include database.php for database connection
require_once "../../config/database.php";

if(isset($_POST['dataidobat'])) {
    $kode_obat = $_POST['dataidobat'];

    // Query to retrieve data from the medicine table
    $query = mysqli_query($mysqli, "SELECT kode_obat, nama_obat, satuan, stok FROM is_obat WHERE kode_obat='$kode_obat'")
        or die('Error in the query to fetch medicine data: '.mysqli_error($mysqli));

    // Fetch the data
    $data = mysqli_fetch_assoc($query);

    $stok   = $data['stok'];
    $satuan = $data['satuan'];

    if($stok != '') {
        echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='$stok' readonly>
                    <span class='input-group-addon'>$satuan</span>
                  </div>
                </div>
              </div>";
    } else {
        echo "<div class='form-group'>
                <label class='col-sm-2 control-label'>Stok</label>
                <div class='col-sm-5'>
                  <div class='input-group'>
                    <input type='text' class='form-control' id='stok' name='stok' value='Stok obat tidak ditemukan' readonly>
                    <span class='input-group-addon'>Satuan obat tidak ditemukan</span>
                  </div>
                </div>
              </div>";
    }		
}
?>
