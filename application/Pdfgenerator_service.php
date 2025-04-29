<?php
 
class Pdfgenerator
{
  public function generate($html,$filename,$app_nos)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);    
    define("DOMPDF_ENABLE_HTML5PARSER", true);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();   
    $dompdf->set_paper('A4','landscape');
    $dompdf->load_html($html);
    $dompdf->render();

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");
    
    ob_end_clean();
    if(isset($filename)){
      $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
    } else {
      $dompdf->stream('Report_Document.pdf',array("Attachment"=>0));
    }
  }

  public function generate_ndt_mt($html,$filename,$app_nos, $initial = NULL)
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);    
    define("DOMPDF_ENABLE_HTML5PARSER", true);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();

    $dompdf->set_paper('A4','potrait');
    $dompdf->load_html($html);
    $dompdf->render();

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");

    
    if($initial=='MT'){
       $canvas->page_text(385, 109, "{PAGE_NUM} of {PAGE_COUNT}", $font, 7, array(0,0,0)); 
    } elseif($initial=='PT') {
        $canvas->page_text(432, 103, "{PAGE_NUM} of {PAGE_COUNT}", $font, 7, array(0,0,0));
    } elseif($initial=='UT') {
        $canvas->page_text(361, 116, "{PAGE_NUM} of {PAGE_COUNT}", $font, 7, array(0,0,0));
    }
    
    $canvas->page_text(508, 825, "SOF-QCF-".$initial."-001", $font, 7, array(0,0,0));
    $canvas->page_text(30, 570, $app_nos, $font, 6, array(0,0,0));
    ob_end_clean();
    $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }
}
?>