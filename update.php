<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if the contact id exists, for example update.php?id=1 will get the contact with the id of 1
if (isset($_GET['nim'])) {
    if (!empty($_POST)) {
        // This part is similar to the create.php, but instead we update a record and not insert
        $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
        $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
        $program_studi = isset($_POST['program_studi']) ? $_POST['program_studi'] : '';
        
        // Update the record
        $stmt = $pdo->prepare('UPDATE mahasiswa SET nim = ?, nama = ?, email = ?, fakultas = ?, program_studi = ? WHERE nim = ?');
        $stmt->execute([$nim, $nama, $email, $fakultas, $program_studi, $_GET['nim']]);
        $msg = 'Update data mahasiswa berhasil!';
    }
    // Get the contact from the contacts table
    $stmt = $pdo->prepare('SELECT * FROM mahasiswa WHERE nim = ?');
    $stmt->execute([$_GET['nim']]);
    $mhs = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$mhs) {
        exit('Contact doesn\'t exist with that NIM!');
    }
} else {
    exit('No NIM specified!');
}
?>



<?=template_header('Read')?>

<div class="content update">
	<h2>Update data mahasiswa dengan nim <?=$mhs['nim']?></h2>
    <form action="update.php?nim=<?=$mhs['nim']?>" method="post">
        <label for="nim">NIM</label>
        <label for="nama">Nama</label>
        <input type="number" name="nim" value="<?=$mhs['nim']?>" id="nim">
        <input type="text" name="nama" value="<?=$mhs['nama']?>" id="nama">
        <label for="email">Email</label>
        <label for="fakultas">Fakultas</label>
        <input type="text" name="email" value="<?=$mhs['email']?>" id="email">
        <input type="text" name="fakultas" value="<?=$mhs['fakultas']?>" id="fakultas">
        <label for="program_studi">Program Studi</label>
        <input type="text" name="program_studi" value="<?=$mhs['program_studi']?>" id="program_studi">
        <input type="submit" value="Update">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>