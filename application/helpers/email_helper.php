<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function send_email_api($data) {
  $string     = encode_jwt("SEATRIUM EMAIL");
  $url        = 'http://10.5.252.166/api_email/public/api/email';
  $form_data  = array(
      "htmlContent" => $data['content'],
      "subject"     => $data['subject'],
      "JWT_TOKEN"   => $string
  );

  if(isset($data['email_to'])) {
    $form_data['email_to']  = $data['email_to'];
  }

  if(isset($data['email_cc'])) {
    $form_data['email_cc']  = $data['email_cc'];
  }

  if(isset($data['email_bcc'])) {
    $form_data['email_bcc']  = $data['email_bcc'];
  }

  $attachments = [];
  foreach ($data['attachments'] as $key => $value) {
    if (isset($value)) {
      $att['attachment']      = base64_encode($value['content']);
      $att['attachment_name'] = basename($value['filename']);
      $attachments[]          = $att;
    }
  }
  $form_data['attachment_list'] = $attachments;

  $jsonData = json_encode($form_data);
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string
  curl_setopt($ch, CURLOPT_POST, true); // Specify that this is a POST request
  curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData); // Attach JSON data to the request
  curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Content-Type: application/json', // Set content type to JSON
      'Content-Length: ' . strlen($jsonData) // Set content length
  ));

  $response = curl_exec($ch);
  $output   = [];
  if (curl_errno($ch)) {
      // echo 'cURL error: ' . curl_error($ch);
      $output     = [
        'success' => false
      ];
  } else {
      // echo 'Response: ' . $response;
      $output     = [
        'success' => true
      ];
  }

  // Close the cURL session
  curl_close($ch);
  echo json_encode($output);
}
