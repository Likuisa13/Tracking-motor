<?php 
include 'config/dao.php'; 
include 'PHPExcel/PHPExcel.php';

$dao = new Dao();
$objPHPExcel = new PHPExcel();
$result = $dao->viewHistory();
 
$objPHPExcel->setActiveSheetIndex(0);

$objPHPExcel->getActiveSheet()->setCellValue('A1', "NO"); 
$objPHPExcel->getActiveSheet()->setCellValue('B1', "WAKTU");
$objPHPExcel->getActiveSheet()->setCellValue('C1', "MOTOR");
$objPHPExcel->getActiveSheet()->setCellValue('D1', "PENGGUNA");
$objPHPExcel->getActiveSheet()->setCellValue('E1', "LOKASI AWAL");
$objPHPExcel->getActiveSheet()->setCellValue('F1', "JARAK DARI LOKASI AWAL");
$objPHPExcel->getActiveSheet()->setCellValue('G1', "STATUS");
 
$objPHPExcel->getActiveSheet()->getStyle("A1:G1")->getFont()->setBold(true);
 
$rowCount   =   2;
$no = 1;
while($row  =   mysqli_fetch_array($result)){
    $objPHPExcel->getActiveSheet()->setCellValue('A'.$rowCount, $no);
	$objPHPExcel->getActiveSheet()->setCellValue('B'.$rowCount, $row['waktu']);
	$objPHPExcel->getActiveSheet()->setCellValue('C'.$rowCount, $row['merk'].' ('.$row['plat_nomor'].')');
	$objPHPExcel->getActiveSheet()->setCellValue('D'.$rowCount, $row['pengguna']);
	$objPHPExcel->getActiveSheet()->setCellValue('E'.$rowCount, $row['nama_lokasi']);
	$objPHPExcel->getActiveSheet()->setCellValue('F'.$rowCount, $row['jarak_now']);
    $objPHPExcel->getActiveSheet()->setCellValue('G'.$rowCount, $row['status']);
    $no++;
    $rowCount++;
}
 
$objWriter  =   new PHPExcel_Writer_Excel2007($objPHPExcel);
$filename = 'TRACKING'.date('YdmHis').'.xlsx';
header('Content-Type: application/vnd.ms-excel'); 
header('Content-Disposition: attachment;filename='.$filename); 
header('Cache-Control: max-age=0'); 
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');  
$objWriter->save('php://output');
?>