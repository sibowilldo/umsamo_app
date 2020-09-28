<?php

namespace App\DataTables;

use App\Appointment;
use App\EventDate;
use App\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AppointmentsDataTable extends DataTable
{
    protected $printPreview = 'backend.admin.appointment.print';
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
//        'familyAppointments', 'familyAppointments.user', 'familyAppointments.status:id,title,color'
        $query = $query->where('appointmentable_type','App\User');
        $statuses = Cache::remember('appointment_statuses-'.Auth::id(), 120, function () {
            return Status::where('model_type', 'App\Appointment')->select('id', 'title', 'color')->get();
        });
        return datatables()
            ->eloquent($query)
            ->editColumn('type', function ($appointment) {
                return Appointment::APPOINTMENT_TYPES($appointment->type);
            })
            ->editColumn('status_id', function ($appointment) use ($statuses){
                return ['title' => $appointment->status->title, 'statuses' => $statuses];
            })
            ->addColumn('action', function ($appointment){

            })
            ->filterColumn('appointmentable.email', function ($query, $keywords){
                $query->whereHasMorph('appointmentable','App\User', function (Builder $builder) use ($keywords){
                    return $builder->where('email', 'like',  "$keywords");
                });
            })
            ->filterColumn('event_date.date_time', function ($query, $keywords){
                $event_dates = [];
                $date_range = array_filter(explode('|', $keywords));
                switch (sizeof($date_range)){
                    case 1:
                        $event_dates = EventDate::whereDate('date_time',$date_range[0])->select('id');
                        break;
                    case 2:
                        $event_dates = EventDate::whereBetween('date_time',$date_range)->select('id');
                        break;
                }
                $query->whereIn('event_date_id', $event_dates);
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Appointment $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Appointment $model)
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
                    ->setTableId('appointments-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Brtip')
                    ->orderBy(1)
                    ->buttons(
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
            Column::make('reference'),
            Column::make('event_date.date_time')->title('Scheduled For'),
            Column::make('type'),
            Column::make('Status')->printable(true)->data('status.title'),
            Column::make('appointmentable.profile.fullname')->title('Full Name'),
            Column::make('ID No')->data('appointmentable.profile.id_number')->title('ID No.'),
            Column::make('appointmentable.email')->title('Email'),
            Column::make('Cell No.')->data('appointmentable.profile.cell_number')->title('Cell No.'),
            Column::computed('action')
            ->exportable(false)
            ->printable(false)
            ->width(60)
            ->addClass('text-right'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Appointments_' . date('YmdHis');
    }
}
