<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TransactionServices;
use App\Http\Requests\TransactionRequest;
use Symfony\Component\HttpFoundation\Response;

class TransactionController extends Controller
{
    private $transactionService;

    public function __construct(TransactionServices $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'message' => 'Transactions retrieved successfully',
            'statusCode' => Response::HTTP_OK,
            'data' => $this->transactionService->getTransactions(),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TransactionRequest $request)
    {

        return response()->json([
            'message' => 'Transaction created successfully',
            'statusCode' => Response::HTTP_CREATED,
            'data' => $this->transactionService->initiate($this->dataToStore($request))
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'message' => 'Transaction retrieved successfully',
            'statusCode' => Response::HTTP_FOUND,
            'data' => $this->transactionService->getTransaction($id)
        ]);
    }

    private function dataToStore($request)
    {
        return [
            'customer_id' => $request->customerId,
            'amount' => $request->amount,
            'payment_options' => $request->paymentMethod,
            'currency' => 'NGN',
            'email' => $request->email,
            'customer' => [
                'name' => $request->lastName,
                'email' => $request->email,
                'phone_number' => $request->phoneNumber,
                
            ],
        ];
    }

    public function callback()
    {
        return response()->json([
            'message' => 'Transaction callback received successfully',
            'statusCode' => Response::HTTP_OK,
            'data' => $this->transactionService->verify(request()->status)
        ], Response::HTTP_OK);
    }
}
