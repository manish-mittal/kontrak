<?php
include('config.php');
require('vendor/fpdf/fpdf.php');

	if(isset($_GET['invoice_report'])){
		$contract_num = $_GET['reference-num'];
	    $get_invoices = "Select * from invoice where contract_no = '$contract_num'";
	    $result_invoices = mysqli_query($conn,$get_invoices);
	    $row_invoices = mysqli_fetch_array($result_invoices);
	    $total = 0;
	}

class PDF extends FPDF
{
	function Header()
	{
		// Arial bold 15
	    $this->SetFont('Arial','B',15);
	    // Logo
	    $this->Cell(50, 5,'KonTrak',0,0,'L');
	    // Move to the right
	    $this->Cell(80);
	    $this->SetFont('Arial','B',12);
	    // Title
	    $this->Cell(70,10,'Auto Generated Report',0,0,'C');
	    // Line break
	    $this->Ln(5);
	    $this->SetFont('Arial','B',8);
	    $this->Cell(50, 5,'Contract Management System',0,0,'L');
	    $this->Ln(15);
	}

	function Footer()
	{
	    // Position at 1.5 cm from bottom
	    $this->SetY(-15);
	    // Arial italic 8
	    $this->SetFont('Arial','I',8);
	    // Page number
	    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
	}
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',15);
$pdf->Cell(45,10,'Contract Number : ',0,0,'R');
$pdf->Cell(30,10,$contract_num,0,1,'L');
$pdf->Ln(5);
$pdf->SetFont('Times','B',12);
$pdf->Cell(40,12,'Invoice No.',1,0,'C');
$pdf->Cell(75,12,'Description',1,0,'C');
$pdf->Cell(35,12,'Date',1,0,'C');
$pdf->Cell(40,12,'Amount',1,0,'C');
$pdf->SetFont('Times','',12);
foreach($result_invoices as $row) {
	$pdf->Ln();
	$pdf->Cell(40,12,$row['id'],1,0,'C');
	$pdf->Cell(75,12,$row['description'],1,0,'C');
	$pdf->Cell(35,12,$row['date'],1,0,'C');
	$pdf->Cell(40,12,$row['amount'],1,0,'C');
	$total += $row['amount'];
}
$pdf->ln(12);
$pdf->Cell(115,12,'');
$pdf->Cell(35,12,'Total Spend',1,0,'C');
$pdf->Cell(40,12,$total,1,0,'C');
$pdf->Output();
?>