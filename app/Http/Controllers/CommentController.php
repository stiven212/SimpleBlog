<?php

namespace App\Http\Controllers;

use App\Http\Resources\Comment as CommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    private  static $rules = [
        'text' => 'required|string'
    ];
    private static $messages = [
        'required' => 'El campo :attribute es obligatorio.'
    ];

    public function index(Article $article)
    {
        return response()->json(CommentResource::collection($article->comments));
    }
    public function show(Article $article, Comment $comment)
    {
        $comment = $article->comments()->where('id',$comment->id)->firstOrFail();
        return response()->json($comment, 200);
    }
    public function store(Request $request, Article $article)
    {
        $request->validate(self::$rules, self::$messages);

        $comment = $article->comments()->save(new Comment($request->all()));
        return response()->json($comment, 201);
    }
    public function update(Request $request, Article $article, Comment $comment)
    {
        $request->validate(self::$rules, self::$messages);
        $comment = $article->comments()->where('id',$comment->id)->firstOrFail();
        $comment->update($request->all());

        return response()->json($comment, 201);
    }
    public function delete(Article $article, Comment $comment)
    {
        $comment = $article->comments()->where('id',$comment->id)->firstOrFail();

        $comment->delete();
        return response()->json(null, 204);

    }
}
