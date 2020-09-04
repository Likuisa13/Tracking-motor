<?php 
$html = '<html><head></head><body>';

$html .= '<center><h3>History Tracking</h3></center><hr/><br/>';
$html .= '<table border="1px" style="border: 1px solid #1C6EA4; background-color: #EEEEEE; width: 100%; text-align: left; border-collapse: collapse;" width="100%">
		<thead style="border: 1px solid #1C6EA4; background-color: #EEEEEE; width: 100%; text-align: center;background-color: #1E90FF;">
		 <tr>
			<td width="10px"><center>No</center></td>
			<td>Waktu</td>
			<td>Motor</td>
			<td>Pengguna</td>
			<td width="300px">Lokasi Awal</td>
			<td>Jarak Dari<br>Lokasi Awal</td>
			<td>Status</td>
		  </td>
		</thead><tbody>';

include_once 'config/dao.php';
require_once("dompdf/autoload.inc.php");
use Dompdf\Dompdf;
$dompdf = new Dompdf();
$no = 1;
$dao = new Dao();
$result = $dao->viewHistory();
$no = 1;
foreach ($result as $value) {
	$html .= '<tr><td>'.$no.'</td>
		<td>'.$value['waktu'].'</td>
		<td>'.$value['merk'].' ('.$value['plat_nomor'].')</td>
		<td>'.$value['pengguna'].'</td>
		<td>'.$value['nama_lokasi'].'</td>
		<td>'.$value['jarak_now'].' Km</td>
		<td>'.$value['status'].'</td>
	</tr>';
	$no++;
}

$html .= "</tbody></table></body></html>";
// echo $html;
$dompdf->loadHtml($html);
	// Setting ukuran dan orientasi kertas
$dompdf->setPaper('A4', 'landscape');
	// Rendering dari HTML Ke PDF
$dompdf->render();
	// Melakukan output file Pdf
$dompdf->stream('TRACKING'.date('YdmHis').'.pdf');
?>