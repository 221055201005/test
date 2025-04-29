<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once APPPATH . 'libraries/FPDI/fpdf.php';
require_once APPPATH . 'libraries/FPDI/autoload.php';

use setasign\Fpdi\Fpdi;

class Pdf_merge
{
  public function merge($pdfFiles, $outputFile)
  {
    $pdf = new Fpdi();

    foreach ($pdfFiles as $fileInfo) {
        $file = $fileInfo['file'];
        $orientation = $fileInfo['orientation'];

        $pageCount = $pdf->setSourceFile($file);

        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
            $tplIdx = $pdf->importPage($pageNo);
            
            // Get the size of the imported page
            $size     = $pdf->getTemplateSize($tplIdx);
            $width    = $size['width'];
            $height   = $size['height'];
            $pdf->AddPage($size['orientation'], [$width, $height]);

            $pdf->useTemplate($tplIdx);
        }
    }

    $pdf->output($outputFile, 'F');
}
}
