<?php

namespace App\Http\Controllers;

use App\Http\Requests\Filter\FilterRequest;
use App\Http\Requests\Specialization\SpecializationRequest;
use App\Models\Specialization;
use App\Models\University;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpecializationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param FilterRequest $request
     * @return JsonResponse
     */
    public function index(FilterRequest $request)
    {
        $validated = $request->validated();
        $specializations = Specialization::select('name', 'point', 'is_special', 'university_id', 'is_paid', 'group');


        if (isset($validated['point'])) {
            $validated['point'] = (int)$validated['point'];
            $specializations->where('point', '<=', $validated['point'] + 30)
                ->where('point', '>=', $validated['point'] - 30);
        }
        if (isset($validated['is_special'])) {
            $validated['is_special'] = (int)$validated['is_special'];
            $specializations->where('is_special', $validated['is_special']);
        }
        if (isset($validated['is_paid'])) {
            $validated['is_paid'] = (int)$validated['is_paid'];
            $specializations->where('is_paid', $validated['is_paid']);
        }
        if (isset($validated['group'])) {
            $validated['group'] = (int)$validated['group'];
            $specializations->where('group', $validated['group']);
        }
        if (isset($validated['university'])) {
            $uni = University::where(
                'name', 'like', "%{$validated['university']}%"
            )->first();
            $specializations->where('university_id', $uni->id);
        }
        $unique = [];

        foreach ($specializations->get()->toArray() as $k => $university) {
            $uniId = $university['university_id'];
            $unique[] = University::select('id', 'name')->find($uniId);

        }
        $universities = array_unique($unique);
        if (empty($universities)){
            return response()->json([
                'msg' => 'not found'
            ]);
        }

        return response()->json([
            'specializations' => $specializations->get(),
            'universities' => $universities
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param SpecializationRequest $request
     * @return JsonResponse
     */
    public function store(SpecializationRequest $request)
    {
        $validated = $request->validated();
        $validated['university_id'] = (int)$validated['university_id'];
        $validated['is_special'] = (int)$validated['is_special'];
        $validated['is_paid'] = (int)$validated['is_paid'];
        $validated['point'] = (int)$validated['point'];
        $validated['group'] = (int)$validated['group'];
        $name = $validated['name'];
        $uniId = University::find($validated['university_id']);
        if (!$uniId) {
            return response()->json([
                'err' => 'University Not found'
            ], 404);
        } else {
            $specialization = Specialization::create($validated);
            if (!$specialization) {
                return response()->json([
                    'err' => 'Error while inserting data to database'
                ], 500);
            } else {
                return response()->json([
                    'specialization' => $specialization
                ], 200);
            }
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
     * @param int $id
     * @return void
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     */
    public function destroy(int $id)
    {
        //
    }
}
