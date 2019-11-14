<?php
class Laporanpdf extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->library('pdf');
	}

	function index()
	{
		$pdf=new FPDF('p','mm','A4');
		$pdf->AddPage();
		$pdf->SetFont('Arial','B','16');
		$pdf->Cell(190,7,'Bank Rakyat Indonesia',0,1,'C');
		$pdf->Cell(190,7,'Daftar Nasabah',0,1,'C');
       // $pdf->Cell(lebar,tinggi,tulisan,border,break,align)
		$pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(6,6,'No',1,0);
        $pdf->Cell(25,6,'NAMA ',1,0);
        $pdf->Cell(40,6,'EMAIL',1,0);
		$pdf->Cell(15,6,'JENIS',1,0);
		$pdf->Cell(35,6,'KERJA',1,0);
		$pdf->Cell(20,6,'TANGGAL',1,1);
		$pdf->SetFont('Arial','',10);
		//untuk membaca pada tabel database 
        $nasabah = $this->db->get('registrasi')->result();
        foreach ($nasabah as $row){
			// untuk membaca field pada tabel
            $pdf->Cell(6,6,$row->nourut,1,0);
            $pdf->Cell(25,6,$row->nama,1,0);
            $pdf->Cell(40,6,$row->email,1,0);
			$pdf->Cell(15,6,$row->jenis,1,0);
            $pdf->Cell(35,6,$row->kerja,1,0);
            $pdf->Cell(20,6,$row->tanggal,1,1);
        }
		$pdf->Output();
	}
}
?>