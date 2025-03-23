<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vaciar la tabla.
        Article::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear artículos en su nombre
        $users = User::all();
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos algunos articulos
            $num_articles = 5;
            for ($j = 0; $j < $num_articles; $j++) {
                Article::create([
                    'title' => $faker->sentence,
                    'body' => $faker->paragraph,
                ]);
            }
        }
    }
}
