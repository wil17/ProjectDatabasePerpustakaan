<?php
include 'conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
if (isset($_GET['id_pinjam'])) {
    if (!empty($_POST)) {
    $id_pinjam = isset($_POST['id_pinjam']) ? $_POST['id_pinjam'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    $tgl_pinjam = isset($_POST['tgl_pinjam']) ? $_POST['tgl_pinjam'] : '';
    $tgl_kembali = isset($_POST['tgl_kembali']) ? $_POST['tgl_kembali'] : '';
    $id_petugas = isset($_POST['id_petugas']) ? $_POST['id_petugas'] : '';

    // Update the record
    $stmt = $pdo->prepare('UPDATE peminjaman SET id_pinjam = ?, nama = ?, nim = ?, tgl_pinjam = ?, tgl_kembali = ?, id_petugas = ? WHERE id_pinjam = ?');
    $stmt->execute([$id_pinjam, $nama, $nim, $tgl_pinjam, $tgl_kembali, $id_petugas, $_GET['id_pinjam']]);
    $msg = 'Update data peminjaman berhasil!';
}
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM peminjaman WHERE id_pinjam = ?');
    $stmt->execute([$_GET['id_pinjam']]);
    $pinjamm = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pinjamm) {
        exit('Contact doesn\'t exist with that kode_eksemplar!');
    }
} else {
    exit('Kode eksemplar tidak terspesifikasi!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update data peminjaman dengan id_pinjam <?=$pinjamm['id_pinjam']?></h2>
    <form action="peminjaman_update.php?id_pinjam=<?=$pinjamm['id_pinjam']?>" method="post">
        <label for="id_pinjam">Id Pinjam</label>
        <label for="nama">Nama</label>
        <input type="number" name="id_pinjam" value="<?=$pinjamm['id_pinjam']?>" id="id_pinjam">
        <input type="text" name="nama" value="<?=$pinjamm['nama']?>" id="nama">
        <label for="nim">NIM</label>
        <label for="tgl_pinjam">Tanggal Pinjam</label>
        <input type="number" name="nim" value="<?=$pinjamm['nim']?>" id="nim">
        <input type="text" name="tgl_pinjam" value="<?=$pinjamm['tgl_pinjam']?>" id="tgl_pinjam">
        <label for="tgl_kembali">Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" value="<?=$pinjamm['tgl_kembali']?>" id="tgl_kembali">
        <label for="id_petugas">Id Petugas</label>
        <input type="number" name="id_petugas" value="<?=$pinjamm['id_petugas']?>" id="id_petugas">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>