<?php
 
class Pdfgenerator_download
{
  public function generate($html,$filename,$app_nos, $attachment_location, $orientation = "landscape")
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);    
    define("DOMPDF_ENABLE_HTML5PARSER", true);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
    $dompdf = new DOMPDF();
    // $dompdf->set_option("isPhpEnabled", true);
    $dompdf->set_paper('A4',$orientation);

    $dompdf->load_html($html);
    $dompdf->render();

    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");
    $canvas->page_text(610, 570, "This Data Collected From PCMS Database (Page {PAGE_NUM} of {PAGE_COUNT})", $font, 7, array(0,0,0));

    $pdf = $dompdf->output();
    $file_location = $attachment_location.'/'.$filename;
    file_put_contents($file_location,$pdf); 

    // // Parameters
    // $x          = 505;
    // $y          = 790;
    // $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
    // // $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
    // $font       = Font_Metrics::get_font('helvetica', 'normal');
    // $size       = 10;    
    // $color      = array(0,0,0);
    // $word_space = 0.0;
    // $char_space = 0.0;
    // $angle      = 0.0;
    // $dompdf->page_text($x, $y, '{PAGE_NUM}/{PAGE_COUNT}', $font, $size);

    // $dompdf->getCanvas()->page_text(
    //   $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
    // );

    // $w = $pdf->get_width();

    // $canvas = $dompdf->get_canvas();
    // $font = Font_Metrics::get_font("helvetica", "bold");

    // $h = $pdf->get_height();
    // $y = $h - 24;

    
    // $canvas->page_text(400, 570, "{PAGE_NUM} of {PAGE_COUNT}", $font, 6, array(0,0,0));

    // $canvas->page_text(30, 570, $app_nos, $font, 6, array(0,0,0));
    // $canvas->page_text(510, 20, $html, $font, 6, array(0,0,0));

    // ob_end_clean();
    // $dompdf->stream($filename.'.pdf',array("Attachment"=>0));
  }

  public function generate_v2($html, $filename, $attachment_location, $page_size = "A4", $orientation = "potrait")
  {
    define('DOMPDF_ENABLE_AUTOLOAD', false);    
    define("DOMPDF_ENABLE_HTML5PARSER", true);
    require_once("vendor/dompdf/dompdf/dompdf_config.inc.php");
 
    $dompdf = new DOMPDF();

    $dompdf->set_paper($page_size, $orientation);
    $dompdf->load_html($html);
    $dompdf->render();
    
    $canvas = $dompdf->get_canvas();
    $font = Font_Metrics::get_font("helvetica", "bold");

    $pdf = $dompdf->output();
    $file_location = $attachment_location.'/'.$filename;
    file_put_contents($file_location,$pdf); 
  }

}
?>