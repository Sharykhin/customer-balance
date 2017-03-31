<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerView
 * @package App\Models
 */
class CustomerView extends Model
{
    use ReadOnlyTrait;

    protected $table = 'customer_view';
}