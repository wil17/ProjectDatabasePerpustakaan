<?php
include 'conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['kode_eksemplar'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare("SELECT * FROM buku WHERE kode_eksemplar = ?");
    $stmt->execute([$_GET['kode_eksemplar']]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$book) {
        exit('Tidak dapat lanjut');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM buku WHERE kode_eksemplar = ?');
            $stmt->execute([$_GET['kode_eksemplar']]);
            $msg = 'Anda berhasil menghapus data buku!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: book.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Hapus data buku dengan judul <?=$book['judul']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Anda yakin menghapus data buku dengan judul <?=$book['judul']?>?</p>
    <div class="yesno">
        <a href="buku_hapus.php?kode_eksemplar=<?=$book['kode_eksemplar']?>&confirm=yes">Yes</a>
        <a href="buku_hapus.php?kode_eksemplar=<?=$book['kode_eksemplar']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>