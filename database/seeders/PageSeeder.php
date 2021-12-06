<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'Conclusion generator',
            'slug' => 'conclusion-generator',
            'template_id' => 1,
            'seo_title' => 'Free and Efficient Essay Conclusion Generator',
            'seo_description' => 'Do you have to write a conclusion for your paper? With our essay conclusion generator, it won\'t be a problem! Use it for free and enjoy quick results.',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
