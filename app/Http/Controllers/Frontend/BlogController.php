<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = new \stdClass();
        $page->slug = "blog";

        $breadcrumbs = [
            ['label' => '首頁', 'url' => route('home')],
            ['label' => __('frontend.blog'), 'url' => route('blog')],
        ];

        $query = $request->input('q');

        if ($query) {
            $breadcrumbs[] = [
                'label' => '搜尋結果',
                'url' => route("blog", ["q" => $query]),
            ];
        }

        $post_categories = PostCategory::get();
        $latest_articles = Post::with('category')
            ->latest('published_at')
            ->take(6)
            ->get();


        $articles = Post::with('category')
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%");
            })
            ->latest('published_at')
            ->paginate(4)
            ->appends(['q' => $query]);

        return view('frontend.blog', compact(
            'page',
            'breadcrumbs',
            'post_categories',
            'latest_articles',
            'articles',
            'query'
        ));
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
        $page->slug = "blog";

        $article = Post::with('category')->findOrFail($id);

        $breadcrumbs = [
            ['label' => '首頁', 'url' => route('home')],
            ['label' => __('frontend.blog'), 'url' => route('blog')],
            ['label' => $article->category->name, 'url' => route("blog_category", ["slug" => $article->category->slug])],
            ['label' => $article->title, 'url' => route("blog_id", ["id" => $article->id, "title" => $article->title])],
        ];

        $post_categories = PostCategory::get();

        $latest_articles = Post::with('category')
            ->latest('published_at')
            ->take(6)
            ->get();

        $previous_article = Post::where('category_id', $article->category_id)
            ->where('published_at', '<', $article->published_at)
            ->orderBy('published_at', 'desc')
            ->first();

        $next_article = Post::where('category_id', $article->category_id)
            ->where('published_at', '>', $article->published_at)
            ->orderBy('published_at', 'asc')
            ->first();

        return view('frontend.blog_id', compact(
            'page',
            'breadcrumbs',
            'post_categories',
            'article',
            'latest_articles',
            'previous_article', 'next_article'
        ));
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

    public function category($slug)
    {
        $page = new \stdClass();
        $page->slug = "blog";

        $current_category = PostCategory::where('slug', $slug)->first();

        $breadcrumbs = [
            ['label' => '首頁', 'url' => route('home')],
            ['label' => __('frontend.blog'), 'url' => route('blog')],
            ['label' => $current_category->name, 'url' => route("blog_category", ["slug" => $current_category->slug])],
        ];

        $post_categories = PostCategory::get();

        $latest_articles = Post::with('category')
            ->latest('published_at')
            ->take(6)
            ->get();

        $articles = Post::with('category')
            ->ofCategorySlug($slug)
            ->published()
            ->latest('published_at')
            ->paginate(4);


        return view('frontend.blog', compact(
            'page',
            'current_category',
            'breadcrumbs',
            'post_categories',
            'latest_articles',
            'articles',
        ));
    }
}
