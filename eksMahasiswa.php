<?php
include 'conn.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();

// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM mahasiswa ORDER BY nama');
$stmt->execute();
// Fetch the records so we can display them in our template.
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_mahasiswa = $pdo->query('SELECT COUNT(*) FROM mahasiswa')->fetchColumn();
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
                                <td>NIM</td>
                                <td>Nama</td>
                                <td>Email</td>
                                <td>Fakultas</td>
                                <td>Program_Studi</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($mahasiswa as $mhs): ?>
                            <tr>
                                <td><?=$mhs['nim']?></td>
                                <td><?=$mhs['nama']?></td>
                                <td><?=$mhs['email']?></td>
                                <td><?=$mhs['fakultas']?></td>
                                <td><?=$mhs['program_studi']?></td>
                                <td class="actions">
                                    <a href="update.php?nim=<?=$mhs['nim']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                                    <a href="delete.php?nim=<?=$mhs['nim']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
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