<?php
namespace App\Traits;

trait Validation {
  function validateGReCaptcha($reCaptcha) {
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $data = [
      'secret' => config('app.GCAPTCHA_SECRET_KEY'), //env('GCAPTCHA_SECRET_KEY'),
      'response' => $reCaptcha
    ];

    $options = [
      'http' => [
        'header' => 'Content-type: Application/x-www-form-urlencoded\r\n',
        'method' => 'POST',
        'content' => http_build_query($data)
      ]
    ];

    $context = stream_context_create($options);

    $result = file_get_contents($url, false, $context);
    $resultJson = json_decode($result);
    return $resultJson->success;
  }
}
