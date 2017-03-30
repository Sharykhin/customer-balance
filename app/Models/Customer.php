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
    protected $fillable = ['gender', 'first_name', 'last_name', 'country_id', 'email', 'bonus'];

    /** @var array $hidden  - array of fields that should be excluded from the output */
    protected $hidden = ['bonus'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function balance()
    {
        return $this->hasOne(CustomerBalance::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function country()
    {
        return $this->hasOne(Country::class);
    }
}