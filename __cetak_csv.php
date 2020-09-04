<?php
// Load file koneksi.php
include "config/dao.php";

// Load plugin PHPExcel nya
require_once 'PHPExcel/PHPExcel.php';

// Panggil class PHPExcel nya
$csv = new PHPExcel();

// Settingan awal fil excel
$csv->getProperties()->setCreator('Smart Tracking')
					   ->setLastModifiedBy('Smart Tracking')
					   ->setTitle("History Tracking")
					   ->setSubject("Tracking")
					   ->setDescription("Data History Smart Tracking")
					   ->setKeywords("History Tracking");

// Buat header tabel nya pada baris ke 1
$csv->setActiveSheetIndex(0)->setCellValue('A1', "NO"); 
$csv->setActiveSheetIndex(0)->setCellValue('B1', "WAKTU");
$csv->setActiveSheetIndex(0)->setCellValue('C1', "MOTOR");
$csv->setActiveSheetIndex(0)->setCellValue('D1', "PENGGUNA");
$csv->setActiveSheetIndex(0)->setCellValue('E1', "LOKASI AWAL");
$csv->setActiveSheetIndex(0)->setCellValue('F1', "JARAK DARI LOKASI AWAL");
$csv->setActiveSheetIndex(0)->setCellValue('G1', "STATUS");

// Buat query untuk menampilkan semua data siswa
$dao = new Dao();
$sql = $dao->viewHistory();

$no = 1;
$numrow = 2; 
while($data = mysqli_fetch_array($sql)){ 
	$csv->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $no);
	$csv->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data['waktu']);
	$csv->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $data['merk'].' ('.$data['plat_nomor'].')');
	$csv->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $data['pengguna']);
	$csv->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $data['nama_lokasi']);
	$csv->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $data['jarak_now']);
	$csv->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $data['status']);
	
	// Khusus untuk no telepon. kita set type kolom nya jadi STRING
	// $csv->setActiveSheetIndex(0)->setCellValueExplicit('E'.$numrow, $data['telp'], PHPExcel_Cell_DataType::TYPE_STRING);
	
	$no++; 
	$numrow++;
}

// Set orientasi kertas jadi LANDSCAPE
$csv->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);

// Set judul file excel nya
$csv->getActiveSheet(0)->setTitle('TRACKING'.date('YdmHis').'.csv');
$csv->setActiveSheetIndex(0);
$filename = 'TRACKING'.date('YdmHis').'.csv';
// Proses file excel
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename='.$filename); // Set nama file excel nya
header('Cache-Control: max-age=0');

$write = new PHPExcel_Writer_CSV($csv);
$write->save('php://output');
?>
