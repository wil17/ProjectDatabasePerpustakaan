<?php
include 'conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    // $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $id_pinjam= isset($_POST['id_pinjam']) ? $_POST['id_pinjam'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $id_detail = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $tgl_pinjam = isset($_POST['tgl_pinjam']) ? $_POST['tgl_pinjam'] : '';
    $tgl_kembali = isset($_POST['tgl_kembali']) ? $_POST['tgl_kembali'] : '';
    $id_petugas = isset($_POST['id_petugas']) ? $_POST['id_petugas'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO peminjaman VALUES (?, ?, ?, ?, ?, ?)');
    $stmt->execute([$id_pinjam, $id_detail, $nim, $tgl_pinjam, $tgl_kembali, $id_petugas]);
    // Output message
    $msg = 'Data peminjaman sukses dibuat!';
}
?>


<?=template_header('Transaksi Peminjaman')?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Peminjaman</title>
</head>
<body>
<div class="content update">
<form action="pinjam.php" method="post">
      <table border="0" align="center">
        <tr>
          <td>Id Pinjam</td>
          <td>:</td>
          <td><input type="number" name="id_pinjam" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Nama</td>
          <td>:</td>
          <td><input type="text" name="nama" autocomplete="off"></td>
        </tr>
        <tr>
          <td>NIM</td>
          <td>:</td>
          <td><input type="number" name="nim" autocomplete="off"></td>
        </tr>
        <tr>
          <td>Tgl Pinjam</td>
          <td>:</td>
          <td><input type="date" name="tgl_pinjam"></td>
        </tr>
        <tr>
          <td>Tgl Kembali</td>
          <td>:</td>
          <td><input type="date" name="tgl_kembali"></td>
        </tr>
        <tr>
          <td>Id Petugas</td>
          <td>:</td>
          <td><input type="number" name="id_petugas" autocomplete="off"></td>
        </tr>
        <tr>
          <td></td>
          <td></td>
          <td>
            <button type="submit" name="proses" class="btn btn-primary">Buat</button>
          </td>
        </tr>
    </table>
      </form>
</div>
      <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>

    <?=template_footer()?>
</body>
</html>