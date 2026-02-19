<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $articles = [
            [
                'title' => 'Welcome to Admin Panel',
                'excerpt' => 'Intro singkat admin panel.',
                'content' => 'Ini adalah artikel pertama untuk admin panel.',
                'status' => 'published',
            ],
            [
                'title' => 'How to Manage Products',
                'excerpt' => 'Panduan mengelola produk.',
                'content' => 'Langkah-langkah mengelola produk di admin.',
                'status' => 'published',
            ],
            [
                'title' => 'Article Management Guide',
                'excerpt' => 'Cara mengelola artikel.',
                'content' => 'Panduan CRUD artikel di dashboard admin.',
                'status' => 'draft',
            ],
            [
                'title' => 'Content Writing Tips',
                'excerpt' => 'Tips menulis konten.',
                'content' => 'Beberapa tips menulis konten yang baik.',
                'status' => 'published',
            ],
            [
                'title' => 'Admin Best Practices',
                'excerpt' => 'Best practice admin.',
                'content' => 'Best practice dalam mengelola admin panel.',
                'status' => 'draft',
            ],
        ];

        foreach ($articles as $item) {
            Article::create([
                'title' => $item['title'],
                'slug' => Str::slug($item['title']),
                'excerpt' => $item['excerpt'],
                'content' => $item['content'],
                'status' => $item['status'],
            ]);
        }
    }
}
