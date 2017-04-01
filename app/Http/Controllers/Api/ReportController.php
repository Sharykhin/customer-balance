<?php

namespace App\Http\Controllers\Api;

use App\Interfaces\Repositories\ReportRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * Class ReportController
 * @package App\Http\Controllers\Api
 */
class ReportController
{
    const LIMIT = 50;

    /** @var ReportRepositoryInterface $reportRepository */
    protected $reportRepository;

    /**
     * ReportController constructor.
     * @param ReportRepositoryInterface $reportRepository
     */
    public function __construct(
        ReportRepositoryInterface $reportRepository
    )
    {
        $this->reportRepository = $reportRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request) : JsonResponse
    {
        $limit = (int) $request->query->get('limit') ?: self::LIMIT;
        $offset = (int) $request->query->get('offset') ?: 0;

        $publicParams = ['days'];
        $criteria = array_filter($request->only($publicParams));

        $reports = $this->reportRepository->getDailyReport($criteria, $limit, $offset);
        $total = $this->reportRepository->countDailyReport($criteria);
        $count = sizeof($reports);

        return response()->success($reports, compact('total', 'count', 'limit', 'offset'));
    }
}