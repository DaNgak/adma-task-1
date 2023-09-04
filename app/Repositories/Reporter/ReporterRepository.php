<?php

namespace App\Repositories\Reporter;

use App\Models\Reporter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class ReporterRepository implements ReporterRepositoryInterface
{
    protected Builder $query;

    function __construct(Reporter $reporter)
    {
        $this->query = $reporter->query();
    }

    function getAllDataReporter(): Collection
    {
        return $this->query->get();
    }

    function getPaginateReporter(): LengthAwarePaginator
    {
        return $this->query->paginate(5);
    }

    function createDataReporter(array $data): ?Reporter
    {
        try {
            return $this->query->create($data) ;
        } catch (QueryException $e) {
            return null;
        }
    }

    function updateDataReporter(Reporter $reporter, array $data) : ?Reporter
    {
        return $reporter->update($data) ? $reporter->refresh() : null;
    }

    function deleteDataReporter(Reporter $reporter) : bool
    {
        return $reporter->delete();
    }
}
