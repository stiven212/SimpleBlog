<?php

namespace App\Http\Controllers;

use App\Http\Resources\Article as ArticleResource;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    private  static $rules = [
        'title' => 'required|string|unique:articles,title|max:255',
        'body' => 'required',
    ];
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.',
        'body.required' => 'El body no es valido.',
    ];

    public function index()
    {
        return new ArticleCollection(Article::paginate());
    }
    public function show(Article $article)
    {
        return response()->json(new ArticleResource($article));
    }
    public function store(Request $request)
    {
//        $request->validate(self::$rules, self::$messages);
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|unique:articles|max:255',
            'body' => 'required|string'
        ],self::$messages);

//        if ($validator->fails()) {
//            return response()->json(['error' => 'data_validation_failed',
//                "error_list"=>$validator->errors()], 400);
//        }

        $article = Article::create($request->all());
        return response()->json($article, 201);
    }
    public function update(Request $request, Article $article)
    {
        $article->update($request->all());
        return response()->json($article, 201);
    }
    public function delete(Article $article)
    {
        $article->delete();
        return response()->json(null, 204);

    }
}
