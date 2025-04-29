<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function check_browser(){
  if(!preg_match('/Chrome/i',$_SERVER['HTTP_USER_AGENT'])){ 
    redirect('error_user/browser');
  } 

  // echo $_SERVER['HTTP_USER_AGENT'];
  // echo preg_match('/Chrome/i',$_SERVER['HTTP_USER_AGENT']);
}

function delete_recursive($dir) { 
  foreach(glob($dir . '/*') as $file) { 
    if(is_dir($file)) delete_recursive($file); else unlink($file); 
  } rmdir($dir); 
}


function zipData($source, $destination)
{
  if (extension_loaded('zip')) {
    if (file_exists($source)) {
      $zip = new ZipArchive();
      if ($zip->open($destination, ZIPARCHIVE::CREATE)) {
        $source = realpath($source);
        if (is_dir($source)) {
          $iterator = new RecursiveDirectoryIterator($source);
          // skip dot files while iterating
          $iterator->setFlags(RecursiveDirectoryIterator::SKIP_DOTS);
          $files = new RecursiveIteratorIterator($iterator, RecursiveIteratorIterator::SELF_FIRST);
          foreach ($files as $file) {
            $file = realpath($file);
            if (is_dir($file)) {
              $zip->addEmptyDir(str_replace($source . '', '', $file . ''));
            } else if (is_file($file)) {
              $zip->addFromString(str_replace($source . '', '', $file), file_get_contents($file));
            }
          }
        } else if (is_file($source)) {
          $zip->addFromString(basename($source), file_get_contents($source));
        }
      }
      return $zip->close();
    }
  }
  return false;
}
