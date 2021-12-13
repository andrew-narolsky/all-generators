<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pages')->insert([
            [
                'title' => 'Conclusion generator',
                'slug' => 'conclusion-generator',
                'template_id' => 1,
                'seo_title' => 'Free and Efficient Essay Conclusion Generator',
                'count_votes' => 34,
                'stars' => 4,
                'seo_description' => 'Do you have to write a conclusion for your paper? With our essay conclusion generator, it won\'t be a problem! Use it for free and enjoy quick results.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'title' => 'Paraphrasing tool',
                'slug' => 'paraphrasing-tool',
                'template_id' => 2,
                'seo_title' => 'Free and Efficient Essay Paraphrasing tool',
                'count_votes' => 34,
                'stars' => 4,
                'seo_description' => 'Do you have to write a paraphrasing tool for your paper? With our essay paraphrasing tool, it won\'t be a problem! Use it for free and enjoy quick results.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
