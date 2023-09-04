<?php

namespace App\DataTables;

use App\Models\Category;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoriesDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($category) {      
            $btn = "<a href='javascript:void(0);' data-id='$category->id' class='btn btn-sm btn-info btn-show-data'>
                        <i class='fa fa-eye'></i>
                    </a>";
            $btn .= "<a href='javascript:void(0);' data-id='$category->id' data-url='".route('categories.show', $category->id)."' class='btn btn-sm btn-warning mx-2 btn-edit-data'>
                        <i class='fa fa-pencil-alt'></i>
                    </a>";
            $btn .= "<a href='javascript:void(0);' data-id='$category->id' data-url='".route('categories.destroy', $category->id)."' class='btn btn-sm btn-danger text-white btn-delete-data'>
                        <i class='fa fa-trash'></i>
                    </a>";
            return '<div class="btn group"> ' . $btn . "</div>";
        })
        ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Category $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('categories-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->parameters([
                        'dom'          => 'Bfrtip',
                        'buttons'      => ['export', 'print', 'reset', 'reload'],
                    ])
                    // ->dom("<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" .
                    //     "<'row'<'col-sm-12'tr>>" .
                    //     "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>")
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
            Column::make('DT_RowIndex')->title('No')->width('10%')->searchable(false)->orderable(false),
            Column::make('name')->title('Nama')->width('30%'),
            Column::make('slug')->title('Slug')->width('30%'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center')
                ->width('30%'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Categories_' . date('YmdHis');
    }
}
