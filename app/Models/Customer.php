<?php

namespace App\Models;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'phone',
        'address',
        'city',
        'state',
        'country',
    ];

    public function getName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // get full address
    public function getFullAddress()
    {
        return $this->address . ', ' . $this->city . ', ' . $this->state . ', ' . $this->country;
    }

    /**
     * Get the transaction for the customer.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
