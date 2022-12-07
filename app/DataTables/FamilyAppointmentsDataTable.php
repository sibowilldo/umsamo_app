<?php

namespace App\DataTables;

use App\Appointment;
use App\FamilyAppointment;
use App\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FamilyAppointmentsDataTable extends DataTable
{
    protected string $printPreview = 'backend.admin.family-appointment.print';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        $statuses = Cache::remember('statuses-'.Auth::id(), 120, function () {
            return Status::where('model_type', 'App\FamilyAppointment')->select('id', 'title', 'color')->get();
        });
        return datatables()
            ->eloquent($query)
            ->editColumn('action', function ($appointment){})
            ->editColumn('type', function ($appointment) {
                return Appointment::APPOINTMENT_TYPES($appointment->type);
            })
            ->filterColumn('user', function ($query, $keywords){
                $query->where('email', 'like', "%$keywords%");
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\FamilyAppointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(FamilyAppointment $model)
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
                    ->addTableClass('table table-separate table-head-custom table-checkable datatable-head-custom table-head-bg datatable-head')
                    ->setTableId('familyappointmentsdatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(2)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('Reference')->data('appointment.reference'),
            Column::make('Appointment Details')->data('appointment'),
            Column::make('# of Members')->data('family.users_count'),
            Column::make('Type')->data('appointment.type'),
            Column::make('Family Creator')->data('user.profile.fullname'),
            Column::make('Email')->data('user.email'),
            Column::make('Cell Number')->data('user.profile.cell_number'),
            Column::make('Status')->data('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'FamilyAppointments_' . date('YmdHis');
    }
}
