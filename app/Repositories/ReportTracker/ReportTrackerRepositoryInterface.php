<?php

namespace App\Repositories\ReportTracker;

use App\Models\ReportTracker;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ReportTrackerRepositoryInterface
{
    function getAllDataReportTracker() : Collection;

    function getPaginateReportTracker() : LengthAwarePaginator;

    function createDataReportTracker(array $data): ?ReportTracker;

    function updateDataReportTracker(ReportTracker $reportTracker, array $data) : ?ReportTracker;

    function deleteDataReportTracker(ReportTracker $reportTracker) : bool;
}
