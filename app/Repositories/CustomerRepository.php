<?php

namespace App\Repositories;

use App\Models\Customer;
use Illuminate\Database\QueryException;

class CustomerRepository
{
    public function firstOrCreate(array $data): Customer
    {
        $customer = Customer::where('phone', $data['phone'])->where('email', $data['email'])->first();
        if (!$customer) {
            return $this->createCustomer($data);
        }
        return $customer;
    }

    private function createCustomer(array $data): Customer
    {
        try {
            return Customer::create([
                'name' => $data['name'],
                'phone' => $data['phone'],
                'email' => $data['email'] ,
            ]);

        } catch (QueryException $e) {
            throw $e;
        }
    }
}
