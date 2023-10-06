<?php
include 'conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    // $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $kode_eksemplar = isset($_POST['kode_eksemplar']) ? $_POST['kode_eksemplar'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $judul = isset($_POST['judul']) ? $_POST['judul'] : '';
    $penerbit = isset($_POST['penerbit']) ? $_POST['penerbit'] : '';
    $kategori = isset($_POST['kategori']) ? $_POST['kategori'] : '';
    $pengarang = isset($_POST['pengarang']) ? $_POST['pengarang'] : '';
    $tahun = isset($_POST['tahun']) ? $_POST['tahun'] : '';
    $no_rak = isset($_POST['no_rak']) ? $_POST['no_rak'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO buku VALUES (?, ?, ?, ?, ?, ?, ?)');
    $stmt->execute([$kode_eksemplar, $judul, $penerbit, $kategori, $pengarang, $tahun, $no_rak]);
    // Output message
    $msg = 'Data buku baru sukses dibuat!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Buat Data Baru</h2>
    <form action="buku_baru.php" method="post">
        <label for="kode_eksemplar">Kode Eksemplar</label>
        <label for="judul">Judul</label>
        <input type="number" name="kode_eksemplar" id="kode_eksemplar">
        <input type="text" name="judul" id="judul">
        <label for="penerbit">Penerbit</label>
        <label for="kategori">Kategori</label>
        <input type="text" name="penerbit" id="penerbit">
        <input type="text" name="kategori" id="kategori">
        <label for="pengarang">Pengarang</label>
        <input type="text" name="pengarang" id="pengarang">
        <label for="tahun">Tahun</label>
        <input type="number" name="tahun" id="tahun">
        <label for="no_rak">No rak</label>
        <input type="number" name="no_rak" id="no_rak">
        <input type="submit" value="Buat">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>