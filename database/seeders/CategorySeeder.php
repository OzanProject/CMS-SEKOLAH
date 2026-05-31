<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $categories = ['Berita', 'Prestasi', 'Agenda', 'Artikel', 'Pengumuman', 'Teknologi'];

        foreach ($categories as $cat) {
            $category = Category::firstOrCreate(
                ['name' => $cat],
                ['slug' => Str::slug($cat)]
            );

            // Backfill existing articles using the string column
            Article::where('category', $cat)->update(['category_id' => $category->id]);
        }
    }
}
