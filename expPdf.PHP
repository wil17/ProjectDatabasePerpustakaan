<?php
include('Database.php');
$database = new Database();
$result = $database->runQuery("SELECT * FROM buku");
$header = $database->runQuery("SELECT UCASE(`COLUMN_NAME`) 
FROM `INFORMATION_SCHEMA`.`COLUMNS` 
WHERE `TABLE_SCHEMA`='crud' 
AND `TABLE_NAME`='buku'
and `COLUMN_NAME` in (kode_eksemplar, judul, penerbit, kategori, pengarang, tahun, no_rak)");

require('fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

foreach($header as $heading) {
	foreach($heading as $column_heading)
		$pdf->Cell(95,12,$column_heading,1);
}
foreach($result as $row) {
	$pdf->Ln();
	foreach($row as $column)
		$pdf->Cell(95,12,$column,1);
}
$pdf->Output();
?>