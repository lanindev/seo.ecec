<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CaseModel;
use App\Models\CaseShowcase;
use App\Models\CaseType;
use Illuminate\Http\Request;

class CasesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = new \stdClass();
        $page->slug = "cases";

        $case_types = CaseType::has('cases')->get();

        $case_types->prepend((object)[
            'id' => 0,
            'name' => '全部',
        ]);

        $case_types_all = CaseType::get();

        $cases = CaseModel::with('caseType')->get();

        $case_showcases = CaseShowcase::get();

        return view('frontend.cases', compact('page', 'case_types', 'case_types_all', 'cases', 'case_showcases'));
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
    public function show($id, $title)
    {
        $page = new \stdClass();
        $page->slug = "cases";

        $case = CaseModel::findOrFail($id);

        if ($title !== $case->title) {
            return redirect()->route('case', [
                'id' => $case->id,
                'title' => $case->title,
            ]);
        }

        $relatedCases = CaseModel::where('case_type_id', $case->case_type_id)
            ->where('id', '!=', $case->id)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.case', compact('page', 'case', 'relatedCases'));
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
