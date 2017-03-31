<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Customer
 * @package App\Models
 */
class Customer extends Model
{
    use SoftDeletes;

    /** @var array $fillable */
    protected $fillable = ['gender', 'first_name', 'last_name', 'country', 'email', 'bonus'];

    /** @var array $hidden */
    protected $hidden = ['deleted_at']; // temporary hide it from output
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance()
    {
        return $this->hasOne(CustomerBalance::class);
    }
}
