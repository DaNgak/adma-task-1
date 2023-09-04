<?php

namespace App\Repositories\Report;

use App\Models\Report;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ReportRepository implements ReportRepositoryInterface
{
    protected Builder $query;

    function __construct(Report $report)
    {
        $this->query = $report->query();
    }

    function getAllDataReport(): Collection
    {
        return $this->query->get();
    }

    function getPaginateReport(): LengthAwarePaginator
    {
        return $this->query->paginate(5);
    }

    function createDataReport(array $data): ?Report
    {
        try {
            return $this->query->create($data) ;
        } catch (QueryException $e) {
            return null;
        }
    }

    function updateDataReport(Report $report, array $data) : ?Report
    {
        return $report->update($data) ? $report->refresh() : null;
    }

    function deleteDataReport(Report $report) : bool
    {
        return $report->delete();
    }
}
