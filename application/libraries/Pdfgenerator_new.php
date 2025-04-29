<?php
defined('BASEPATH') OR exit('No direct script access allowed');
// panggil autoload dompdf nya
require_once 'dompdf-master/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;
class Pdfgenerator_new {
    public function generate($html, $filename='', $paper = '', $orientation = '', $stream=TRUE, $attachment_location = null)
    {   
        $options = new Options();
        $options->set('isRemoteEnabled', TRUE);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();
        if ($stream) {
            $dompdf->stream($filename.".pdf", array("Attachment" => 0));
        } else {
           if(!$attachment_location) {
            return $dompdf->output();
           }

           $pdf = $dompdf->output();
           $file_location = $attachment_location.'/'.$filename;
           file_put_contents($file_location,$pdf); 
        }
    }
}