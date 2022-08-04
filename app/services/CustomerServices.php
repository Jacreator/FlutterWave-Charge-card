<?php

namespace App\Services;

use App\Models\Customer;

class CustomerServices
{
  private $customerModel;
  public function __construct(Customer $customer) {
    $this->customerModel = $customer;
  }
    public function getCustomers()
    {
        return $this->customerModel->all();
    }

    public function getCustomer($id)
    {
        return $this->customerModel->findOrFail($id);
    }

    public function getCustomerTransactions($id)
    {
        return $this->customerModel->findOrFail($id)->transactions;
    }

    public function createCustomer($customerPayload)
    {
        return $this->customerModel->create($customerPayload);
    }
}