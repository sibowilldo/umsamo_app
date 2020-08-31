<?php

namespace App\Http\Controllers\Administrator;

use App\FamilyAppointment;
use App\Http\Controllers\Controller;
use App\DataTables\AppointmentsDataTable;
use App\DataTables\FamilyAppointmentsDataTable;
use App\Status;
use Illuminate\Http\Request;

class FamilyAppointmentsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:kingpin|administrator']);
    }

    /**
     * @param FamilyAppointmentsDataTable $dataTable
     * @return mixed
     */
    public function index(FamilyAppointmentsDataTable $dataTable)
    {
        $page_title = "Family Appointments";
        $statuses = Status::where('model_type', 'App\FamilyAppointment')->select(['title', 'id'])->get();
        return $dataTable->render('backend.admin.family-appointment.index', compact('page_title', 'statuses'));
    }

}
