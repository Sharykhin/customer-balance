<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Transaction
 * @package App\Models
 */
class Transaction extends Model
{
    /** @var array $fillable */
    protected $fillable = ['customer_id', 'amount', 'currency', 'status', 'updated_at', 'created_at'];
}