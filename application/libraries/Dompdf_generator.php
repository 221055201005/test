<?php
 
class Dompdf_generator
{
  public function generate_a3_potrait($html,$filename){
    define('DOMPDF_ENABLE_AUTOLOAD', false);    
    define("DOMPDF_ENABLE_HTML5PARSER", true);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A3','potrait');
    $dompdf->load_html($html);
    $dompdf->render();

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");
    
    // $canvas->page_text(400, 570, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));

    ob_end_clean();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }

  public function generate_a4_landscape_and_save($html,$filename){
    define('DOMPDF_ENABLE_AUTOLOAD', false);    
    define("DOMPDF_ENABLE_HTML5PARSER", true);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();
    $dompdf->set_paper('A4','landscape');
    $dompdf->load_html($html);
    $dompdf->render();

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");
    
    // $canvas->page_text(400, 570, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));

    // ob_end_clean();
    // $dompdf->stream($filename.'.pdf',array("Attachment"=>0));

    $pdf = $dompdf->output();
    $file_location = 'upload/'.$filename.'.pdf';
    file_put_contents($file_location,$pdf);
    return $file_location;
  }
}
?>