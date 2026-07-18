<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\View\View;
class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $newses = News::latest()->get();
        return view('admin.pages.news.list', compact('newses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.news.create');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.pages.news.edit', compact('news'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate(News::getRules());
            if($request->image){
                $imageName = saveImage($request->file('image'), 'news');
                $validatedData['image'] = $imageName;
            }
            $news = News::create($validatedData);
            session()->flash('success', 'News successfully added!');
            return redirect()->route('news.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        try {
            $validatedData = $request->validate(News::getRules($news->id));
            // Update the existing news item with the validated data
            if($request->image){
                $imageName = saveImage($request->file('image'), 'news');
                $validatedData['image'] = $imageName;
            }
            $news->update($validatedData);

            session()->flash('success', 'News successfully updated!');
            return redirect()->route('news.index');

        } catch (\Illuminate\Validation\ValidationException $e) {
            $firstError = $e->validator->errors()->first();
            return redirect()->back()->with('error', $firstError)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        $news->delete();
        session()->flash('success', 'News deleted successfully!');
        return redirect()->route('news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function changeStatus(News $news)
    {
        $news->status = $news->status === 'draft' ? 'published' : 'draft';
        $news->save();

        session()->flash('success', 'Status updated!');
        return redirect()->route('news.index');
    }

    public function latestNews(): View
    {
        $newses = News::orderBy('id', 'desc')->get();
        return view('website.news.latest', compact('newses'));
    }

    public function single(string $slug): View
    {
        $news = News::where('slug', $slug)->firstOrFail();
        $latestNews = News::where('id', '!=', $news->id)->orderBy('id', 'desc')->take(2)->get();
        return view('website.news.single', compact('news', 'latestNews'));
    }

    public function newsCoverage(): View
    {
        return view('website.news.news-coverage');
    }

}
