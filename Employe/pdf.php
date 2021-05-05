<?php 
require_once "library/tcpdf.php";

/**
 * 
 */
class Pdf extends TCPDF
{
	
	function __construct()
	{
		parent::__construct();
	}

	 // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Copyright © Bureau de Centralisation Géomatique', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // $this->Cell(0, 10, 'Copyright © Bureau de Centralisation Géomatique'.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
        // $this->Cell(0, 10, 'Designed by IGUGU ETIENNE Tshisekedi', 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}



