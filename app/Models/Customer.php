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
    protected $fillable = ['gender', 'firs_name', 'last_name', 'country', 'email', 'bonus'];

    /** @var array $hidden  - array of fields that should be excluded from the output */
    protected $hidden = ['bonus'];
}