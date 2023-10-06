<?php
include 'conn.php';

$conn = mysqli_connect("localhost","root","17082003","perpustakaan");

if (!$conn) {
	echo "Koneksi Gagal";
}

// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;


// Prepare the SQL statement and get records from our contacts table, LIMIT will determine the page
$stmt = $pdo->prepare('SELECT * FROM mahasiswa ORDER BY nama LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$mahasiswa = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_mahasiswa = $pdo->query('SELECT COUNT(*) FROM mahasiswa')->fetchColumn();

// mendapatkan Query
function query($query) {
	global $conn;
	$result = mysqli_query($conn, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
  return $rows;

}

// Fungsi untuk pencarian 
function cari($keyword) {
	$query = "SELECT * FROM mahasiswa 
                WHERE 
            nama LIKE '%$keyword%' OR
            nim LIKE '%$keyword%' OR
            email LIKE '%$keyword%' OR
            fakultas LIKE '%$keyword%' OR
            program_studi LIKE '%$keyword%'
            ";
	return query($query);
}


// tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $mahasiswa = cari($_POST["keyword"]);
}


?>

<?=template_header('Read')?>
<div class="sbar">
        <?=template_sidebar()?>
</div>
<div class="right2">
    <div class="content read">
        <h2>Data Mahasiswa Pilkom</h2>
        <a href="create.php" class="create-contact">Data Mahasiswa Baru</a><a href="eksMahasiswa.php" class="export-book">Export Data</a>
        <form action="" method="POST" class="cari" >
        <input type="text" name="keyword" size="25" autofocus placeholder="masukkan data mahasiswa.." autocomplete="off">
        <button type="submit" name="cari"> Search </button> <br> <br>
        <table>
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
        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page*$records_per_page < $num_mahasiswa): ?>
            <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?=template_footer()?>