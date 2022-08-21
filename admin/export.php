<?php

include 'include/db.php';
$query = "SELECT * FROM appoint";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
?>

<?php 
#$client->convertURI('http://localhost/aadhi/pages/examples/viewinvoice.php?view='".$_GET['gen']."'', fopen('invoice.pdf', 'wb'));
require('include\fpdf182\fpdf.php');


class PDF_HTML extends FPDF
{


}
$pdf=new PDF_HTML();

$pdf->AddPage();
$pdf->SetFont('Arial','B',12);

$width_cell=array(20,24,25,20,20,30,40);
$pdf->SetFillColor(193,229,252); // Background color of header 
// Header starts /// 
$pdf->Cell($width_cell[0],10,'APP ID',1,0,'C',true);
$pdf->Cell($width_cell[1],10,'CLIENT ID',1,0,'C',true);
$pdf->Cell($width_cell[2],10,'DATE',1,0,'C',true);
$pdf->Cell($width_cell[3],10,'TIME',1,0,'C',true);
$pdf->Cell($width_cell[4],10,'STATUS',1,0,'C',true);
$pdf->Cell($width_cell[5],10,'PAYMENT',1,0,'C',true);

$pdf->Cell($width_cell[6],10,'CREATED',1,1,'C',true); 
//// header is over ///////

$pdf->SetFont('Arial','',10);
while ($row = mysqli_fetch_assoc($result)) {

$pdf->Cell($width_cell[0],10,$row['appId'],1,0,'C',false);
$pdf->Cell($width_cell[1],10,$row['clientId'],1,0,'C',false);
$pdf->Cell($width_cell[2],10,$row['date'],1,0,'C',false);
$pdf->Cell($width_cell[3],10,$row['time'],1,0,'C',false);
$pdf->Cell($width_cell[4],10,$row['status'],1,0,'C',false);
$pdf->Cell($width_cell[5],10,$row['payment'],1,0,'C',false);
$pdf->Cell($width_cell[6],10,$row['created'],1,1,'C',false);
}

$pdf->Output();