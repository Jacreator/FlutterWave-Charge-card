<?php

namespace App\Services;

use App\Models\Transaction;
use Illuminate\Support\Str;
use App\helpers\thirdParty\FlutterWaveServices;

class TransactionServices
{
    private $transactionModel;
    private $flutterWaveService;

    public function __construct(Transaction $transaction, FlutterWaveServices $flutterWaveServices) {
        $this->transactionModel = $transaction;
        $this->flutterWaveService = $flutterWaveServices;
    }

    public function getTransactions()
    {
        return $this->transactionModel->all();
    }

    public function getTransaction($id)
    {
        return $this->transactionModel->findOrFail($id);
    }

    public function getTransactionsCustomer($id)
    {
        return $this->transactionModel->findOrFail($id)->customer;
    }

    public function initiate($payload)
    {
    // generate ref
    
    // build complete payload
    $payload['tx_ref'] = $this->flutterWaveService->getReference();
    $payload['redirect_url'] = route('transactions.callback');
    
      // save transaction
      $transaction = $this->transactionModel->create([
        'customer_id' => $payload['customer_id'],
        'amount' => $payload['amount'],
        'reference' => $payload['tx_ref'],
        'status' => 'pending',
        'type' => $payload['payment_options'],
      ]);
      
      unset($payload['customer_id']);
      // initiate payment
      $response = $this->flutterWaveService->initiatePayment($payload);
      // check if payment was successful or not

      if ($response['status'] == 'successful') {
        $transaction->update([
          'status' => 'successful',
        ]);
        return $transaction;
      } else {
        return $response['data']['link'];
      }
    }

    public function verify($payload)
    {
      $response = $this->flutterWaveService->verifyPayment($payload);
    if ($response['status'] == 'successful') {
        $transaction = $this->transactionModel->where('reference', $response['transactionId'])->first();
        $transaction->update([
          'status' => 'successful',
        ]);
        return $transaction;
      } elseif ($response['status'] == 'cancelled') {
        // Send message to user that payment was cancelled
        // 
        return ['message' => 'Payment was cancelled'];
      }

      return ['message' => 'Payment was unsuccessful'];
      
    }
  }