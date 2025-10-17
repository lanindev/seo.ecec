<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use App\Models\CaseType;
use App\Models\SeoSection;
use Illuminate\Http\Request;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = new \stdClass();
        $page->slug = "seo";

        $case_types = CaseType::where("name", "搜尋引擎優化")->get();

        $case_types_all = CaseType::get();

        $cases = CaseModel::with('caseType')->get();

        $sections = [
            'banner' => SeoSection::where('key', 'banner')->first(),
            'cases' => SeoSection::where('key', 'cases')->first(),
            'issues' => SeoSection::where('key', 'issues')->first(),
            'plans' => SeoSection::where('key', 'plans')->first(),
        ];

        return view('frontend.seo', compact('page', 'case_types', 'case_types_all', 'cases', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
