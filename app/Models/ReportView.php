<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class CustomerView
 * @package App\Models
 */
class ReportView extends Model
{
    use ReadOnlyTrait;

    protected $table = 'reports_view';
}