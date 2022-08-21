<?php  
session_start();
//export.php  
$connect = mysqli_connect("localhost", "root", "", "ax");
$output = '';



//Connect to your database
include("include\db.php");
$appId = $_GET['appId'];
$query = "SELECT * FROM appoint where appId='$appId'";
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
while ($row = mysqli_fetch_array($result)) {
	$code = $row['code'];
	$clientId = $row['clientId'];
	$date = $row['date'];
	$time = $row['time'];
	$status = $row['status'];
}

  $query = "SELECT * FROM client where clientId='$_SESSION[clientId]'";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  while ($row = mysqli_fetch_array($result)) {
    $firstName = $row['firstName'];
    $lastName = $row['lastName'];
    $email = $row['email'];
    $contact = $row['contactNo'];
  }

  $query = "SELECT * FROM healthdeclaration";
  $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
  while ($row = mysqli_fetch_array($result)) {
  $q1 = $row['q1'];
  $q2 = $row['q2'];
  $q3 = $row['q3'];
  $q4 = $row['q4'];
  $q5 = $row['q5'];
  }


if(isset($_POST["export"]))
{
	require('include\fpdf182\fpdf.php');
	class PDF extends FPDF
{
 
}
$pdf = new PDF();
// First page
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image('img/pdfLogo.png',0,0,-300);
$pdf->Ln(40);//Line break
$pdf->Cell(35, 5, 'Appointment Date', 0, 0);
	$pdf->Cell(58, 5, ': '.$date, 0, 0);
	$pdf->Cell(20, 5, 'Date', 0, 0);
	$pdf->Cell(20, 5, ': '.date("Y/m/d"), 0, 1);
	$pdf->Cell(35, 5, 'Appointment Time', 0, 0);
	$pdf->Cell(58, 5, ': '.$time, 0, 0);
	$pdf->Cell(20, 5, 'Email', 0, 0);
	$pdf->Cell(20, 5, ': '.$email, 0, 1);
    $pdf->Cell(35, 5, 'Contact Number:', 0, 0);
	$pdf->Cell(58, 5, ':'.$contact, 0, 0);
	
	$pdf->Line(10, 80, 200, 80);
	
	$pdf->Cell(20, 5, 'Status', 0, 0);
	$pdf->Cell(20, 5, ': '.$status, 0, 1);
	$pdf->Ln(20);
	$pdf->Cell(55, 5, 'Health Declaration Form', 0, 0);
	$pdf->Ln(5);
	$pdf->Cell(58, 5, '', 0, 1);
	$pdf->Multicell(199, 5, '1.Have you experienced cough, fever, sore throat, Body pains, shortness of breath, Diarrhea, Loss of taste or smell, Difficulty of breathing, Fatigue/Tiredness in the last 24 hours? '.$q1, 0, 1);
	$pdf->Ln(10);
	$pdf->Multicell(199, 5, '2. Have you recently been tested for COVID-19 or been in contact with a suspected or COVID-19 positive individual (in the last two weeks)? '.$q2, 0, 1);
	$pdf->Ln(10);
	$pdf->Multicell(199, 5, '3. Have you provided direct care for a patient with probable or confirmed COVID-19 case without using proper "Personal Protective Equipment (PPE)" for the past 14 days? '.$q3, 0, 1);
	$pdf->Ln(10);
	$pdf->Multicell(199, 5, '4. Have you traveled outside the Philippines in the last 14 days? '.$q4, 0, 1);
	$pdf->Ln(10);
	$pdf->Multicell(199, 5, '5. Have you traveled outside the current city/municipality where you reside? If yes, specify which city/municipality you went to? '.$q5, 0, 1);
	$pdf->Ln(2);

$pdf->Line(10, 200, 200, 200	); // 50mm from each edge
//$pdf->Line(1, 190, 290-50, 190); // 50mm from each edge


$pdf->Ln(30);//Line break
// $pdf->Cell(55, 5, 'Paid by', 0, 0);
// $pdf->Cell(58, 5, ':'.$firstName. ' '.$lastName, 0, 1);
$pdf->Ln(2);
// $pdf->Cell(55, 5, 'Receptionist Name:', 0, 0);
// $pdf->Cell(58, 5, 'Ms Joy Capuyan', 0, 1);
$pdf->Ln(11);//Line break
$pdf->Cell(140, 5, '', 0, 0);

$pdf->Output();
}
