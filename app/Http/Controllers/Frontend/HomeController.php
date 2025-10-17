<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = new \stdClass();
        $page->slug = "home";
        
        $banner = HomeSection::where('key', 'banner')->first();
        $media = HomeSection::where('key', 'media')->first();
        $tech = HomeSection::where('key', 'tech_and_data')->first();
        $ourPhilosophy = HomeSection::where('key', 'our_philosophy')->first();
        $seo = HomeSection::where('key', 'seo')->first();

        return view('frontend.home', compact('page', 'banner', 'media', 'tech', 'ourPhilosophy', 'seo'));
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
