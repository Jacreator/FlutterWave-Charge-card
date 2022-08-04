<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Services\CustomerServices;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    private $customerService;
    public function __construct(CustomerServices $customerServices)
    {
        $this->customerService = $customerServices;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'message' => 'Customers retrieved successfully',
            'statusCode' => Response::HTTP_OK,
            'data' => $this->customerService->getCustomers(),
        ], Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request): JsonResponse
    {
        return response()->json(
            [
                'message' => 'Customer created successfully',
                'statusCode' => Response::HTTP_CREATED,
                'data' => $this->customerService->createCustomer(
                    $this->dataToStore($request)
                ),
            ],
            Response::HTTP_CREATED
        );
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
            'message' => 'Customer retrieved successfully',
            'statusCode' => Response::HTTP_FOUND,
            'data' => $this->customerService->getCustomer($id)
        ], Response::HTTP_FOUND);
    }

    private function dataToStore($request)
    {

        return [
            'first_name' => $request->firstName,
            'middle_name' => $request->middleName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phoneNumber,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'country' => $request->country,
        ];
    }

    // get customer transactions
    public function customerTransactions($id)
    {
        return response()->json([
            'message' => 'Customer transactions retrieved successfully',
            'statusCode' => Response::HTTP_FOUND,
            'data' => $this->customerService->getCustomerTransactions($id)
        ], Response::HTTP_FOUND);
    }
}
