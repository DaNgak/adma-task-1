<?php

namespace App\Repositories\ReportTracker;

use App\Models\ReportTracker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ReportTrackerRepository implements ReportTrackerRepositoryInterface
{
    protected Builder $query;

    function __construct(ReportTracker $reportTracker)
    {
        $this->query = $reportTracker->query();
    }

    function getAllDataReportTracker(): Collection
    {
        return $this->query->get();
    }

    function getPaginateReportTracker(): LengthAwarePaginator
    {
        return $this->query->paginate(5);
    }

    function createDataReportTracker(array $data): ?ReportTracker
    {
        try {
            return $this->query->create($data) ;
        } catch (QueryException $e) {
            return null;
        }
    }

    function updateDataReportTracker(ReportTracker $reportTracker, array $data) : ?ReportTracker
    {
        return $reportTracker->update($data) ? $reportTracker->refresh() : null;
    }

    function deleteDataReportTracker(ReportTracker $reportTracker) : bool
    {
        return $reportTracker->delete();
    }
}
