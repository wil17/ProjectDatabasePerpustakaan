<?php
include 'conn.php';
// include 'sidebar.php';
$pdo = pdo_connect_mysql();
$bukuRows = $pdo->query('select count(*) from buku')->fetchColumn();
$anggotaRows = $pdo->query('select count(*) from mahasiswa')->fetchColumn();
$peminjamRows = $pdo->query('select count(*) from peminjaman')->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="dashStyle.css">
    <title>Document</title>
</head>
<body>
    <?=template_header('Delete')?>
    <div class="sbar">
        <?=template_sidebar()?>
    </div>
    <div class="main">
        <div class="left">
            <img src="buku.png" width="200px">
            <div class="text1">
                <h4>Total Buku</h4>
                <h4 style="margin-left:30px;font-size:20px;"><?php echo $bukuRows; ?></h4>
            </div>
        </div>
        <div class="mid">
            <img src="anggota.png" width="200px">
            <div class="text2">
                <h4>Total Anggota</h4>
                <h4 style="margin-left:42px;font-size:20px;"><?php echo $anggotaRows; ?></h4>
            </div>
        </div>
        <div class="right">
            <img src="peminjam.png" width="200px">    
            <div class="text3">
                <h4>Peminjam</h4>
                <h4 style="margin-left:33px;font-size:20px;"><?php echo $peminjamRows; ?></h4>
            </div></div>
    </div>
    <?=template_footer()?>
</body>
</html>
