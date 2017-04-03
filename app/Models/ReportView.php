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

    /**
     * Make the sigh opposite for withdrawal total amount
     * @return string
     */
    public function getTotalAmountOfWithdrawalAttribute()
    {
        return number_format(-1 * ((float) $this->attributes['total_amount_of_withdrawal']), 2);
    }
}