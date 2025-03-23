<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Comment::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos todos los artículos de la bdd
        $articles = Article::all();
        // Obtenemos todos los usuarios
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con cada uno
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Creamos un comentario para cada artículo con este usuario
            foreach ($articles as $article) {
                Comment::create([
                    'text' => $faker->paragraph,
                    'article_id' => $article->id,
                ]);
            }
        }
    }
}
