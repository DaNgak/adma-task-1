<?php

namespace App\Repositories\Reporter;

use App\Models\Reporter;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface ReporterRepositoryInterface
{
    function getAllDataReporter() : Collection;

    function getPaginateReporter() : LengthAwarePaginator;

    function createDataReporter(array $data): ?Reporter;

    function updateDataReporter(Reporter $reporter, array $data) : ?Reporter;

    function deleteDataReporter(Reporter $reporter) : bool;
}
