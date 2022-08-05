<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to fetch all transaction.
     *
     * @return void
     */
    public function test_fetch_all_transactions()
    {
        $response = $this->get('/api/transactions');

        $response->assertStatus(200);
        $response->assertJson([
            'message' => 'Transactions retrieved successfully',
            'statusCode' => Response::HTTP_OK,
        ]);
    }

    /**
     * A test to fetch single transaction.
     *
     * @return void
     */
    public function test_fetch_single_transaction()
    {
        $transaction = Transaction::factory()->create();
        $response = $this->get('/api/transactions/' . $transaction->id);

        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertJson([
            'data' => [
                'id' => $transaction->id,
            ],
            'message' => 'Transaction retrieved successfully',
            'statusCode' => Response::HTTP_FOUND,
        ]);
    }

    /**
     * A test to create customer.
     *
     * @return void
     */
    public function test_charge_and_create_transaction()
    {
        $customer = Customer::factory()->create();
        $response = $this->post('/api/transactions', [
            'customerId' => $customer->id,
            'amount' => '5000',
            'paymentMethod' => 'Card',
            'email' => $customer->email,
            'phoneNumber' => $customer->phone,
            'name' => $customer->getName(),
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'message' => 'Transaction created successfully',
            'statusCode' => Response::HTTP_CREATED,
        ]);

        $this->assertDatabaseHas('transactions', [
            'customer_id' => $customer->id,
        ]);

    }
}
