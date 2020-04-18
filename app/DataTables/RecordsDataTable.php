<?php

namespace App\DataTables;

use App\Records;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RecordsDataTable extends DataTable
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
            ->addColumn('action', '')
            ->addColumn('action', function ($query) {
                return view('record.action', compact('query'))->render();
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Records $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Records $model)
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
            ->setTableId('Record-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(0)
            ->parameters([
                'pageLength'=> 50,
                'lengthMenu'=> [0, 5, 10, 20, 50, 100, 200, 500],
                'buttons' => ['create'],
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
            Column::make('id'),
            Column::make('surname'),
            Column::make('name'),
            Column::make('number'),
            Column::computed('action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Records_' . date('YmdHis');
    }
}
