<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerBalance
 * @package App\Models
 */
class CustomerBalance extends Model
{
    /** @var array $fillable */
    protected $fillable = ['balance', 'bonus', 'customer_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}