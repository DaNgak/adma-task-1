<?php

namespace App\Http\Controllers\Dashboard;

use App\Commons\Enums\StatusEnum;
use App\DataTables\ReportTrackersDataTable;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ReportTracker;
use Illuminate\Http\Request;

class ReportTrackerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ReportTrackersDataTable $dataTable)
    {
        return $dataTable->render('pages.dashboard.report-trackers.index', [
            'categories' => Category::all(),
            'status' => [
                StatusEnum::DEFAULT,
                StatusEnum::ADMINISTRATIF,
                StatusEnum::PROCESSED,
                StatusEnum::APPROVED,
                StatusEnum::REJECTED,
            ]
        ]);
        // return view('pages.dashboard.report-trackers.index');
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ReportTracker $reportTracker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ReportTracker $reportTracker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ReportTracker $reportTracker)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ReportTracker $reportTracker)
    {
        //
    }
}
