<?php
include 'conn.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['id_pinjam'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare("SELECT * FROM peminjaman WHERE id_pinjam = ?");
    $stmt->execute([$_GET['id_pinjam']]);
    $pinjamm = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$pinjamm) {
        exit('Tidak dapat lanjut');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM peminjaman WHERE id_pinjam = ?');
            $stmt->execute([$_GET['id_pinjam']]);
            $msg = 'Anda berhasil menghapus data peminjaman!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: pengembalian.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Selesaikan transaksi peminjaman dengan id pinjam <?=$pinjamm['id_pinjam']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Anda yakin ingin menyelesaikan transaksi peminjaman dengan mahasiswa NIM <?=$pinjamm['nim']?>?</p>
    <div class="yesno">
        <a href="pengembalian_hapus.php?id_pinjam=<?=$pinjamm['id_pinjam']?>&confirm=yes">Yes</a>
        <a href="pengembalian_hapus.php?id_pinjam=<?=$pinjamm['id_pinjam']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>