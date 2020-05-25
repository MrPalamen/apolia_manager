<?php

namespace App\DataTables;

use App\Records;
use Carbon\Carbon;
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
            ->addColumn('action', function ($query) {
                return view('record.action', compact('query'))->render();
            })
            ->addColumn('updated_at', function ($query) {
                return $query->updated_at;
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
            Column::make('id'),
            Column::make('surname')->title('Prénom du Salarié'),
            Column::make('name')->title('Nom du Salarié'),
            Column::make('number')->title('Matricule du Salarié'),
            Column::make('updated_at')->title('Date de modification'),
            Column::computed('action')
                ->width(330),
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
