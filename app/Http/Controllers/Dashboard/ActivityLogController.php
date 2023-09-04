<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ActivityLogsDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(ActivityLogsDataTable $dataTable)
    {
        return $dataTable->render('pages.dashboard.activity-logs.index');
    }
}
