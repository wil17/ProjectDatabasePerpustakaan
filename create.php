<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';
// Check if POST data is not empty
if (!empty($_POST)) {
    // Post data not empty insert a new record
    // Set-up the variables that are going to be inserted, we must check if the POST variables exist if not we can default them to blank
    // $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
    $nim = isset($_POST['nim']) ? $_POST['nim'] : '';
    // Check if POST variable "name" exists, if not default the value to blank, basically the same for all variables
    $nama = isset($_POST['nama']) ? $_POST['nama'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $fakultas = isset($_POST['fakultas']) ? $_POST['fakultas'] : '';
    $program_studi = isset($_POST['program_studi']) ? $_POST['program_studi'] : '';

    // Insert new record into the contacts table
    $stmt = $pdo->prepare('INSERT INTO mahasiswa VALUES (?, ?, ?, ?, ?)');
    $stmt->execute([$nim, $nama, $email, $fakultas, $program_studi]);
    // Output message
    $msg = 'Data mahasiswa baru sukses dibuat!';
}
?>


<?=template_header('Create')?>

<div class="content update">
	<h2>Buat Data Baru</h2>
    <form action="create.php" method="post">
        <label for="nim">NIM</label>
        <label for="nama">Nama</label>
        <input type="number" name="nim" id="nim" autocomplete="off">
        <input type="text" name="nama" id="nama" autocomplete="off">
        <label for="email">Email</label>
        <label for="fakultas">Fakultas</label>
        <input type="text" name="email" id="email" autocomplete="off">
        <input type="text" name="fakulras" id="fakultas">
        <label for="program_studi">Program Studi</label>
        <input type="text" name="program_studi" id="program_studi">
        <input type="submit" value="Create">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<?=template_footer()?>