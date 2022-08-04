<?php

namespace App\helpers\thirdParty;

use KingFlamez\Rave\Facades\Rave as FlutterWave;

class FlutterWaveServices
{

  public function getReference()
  {
    return FlutterWave::generateReference();
  }

  public function initiatePayment(array $payload)
  {
    return FlutterWave::initializePayment($payload);
  }

  public function verifyPayment($payload)
  {
    if ($payload == 'successful') {
      $transactionId = FlutterWave::getTransactionIDFromCallback();

      return [
        'data' => FlutterWave::verifyTransaction($transactionId),
        'transactionId' => $transactionId,
        'status' => 'successful'
      ];
    } elseif ($payload == 'cancelled') {
      return [
        'status' => 'cancelled'
      ];
    }
    return [
      'status' => 'failed'
    ];
  }
}
