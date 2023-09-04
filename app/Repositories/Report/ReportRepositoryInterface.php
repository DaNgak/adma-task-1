<?php

namespace App\Repositories\Report;

use App\Models\Report;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ReportRepositoryInterface
{
    function getAllDataReport() : Collection;

    function getPaginateReport() : LengthAwarePaginator;

    function createDataReport(array $data): ?Report;

    function updateDataReport(Report $report, array $data) : ?Report;

    function deleteDataReport(Report $report) : bool;
}
