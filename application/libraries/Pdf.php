<?php
class pdf {
 
    function __construct() {
        include_once APPPATH . '/third_party/tcpdf/tcpdf.php';
    }

    function generate_pdf($html, $file_name) {
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
          $pdf->setPrintFooter(false);
          $pdf->setPrintHeader(false);
          $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
          $pdf->AddPage('');
          $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
          $pdf->SetFont('helvetica');
          $pdf->writeHTML($html);
          $pdf->Output($file_name.'.pdf', 'I');
    }

    function generate_pdf_landscape($html, $file_name) {
          ob_start();
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true, 'UTF-8', false);
          $pdf->setPrintFooter(false);
          $pdf->SetMargins(10, 10, 10, true);
          $pdf->setPrintHeader(false);
          $pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
          $pdf->AddPage('');
          $pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);
          $pdf->SetFont('helvetica');
          $pdf->writeHTML($html);
          ob_end_clean();
          $pdf->Output($file_name.'.pdf', 'I');
    }

    function generate_pdf_A3_L($html, $file_name) {
          ob_start();
          $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, 'A3', true, 'UTF-8', false);
          $pdf->setPrintHeader(false);
          $pdf->setPrintFooter(false);
          $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
          $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
          $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
          if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
              require_once(dirname(__FILE__).'/lang/eng.php');
              $pdf->setLanguageArray($l);
          }
          // ---------------------------------------------------------
          $pdf->SetMargins(3, 5, PDF_MARGIN_RIGHT, true);
          $pdf->SetFont('helvetica', '', 20);
          $pdf->AddPage();
          // -----------------------------------------------------------------------------

          $pdf->writeHTML($html, true, false, false, false, '');
          ob_end_clean();
          $pdf->Output($file_name.'.pdf', 'I');
    }
    
}