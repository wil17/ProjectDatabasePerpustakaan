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


$stmt = $pdo->prepare('SELECT * FROM buku ORDER BY judul LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$buku = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_buku = $pdo->query('SELECT COUNT(*) FROM buku')->fetchColumn();


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
	$query = "SELECT * FROM buku 
                WHERE 
            kode_eksemplar LIKE '%$keyword%' OR
            judul LIKE '%$keyword%' OR
            penerbit LIKE '%$keyword%' OR
            kategori LIKE '%$keyword%' OR
            pengarang LIKE '%$keyword%' OR
            tahun LIKE '%$keyword%' OR
            no_rak LIKE '%$keyword%'
            ";
	return query($query);
}


// // tombol cari ditekan
if( isset($_POST["cari"]) ) {
    $buku = cari($_POST["keyword"]);
}


?>



<?=template_header('Book')?>
<div class="sbar">
        <?=template_sidebar()?>
</div>
<div class="right2">
    <div class="content read">
        <h2>Selamat Datang di Data Buku Perpustakaan</h2>
        <a href="buku_baru.php" class="create-book">Buat Data Buku Baru</a><a href="eksport.php" class="export-book">Export Data</a>
        <form action="" method="POST" class="cari" >
        <input type="text" name="keyword" size="25" autofocus placeholder="masukkan data buku.." autocomplete="off">
        <button type="submit" name="cari"> Search </button> <br> <br>
        <table>
            <thead>
                <tr>
                    <td>Kode Eksemplar</td>
                    <td>Judul</td>
                    <td>Penerbit</td>
                    <td>Kategori</td>
                    <td>Pengarang</td>
                    <td>Tahun</td>
                    <td>No rak</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($buku as $book): ?>
                <tr>
                    <td><?=$book['kode_eksemplar']?></td>
                    <td><?=$book['judul']?></td>
                    <td><?=$book['penerbit']?></td>
                    <td><?=$book['kategori']?></td>
                    <td><?=$book['pengarang']?></td>
                    <td><?=$book['tahun']?></td>
                    <td><?=$book['no_rak']?></td>
                    <td class="actions">
                        <a href="buku_update.php?kode_eksemplar=<?=$book['kode_eksemplar']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                        <a href="buku_hapus.php?kode_eksemplar=<?=$book['kode_eksemplar']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="book.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page*$records_per_page < $num_buku): ?>
            <a href="book.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?=template_footer()?>