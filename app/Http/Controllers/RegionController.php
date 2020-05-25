<?php

namespace App\Http\Controllers;

use App\Http\Requests\Region as FormRequest;
use App\Region;
use Symfony\Component\HttpFoundation\Response as HTTPResponse;

class RegionController extends Controller
{
    public function __construct()
    {

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.region.index')->with(['regions' => Region::all(), 'page_title' => 'Regions']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $provinces = Region::$provinces;
        return view('backend.region.create', ['provinces'=> $provinces, 'page_title' => 'Create a new Region']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param FormRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormRequest $request)
    {
        $region = Region::create($request->all());
        return response()->json(['url' => route('regions.index'), 'message' => "$region->name, details were saved successfully!"], HTTPResponse::HTTP_ACCEPTED);
    }

    /**
     * Display the specified resource.
     *
     * @param Region $region
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Region $region)
    {
        $page_title = "$region->name Details";
        return view('backend.region.show', compact('region', 'page_title'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Region $region
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Region $region)
    {
        $page_title = "$region->name";
        $page_description = "Edit Details";
        $provinces = Region::$provinces;
        return view('backend.region.edit', compact('region', 'page_title', 'page_description', 'provinces'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param FormRequest $request
     * @param Region $region
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(FormRequest $request, Region $region)
    {
        $region->update($request->all());
        return response()->json(['url' => route('regions.show', $region->id), 'message' => "$region->name, details were UPDATED successfully!"], HTTPResponse::HTTP_ACCEPTED);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Region $region
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Region $region)
    {
        $region->delete();

        return response()->json([
            "message"=> $region->name . ' was deleted successfully',
            "url" => route('regions.index')
        ], 200);
    }
}
