<?php

namespace Database\Seeders;

use App\Models\Template;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $template_1 = Template::create([
            'title' => 'Conclusion generator',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $template_1->blocks()->attach([6, 5, 4, 3, 2, 8, 1]);

        $template_2 = Template::create([
            'title' => 'Paraphrasing Tool',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $template_2->blocks()->attach([7, 5, 4, 3, 2, 8, 1]);

        $template_3 = Template::create([
            'title' => 'Essay maker',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        $template_3->blocks()->attach([9, 5, 4, 3, 2, 8, 1]);
    }
}
