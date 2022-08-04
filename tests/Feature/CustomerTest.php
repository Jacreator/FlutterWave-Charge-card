<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A test to fetch all customer.
     *
     * @return void
     */
    public function test_fetch_all_customer()
    {
        $response = $this->get('/api/customers');

        $response->assertStatus(200);
    }

    /**
     * A test to fetch single customer.
     *
     * @return void
     */
    public function test_fetch_single_customer()
    {
        $customer = Customer::factory()->create();
        $response = $this->get('/api/customers/' . $customer->id);


        $response->assertStatus(Response::HTTP_FOUND);
        $response->assertJson([
            'data' => [
                'id' => $customer->id,
            ],
            'message' => 'Customer retrieved successfully',
            'statusCode' => Response::HTTP_FOUND,
        ]);
    }

    /**
     * A test to create customer.
     *
     * @return void
     */
    public function test_create_customer()
    {
        $response = $this->post('/api/customers', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'test10000@test.com',
            'phoneNumber' => '12345678900',
            'address' => 'sdfghjk',
            'city' => 'Abuja',
            'state' => 'FCT',
            'country' => 'NG',
        ]);

        $response->assertStatus(Response::HTTP_CREATED);
        $response->assertJson([
            'message' => 'Customer created successfully',
            'statusCode' => Response::HTTP_CREATED,
        ]);

        $this->assertDatabaseHas('customers', [
            'first_name' => 'John',
            'last_name' => 'Doe',
            'email' =>'test10000@test.com',
        ]);

    }
}
