<?php

namespace App\DataTables;

use App\Models\Report;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ReportsDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($report) {      
            $btn = "<a href='javascript:void(0);' data-id='$report->id' data-url='".route('reports.show', $report->id)."' class='btn btn-sm btn-info btn-show-data'>
                        <i class='fa fa-eye'></i>
                    </a>";
            $btn .= "<a href='javascript:void(0);' data-id='$report->id' data-url='".route('reports.show', $report->id)."' class='btn btn-sm btn-warning mx-2 btn-edit-data'>
                        <i class='fa fa-pencil-alt'></i>
                    </a>";
            $btn .= "<a href='javascript:void(0);' data-id='$report->id' data-url='".route('reports.destroy', $report->id)."' class='btn btn-sm btn-danger text-white btn-delete-data'>
                        <i class='fa fa-trash'></i>
                    </a>";
            return '<div class="btn group"> ' . $btn . "</div>";
        })
        ->editColumn('reporter_id', function ($report) {
            return $report->reporter_id ? $report->reporter->email . ' (' . $report->reporter->name .')' : '-' ;
        })
        ->editColumn('category_id', function ($report) {
            return $report->category_id ? $report->category->name : '-';
        })
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Report $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('reports-table')
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
            Column::make('ticket_id')->title('Ticket')->width('15%'),
            Column::make('title')->title('Title')->width('20%'),
            Column::make('status')->title('Status')->width('15%'),
            Column::make('reporter_id')->title('Reporter')->width('20%'),
            Column::make('category_id')->title('Category')->width('10%'),
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
        return 'Reports_' . date('YmdHis');
    }
}
