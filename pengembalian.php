<?php
include 'conn.php';
// Connect to MySQL database
$pdo = pdo_connect_mysql();
// Get the page via GET request (URL param: page), if non exists default the page to 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
// Number of records to show on each page
$records_per_page = 10;


$stmt = $pdo->prepare('SELECT * FROM peminjaman ORDER BY id_pinjam LIMIT :current_page, :record_per_page');
$stmt->bindValue(':current_page', ($page-1)*$records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':record_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
// Fetch the records so we can display them in our template.
$pinjam = $stmt->fetchAll(PDO::FETCH_ASSOC);


// Get the total number of contacts, this is so we can determine whether there should be a next and previous button
$num_pinjam = $pdo->query('SELECT COUNT(*) FROM peminjaman')->fetchColumn();
?>

<?=template_header('Pinjam')?>
<div class="sbar">
        <?=template_sidebar()?>
</div>
<div class="right2">
    <div class="content read">
        <h2>Data Peminjaman Buku</h2>
        <table>
            <thead>
                <tr>
                    <td>Id pinjam</td>
                    <td>Nama</td>
                    <td>NIM</td>
                    <td>Tgl pinjam</td>
                    <td>Tgl kembali</td>
                    <td>Id petugas</td>
                    <td align="center">Status</td>
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
                        <a href="pengembalian_hapus.php?id_pinjam=<?=$pinjamm['id_pinjam']?>" class="trash">Selesai</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <div class="pagination">
            <?php if ($page > 1): ?>
            <a href="pinjamm.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
            <?php endif; ?>
            <?php if ($page*$records_per_page < $num_pinjam): ?>
            <a href="pinjamm.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
            <?php endif; ?>
        </div>
    </div>
</div>
<?=template_footer()?>