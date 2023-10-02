<?php

namespace App\Http\Controllers;

use App\Models\subCategoryDetail;
use Illuminate\Http\Request;

class SubCategoryDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $subCategoryDetail = subCategoryDetail::with("subCategory")->where("subCategoryId", $id)->get();
        return response()->json([
            "message" => "List of sub category details",
            "data" => $subCategoryDetail
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subCategoryDetail  $subCategoryDetail
     * @return \Illuminate\Http\Response
     */
    public function show(subCategoryDetail $subCategoryDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subCategoryDetail  $subCategoryDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(subCategoryDetail $subCategoryDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subCategoryDetail  $subCategoryDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subCategoryDetail $subCategoryDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subCategoryDetail  $subCategoryDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(subCategoryDetail $subCategoryDetail)
    {
        //
    }
}
