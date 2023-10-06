<?php
include 'conn.php';
$pdo = pdo_connect_mysql();
$msg = ' ';
if (isset($_GET['kode_eksemplar'])) {
    if (!empty($_POST)) {
    $kode_eksemplar = isset($_POST['kode_eksemplar']) ? $_POST['kode_eksemplar'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $pengarang = isset($_POST['pengarang']) ? $_POST['pengarang'] : '';
    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
    $no_rak = isset($_POST['no_rak']) ? $_POST['no_rak'] : '';

    // Update the record
    $stmt = $pdo->prepare('UPDATE buku SET kode_eksemplar = ?, judul = ?, penerbit = ?, kategori = ?, pengarang = ?, tahun = ?, no_rak = ? WHERE kode_eksemplar = ?');
    $stmt->execute([$kode_eksemplar, $judul, $penerbit, $kategori, $pengarang, $tahun, $no_rak, $_GET['kode_eksemplar']]);
    $msg = 'Update data buku berhasil!';
}
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM buku WHERE kode_eksemplar = ?');
    $stmt->execute([$_GET['kode_eksemplar']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        exit('Contact doesn\'t exist with that kode_eksemplar!');
    }
} else {
    exit('Kode eksemplar tidak terspesifikasi!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update data buku dengan judul <?=$book['judul']?></h2>
    <form action="buku_update.php?kode_eksemplar=<?=$book['kode_eksemplar']?>" method="post">
        <label for="kode_eksemplar">Kode Eksemplar</label>
        <label for="nama">Judul</label>
        <input type="number" name="kode_eksemplar" value="<?=$book['kode_eksemplar']?>" id="kode_eksemplar">
        <input type="text" name="judul" value="<?=$book['judul']?>" id="judul">
        <label for="penerbit">Penerbit</label>
        <label for="kategori">Kategori</label>
        <input type="text" name="penerbit" value="<?=$book['penerbit']?>" id="penerbit">
        <input type="text" name="kategori" value="<?=$book['kategori']?>" id="kategori">
        <label for="pengarang">Pengarang</label>
        <label for="tahun">Tahun</label>
        <input type="text" name="pengarang" value="<?=$book['pengarang']?>" id="pengarang">
        <input type="number" name="tahun" value="<?=$book['tahun']?>" id="tahun">
        <label for="no_rak">No rak</label>
        <input type="number" name="no_rak" value="<?=$book['no_rak']?>" id="no_rak">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>