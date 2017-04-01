<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ReportRepositoryInterface;
use App\Models\ReportView;
use Carbon\Carbon;

/**
 * Class ReportRepository
 * @package App\Repositories
 */
class ReportRepository implements ReportRepositoryInterface
{
    /**
     * @param array $criteria
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getDailyReport(array $criteria = [], int $limit, int $offset)
    {
        $days = $criteria['days'] ?? config('report.default_last_days');
        $dateObject = Carbon::now()->modify("-{$days} day")->format('Y-m-d');
        return ReportView::where('date','>=', $dateObject)->offset($offset)->limit($limit)->get();
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function countDailyReport(array $criteria)
    {
        $days = $criteria['days'] ?? config('report.default_last_days');
        $dateObject = Carbon::now()->modify("-{$days} day")->format('Y-m-d');
        return ReportView::where('date','>=', $dateObject)->count();
    }
}
