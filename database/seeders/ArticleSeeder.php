<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate to start fresh or just add? User might have data.
        // Let's just create new ones.

        $admin = User::first(); // Assumes at least one user exists
        $authorId = $admin ? $admin->id : 1;

        $faker = \Faker\Factory::create('id_ID');

        $categories = ['Berita', 'Prestasi', 'Kegiatan', 'Pengumuman', 'Artikel', 'Teknologi'];

        foreach (range(1, 25) as $index) {
            $title = $faker->realText(60);
            // realText creates more realistic titles than sentence

            Article::create([
                'title' => $title,
                'slug' => Str::slug($title).'-'.Str::random(5),
                'content' => '<p>'.implode('</p><p>', $faker->paragraphs(5)).'</p>',
                'status' => 'published',
                'category' => $faker->randomElement($categories),
                'published_at' => Carbon::now()->subHours($index * 2),
                'author_id' => $authorId,
                'image' => null,
            ]);
        }
    }
}
