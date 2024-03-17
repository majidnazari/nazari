<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use Illuminate\Http\Request;
use DataTables;

class ArticleController extends Controller
{
    public function datatable(Request $request)
    {
        if ($request->ajax()) {
            $data = Article::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editArticle">ویرایش</a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteArticle">حذف</a>';
 
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        // if ($request->ajax()) {
        //     $data = Article::with('category','tags')->get();

        //     return DataTables::of($data)
        //         ->addColumn('tags', function ($article) {
        //             $tagNames = $article->tags->pluck('name')->implode(', ');
        //             return $tagNames;
        //         })               
        //         ->make(true);
        // }

        return view('articles.index');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $articles=Article::where('id','>',0)->with(['category','tags'])->get();
       return $articles;
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
    public function store(StoreArticleRequest $request)
    {
        //dd( $request);
        $article= Article::updateOrCreate(['id' => $request->article_id],[
            'title' => $request->title,
             'des' => $request->des,
             'category_id'=>$request->category
            ]);

            $tags = $request->input('tags', []);

            // Associate the tags with the article
            $article->tags()->sync($tags);

        return response()->json(['success'=>'محصول با موفقیت ذخیره شد.']);
    }

    /**
     * Display the specified resource.
     */
    public function show( $article_id)
    { 
       // dd($article_id);
        $article = Article::with('tags')->find($article_id);
        return response()->json($article);
       // return view('your-view', ['article' => $article]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //dd($article);
        $product = Article::find($id);
        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($article_id)
    {
        $article=Article::find($article_id);
        $article->tags()->detach();
        $article->delete();
        return response()->json(['success'=>'محصول با موفقیت حذف شد.']);
    }
}
