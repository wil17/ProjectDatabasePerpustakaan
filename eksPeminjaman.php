<?php
include 'conn.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();


$stmt = $pdo->prepare('SELECT * FROM peminjaman ORDER BY id_pinjam');
$stmt->execute();
// Fetch the records so we can display them in our template.
$pinjam = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<html>
<head>
  <title>Data peminjaman</title>
  <style>
    .container{
        margin-top:100px;
    }
  </style>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
</head>

<body>
<div class="container">
				<div class="data-tables datatable-dark">
                    <table class="eks">
                        <thead>
                            <tr>
                                <td>Id pinjam</td>
                                <td>Nama</td>
                                <td>NIM</td>
                                <td>Tgl pinjam</td>
                                <td>Tgl kembali</td>
                                <td>Id petugas</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pinjam as $pinjamm): ?>
                            <tr>
                                <td><?=$pinjamm['id_pinjam']?></td>
                                <td><?=$pinjamm['nama']?></td>
                                <td><?=$pinjamm['nim']?></td>
                                <td><?=$pinjamm['tgl_pinjam']?></td>
                                <td><?=$pinjamm['tgl_kembali']?></td>
                                <td><?=$pinjamm['id_petugas']?></td>
                                <td class="actions">
                                    <a href="buku_update.php?kode_eksemplar=<?=$pinjamm['id_pinjam']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="buku_hapus.php?kode_eksemplar=<?=$pinjamm['id_pinjam']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
				</div>
</div>
	
<script>
$(document).ready(function() {
    $('.eks').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy','csv','excel', 'pdf', 'print'
        ]
    } );
} );

</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

	

</body>

</html>