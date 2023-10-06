<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check that the contact ID exists
if (isset($_GET['nim'])) {
    // Select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM mahasiswa WHERE nim = ?');
    $stmt->execute([$_GET['nim']]);
    $mhs = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$mhs) {
        exit('Contact doesn\'t exist with that NIM!');
    }
    // Make sure the user confirms beore deletion
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // User clicked the "Yes" button, delete record
            $stmt = $pdo->prepare('DELETE FROM mahasiswa WHERE nim = ?');
            $stmt->execute([$_GET['nim']]);
            $msg = 'You have deleted the mahasiswa!';
        } else {
            // User clicked the "No" button, redirect them back to the read page
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('No ID specified!');
}
?>


<?=template_header('Delete')?>

<div class="content delete">
	<h2>Delete Contact #<?=$mhs['nim']?></h2>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php else: ?>
	<p>Are you sure you want to delete contact #<?=$mhs['nim']?>?</p>
    <div class="yesno">
        <a href="delete.php?nim=<?=$mhs['nim']?>&confirm=yes">Yes</a>
        <a href="delete.php?nim=<?=$mhs['nim']?>&confirm=no">No</a>
    </div>
    <?php endif; ?>
</div>

<?=template_footer()?>