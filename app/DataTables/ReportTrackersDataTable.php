<?php

namespace App\DataTables;

use App\Models\ReportTracker;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReportTrackersDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($reportTracker) {      
                $btn = "<a href='javascript:void(0);' data-id='$reportTracker->id' data-url='".route('reports.show', $reportTracker->report_id)."' class='btn btn-sm btn-info btn-show-data'>
                            <i class='fa fa-eye'></i>
                        </a>";
                $btn .= "<a href='javascript:void(0);' data-id='$reportTracker->id' data-url='".route('reports.show', $reportTracker->report_id)."' class='btn btn-sm btn-warning btn-edit-data mx-2'>
                            <i class='fa fa-pencil-alt'></i>
                        </a>";
                return '<div class="btn group"> ' . $btn . "</div>";
            })
            ->editColumn('user_id', function ($reportTracker) {
                return $reportTracker->user_id ? $reportTracker->operator->name . ' (' . $reportTracker->operator->username .')' : '-' ;
            })
            ->editColumn('reporter_id', function ($reportTracker) {
                return $reportTracker->report_id ? $reportTracker->report->reporter->email : '-';
            })
            ->editColumn('status', function ($reportTracker) {
                return $reportTracker->report_id ? $reportTracker->report->status : '-';
            })
            ->addColumn('report_category_id', function ($reportTracker) {
                if ($reportTracker->report_id) {
                    return $reportTracker->report->category_id ? $reportTracker->report->category->name  : '-';
                }
                return '-';
            })
            ->addColumn('report_ticket_id', function ($reportTracker) {
                return $reportTracker->report_id ? $reportTracker->report->ticket_id : '-';
            })
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ReportTracker $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reporttrackers-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                    ])
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->autoWidth(false);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('DT_RowIndex')->title('No')->width('5%')->searchable(false)->orderable(false),
            Column::make('report_ticket_id')->title('Ticket')->width('15%'),
            Column::make('report_category_id')->title('Category')->width('15%'),
            Column::make('user_id')->title('Operator')->width('20%'),
            Column::make('reporter_id')->title('Reporter')->width('20%'),
            Column::make('status')->title('Status')->width('10%'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width('15%'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'ReportTrackers_' . date('YmdHis');
    }
}
