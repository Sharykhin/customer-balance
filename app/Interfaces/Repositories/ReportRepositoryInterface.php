<?php

namespace App\Interfaces\Repositories;

/**
 * Interface ReportRepositoryInterface
 * @package App\Interfaces\Repositories
 */
interface ReportRepositoryInterface
{
    /**
     * @param array $criteria
     * @param int $limit
     * @param int $offset
     * @return mixed
     */
    public function getDailyReport(array $criteria = [], int $limit, int $offset);

    /**
     * @param array $criteria
     * @return mixed
     */
    public function countDailyReport(array $criteria);
}