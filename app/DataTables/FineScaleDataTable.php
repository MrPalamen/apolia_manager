<?php

namespace App\DataTables;

use App\FineScale;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FineScaleDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($query) {
                return view('fine_scale.action', compact('query'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\FineScale $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FineScale $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('finescale-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(0)
                    ->parameters([
                        'pageLength'=> 50
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('type'),
            Column::make('name'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(300),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'FineScale_' . date('YmdHis');
    }
}
