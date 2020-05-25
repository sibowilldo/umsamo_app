<?php

namespace App\Http\Controllers;

use App\Http\Requests\Status as StatusFormRequest;
use App\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class StatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $statuses = Cache::remember('statuses',1000, function () {
            return Status::all('id', 'title', 'description', 'model_type', 'is_active', 'color');
        });
        $model_types = Status::$model_types;
        $page_title = "Statuses";
        return view('backend.status.index', compact('statuses', 'model_types', 'page_title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $model_types = Status::$model_types;
        $page_title = "Create Status";
        return view('backend.status.create', compact('model_types', 'page_title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StatusFormRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StatusFormRequest $request)
    {
        if(Status::statusExists($request->title, $request->model_type)){
            return response()->json(['title' => "Status Already Exists", 'message' => "Sorry, a status with the same Title and Model Type already exists.", 'code' => 409], HTTPResponse::HTTP_CONFLICT);
        }

        $status = Status::create($request->all());
        return response()->json(['url' => route('statuses.index'), 'message' => "$status->title, details were saved successfully!"], HTTPResponse::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param Status $status
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Status $status)
    {
        $page_title = "$status->title Details";
        $model_types = Status::$model_types;
        return view('backend.status.show', compact('status', 'model_types', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Status $status
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Status $status)
    {
        $page_title = "$status->title";
        $page_description = "Edit Details";
        $model_types = Status::$model_types;
        return view('backend.status.edit', compact('status', 'page_title', 'page_description', 'model_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StatusFormRequest $request
     * @param Status $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StatusFormRequest $request, Status $status)
    {
        $statusExists = Status::statusExists($request->title, $request->model_type);

        if($statusExists && $statusExists->id !=$status->id){
            return response()->json(['title' => "Status Already Exists", 'message' => "Sorry, a status with the same Title and Model Type already exists.", 'code' => 409], HTTPResponse::HTTP_CONFLICT);
        }

        $status->update($request->all());
        return response()->json(['url' => route('statuses.show', $status->id), 'message' => "$status->title, details were UPDATED successfully!"], HTTPResponse::HTTP_ACCEPTED);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Status $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Status $status)
    {
        $status->delete();

        return response()->json([
            "message"=> $status->title . ' was deleted successfully',
            "url" => route('statuses.index')
        ], 200);
    }
}
