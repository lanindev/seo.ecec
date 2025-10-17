<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CaseType;
use App\Models\MediaArticle;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page = new \stdClass();
        $page->slug = "news";

        $case_types_all = CaseType::get();

        $media_articles = MediaArticle::get();

        return view('frontend.news', compact('page', 'case_types_all', 'media_articles'));
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
        $page->slug = "news";

        $media_article = MediaArticle::findOrFail($id);

        if ($title !== $media_article->title) {
            return redirect()->route('news_id', [
                'id' => $media_article->id,
                'title' => $media_article->title,
            ]);
        }

        $related_articles = MediaArticle::where('id', '!=', $media_article->id)
            ->latest()
            ->take(6)
            ->get();

        return view('frontend.news_id', compact('page', 'media_article', 'related_articles'));
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
