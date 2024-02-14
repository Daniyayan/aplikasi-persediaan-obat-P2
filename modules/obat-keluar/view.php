<section class="content-header">
  <h1>
    <i class="fa fa-sign-out icon-title"></i> Data Obat Keluar

    <?php if ($_SESSION['hak_akses'] !== 'Super Admin') : ?>
    <a class="btn btn-primary btn-social pull-right" href="?module=form_obat_keluar&form=add" title="Tambah Data" data-toggle="tooltip">
        <i class="fa fa-plus"></i> Tambah
    </a>
<?php endif; ?>
</section>

<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">

    <?php  
    // fungsi untuk menampilkan pesan
    // ...

      echo "<div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4>  <i class='icon fa fa-check-circle'></i> Sukses!</h4>
              Data Obat Keluar berhasil disimpan.
            </div>";
    ?>

      <div class="box box-primary">
        <div class="box-body">
          <!-- tampilan tabel Obat Keluar -->
          <table id="dataTables1" class="table table-bordered table-striped table-hover">
            <!-- tampilan tabel header -->
            <thead>
              <tr>
                <th class="center">No.</th>
                <th class="center">Kode Transaksi</th>
                <th class="center">Tanggal</th>
                <th class="center">Kode Obat</th>
                <th class="center">Nama Obat</th>
                <th class="center">Jumlah Keluar</th>
                <th class="center">Satuan</th>
              </tr>
            </thead>
            <!-- tampilan tabel body -->
            <tbody>
            <?php  
            $no = 1;
            // fungsi query untuk menampilkan data dari tabel obat keluar
            $query = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_keluar,a.kode_obat,a.jumlah_keluar,b.kode_obat,b.nama_obat,b.satuan
                                            FROM is_obat_keluar as a INNER JOIN is_obat as b ON a.kode_obat=b.kode_obat ORDER BY kode_transaksi DESC")
                                            or die('Ada kesalahan pada query tampil Data Obat Keluar: '.mysqli_error($mysqli));

            // tampilkan data
            while ($data = mysqli_fetch_assoc($query)) { 
              $tanggal         = $data['tanggal_keluar'];
              $exp             = explode('-',$tanggal);
              $tanggal_keluar  = $exp[2]."-".$exp[1]."-".$exp[0];

              // menampilkan isi tabel dari database ke tabel di aplikasi
              echo "<tr>
                      <td width='30' class='center'>$no</td>
                      <td width='100' class='center'>$data[kode_transaksi]</td>
                      <td width='80' class='center'>$tanggal_keluar</td>
                      <td width='80' class='center'>$data[kode_obat]</td>
                      <td width='200'>$data[nama_obat]</td>
                      <td width='100' align='right'>$data[jumlah_keluar]</td>
                      <td width='80' class='center'>$data[satuan]</td>
                    </tr>";
              $no++;
            }
            ?>
            </tbody>
          </table>
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </div><!--/.col -->
  </div>   <!-- /.row -->
</section><!-- /.content -->