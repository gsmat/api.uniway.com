<?php

namespace App\Http\Controllers;

use App\Http\Requests\University\UniversityRequest;
use App\Models\University;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return void
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UniversityRequest $request
     * @return JsonResponse
     */
    public function store(UniversityRequest $request)
    {
        $validated = $request->validated();
        $university = University::create($validated);
        if (!$university){
            return response()->json([
                'err' => 'Error while inserting data to database'
            ]);
        }
        else{
            return response()->json([
               'university' => $university
            ]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return void
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
