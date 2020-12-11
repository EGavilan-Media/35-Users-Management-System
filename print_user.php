<?php
require('vendor/fpdf/fpdf.php');

$connect = mysqli_connect('localhost','root','');
mysqli_select_db($connect,'egm_receipts_book');

class PDF extends FPDF {
	function Header(){
		$connect = mysqli_connect('localhost','root','');
		mysqli_select_db($connect,'egm_receipts_book');

        $sql = "SELECT company_name,
                        company_website,
                        company_email
                        FROM tbl_company
					WHERE company_id = '1'";

		$result = mysqli_query($connect, $sql);
		$row = mysqli_fetch_row($result);

		$this->Cell(12);
		$this->Image('images/company_logo.png',90,15,30);
		$this->Ln(21);

		$this->SetFont('Arial','B',18);
		$this->Cell(180	,5,$row[0],0,1,'C');
		$this->SetFont('Arial','',12);
		$this->Cell(180	,5,$row[1],0,1,'C');
		$this->Cell(180	,5,$row[2],0,1,'C');

		$this->Cell(12);

		$this->SetFont('Arial', 'B', 14);
		$this->Ln(4);
		$this->Cell(180	,5,'Users List',0,1,'C');

		$this->Ln(2);

		$this->SetFont('Arial','B',12);
		$this->SetFillColor(232, 236, 239);
		$this->SetDrawColor(0,0,0);
		$this->SetFont('Arial', '', 12);
		$this->SetTextColor(0,0,0);
		$this->Cell(10,10,'ID',1,0,'',true);
		$this->Cell(55,10,'Full Name',1,0,'',true);
		$this->Cell(55,10,'Email',1,0,'',true);
		$this->Cell(20,10,'Gender',1,0,'',true);
		$this->Cell(20,10,'Status',1,0,'',true);
		$this->Cell(20,10,'Role',1,1,'',true);

	}
	function Footer(){
		$this->SetY(-15);
		$this->SetFont('Arial','',8);
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}

$pdf = new PDF('P','mm','A4');

$pdf->AliasNbPages('{pages}');
$pdf->SetMargins(15,25.4,25.4,10);
$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();
$pdf->SetTitle('Users List');

$pdf->SetFont('Arial','',10);
$pdf->SetDrawColor(0,0,0);

$query = mysqli_query($connect, "SELECT * FROM tbl_users");

while($data = mysqli_fetch_array($query)){
	$pdf->Cell(10,5,$data[0],1,0);
	$pdf->Cell(55,5,$data[3],1,0);
	$pdf->Cell(55,5,$data[4],1,0);
	$pdf->Cell(20,5,$data[5],1,0);
	$pdf->Cell(20,5,$data[6],1,0);
	$pdf->Cell(20,5,$data[7],1,1);
}

$pdf->Output('I','Users List.pdf');
?>