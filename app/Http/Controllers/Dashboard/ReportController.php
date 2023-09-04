<?php

namespace App\Http\Controllers\Dashboard;

use App\Commons\Traits\BaseApiResponse;
use App\DataTables\ReportsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Report\StoreRequest;
use App\Http\Requests\Dashboard\Report\UpdateRequest;
use App\Http\Resources\ReportResource;
use App\Models\Report;
use App\Services\Dashboard\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    use BaseApiResponse;

    protected $reportService;
    public function __construct(ReportService $reportService) {
        $this->reportService = $reportService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(ReportsDataTable $dataTable)
    {
        return $dataTable->render('pages.dashboard.reports.index');
        // return view('pages.dashboard.reports.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $result = $this->reportService->storeData($request->validated());

        if ($result != null) {
            activity('Report')->log('Report ' . $result->ticket_id . ' already created');
            return $this->apiSuccess(201, 'Created', new ReportResource($result));
        }

        return $this->apiSuccess(500, 'Internal Server Error', null);
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        return $this->apiSuccess(200, 'Ok', new ReportResource($report));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Report $report)
    {
        $result = $this->reportService->updateData($report, $request->validated());
        
        if ($result != null) {
            activity('Report')->log('Report ' . $result->ticket_id . ' updated by' . auth()->user()->username);
            return $this->apiSuccess(200, 'Updated', new ReportResource($result));
        }

        return $this->apiSuccess(500, 'Internal Server Error', null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
