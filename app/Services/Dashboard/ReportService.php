<?php
namespace App\Services\Dashboard;

use App\Commons\Enums\StatusEnum;
use App\Helper\Helper;
use App\Models\Report;
use App\Models\Reporter;
use App\Models\ReportTracker;
use App\Repositories\Report\ReportRepositoryInterface;
use App\Repositories\Reporter\ReporterRepository;
use App\Repositories\Reporter\ReporterRepositoryInterface;
use App\Repositories\ReportTracker\ReportTrackerRepositoryInterface;
use Illuminate\Support\Str;

class ReportService {
    protected $reportRepository;
    protected $reporterRepository;
    protected $reportTrackerRepository;
    
    function __construct(ReportRepositoryInterface $reportRepository, ReporterRepositoryInterface $reporterRepository, ReportTrackerRepositoryInterface $reportTrackerRepository)
    {
        $this->reporterRepository =  $reporterRepository;
        $this->reportRepository = $reportRepository;
        $this->reportTrackerRepository = $reportTrackerRepository;
    }

    function indexData() : array {
        return [
            'reports' => $this->reportRepository->getPaginateReport()
        ];
    }

    function storeData(array $data) : Report {
        $reporterData = array_filter($data, function($key) {
            return !in_array($key, ["title", "description", "image"]);
        }, ARRAY_FILTER_USE_KEY);

        $reporter = $this->reporterRepository->createDataReporter($reporterData);

        $reportData = [
            "ticket_id" => Helper::generateTicketId(),
            "title" => $data["title"],
            "description" => $data["description"],
            "status" => StatusEnum::DEFAULT,
            "reporter_id" => $reporter->id
        ];

        $report = $this->reportRepository->createDataReport($reportData);

        foreach ($data['image'] as $image) {
            $report->addMedia($image)->toMediaCollection('images');
        }

        $reportTrackerData = [
            "report_id" => $report->id,
            "user_id" => auth()->user()->id,
            "status" => $report->status,
        ];

        $this->reportTrackerRepository->createDataReportTracker($reportTrackerData);

        return $report->refresh();
    }

    function updateData(Report $report, array $data) : Report {
        $dataReportUpdate = [
            'category_id' => $data['category_id'],
            'status' => $data['status'],
        ];

        return $this->reportRepository->updateDataReport($report, $dataReportUpdate); 
    }

    function deleteData(Report $report) : bool {
        return $this->reportRepository->deleteDataReport($report); 
    }

}