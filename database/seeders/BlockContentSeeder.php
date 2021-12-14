<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BlockContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('block_contents')->insert([
            // Conclusion generator
            [
                'text' => serialize([
                    'title' => 'Complete Your Paper in Just <span>4 Easy Steps</span> Using Our <span>Conclusion Generator</span>',
                    'step_1' => 'Copy and paste your title and text in the relative fields',
                    'step_2' => 'Choose the word count for the summary',
                    'step_3' => 'Click the "Generate My Conclusion',
                    'step_4' => 'Enjoy the result!',
                    'input_placeholder' => 'Type/paste your title here',
                    'textarea_placeholder' => 'Type/paste your text here (minimum 200 words required)',
                    'tooltip' => 'How long should your summary be?',
                ]),
                'block_id' => 6,
                'block_template_id' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Ratting
            [
                'text' => serialize([
                    'title' => 'How Helpful It Was?',
                ]),
                'block_id' => 5,
                'block_template_id' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Information banner
            [
                'text' => serialize([
                    'title' => 'How Can We Make a Perfect Academic Match?',
                    'sub_title_1' => 'Your Unfinished Paper',
                    'text_1' => 'You have your unfinished paper and cannot put all things together.',
                    'sub_title_2' => 'Our Expert Editors and Writers',
                    'text_2' => 'We have expert editors who can polish everything up or write a new one from scratch.',
                ]),
                'block_id' => 4,
                'block_template_id' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Price banner
            [
                'text' => serialize([
                    'excerpt' => 'EQUALS',
                    'content' => 'Your perfectly edited piece of writing starting at: <span>$ <span>8</span>.99 <span class="per-page">per page</span></span>',
                    'button_link' => 'https://www.google.com/',
                    'button_text' => 'Edit My Paper'
                ]),
                'block_id' => 3,
                'block_template_id' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Text block
            [
                'text' => serialize([
                    'title' => 'Text About Conclusion Generator and Benefits',
                    'content' => '<h2>Essay Service That Cares</h2><p>There are many student services on the market that deliver similar academic assistance. The question is, are all of them credible enough. At Grab My Essay.com every customer gets more than fulfillment of write my essay for me request. Consider us as your personal writing consultant that is ready to help you and save your grades 24/7. Every team member is your friend, adviser, and friend who indeed cares about your college performance.</p><h3>Two General APA Concepts</h3><ol><li>Firstly, an APA style paper can be used for scientific research papers in order to present an existing and proven theory. This means that the paper must be written using present perfect or past tense when quoting and citing sources.</li><li>Secondly, an APA format research paper prioritizes the year of the publication. It should always be featured after each name sourced in the paper.</li></ol><p>For example:<br />&ldquo;Harrison (1997) posited that women were programmed to nurture their young.&rdquo;</p><p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p><p>While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use&nbsp;<a href="http://localhost/conclusion-generator#">EdTech</a>&nbsp;tools. With their help, you&#39;ll research information faster and process it easier. They also can help you memorize the APA formatting rules.</p><p>The APA Style can be used for different types of papers, such as essays, theses, dissertations, etc. You can also use these for&nbsp;<a href="http://localhost/conclusion-generator#">argumentative research paper topics</a>, expository essays for minor subjects and any more. Once you get used to this style of writing, you won&rsquo;t have to refer back to the style guides as much.</p><h2>What is the APA Style?</h2><p>The American Psychological Association or APA research format is a writing method recommended by the aforementioned organization. This is usually used in social science subjects and is written using two general concepts.</p><h3>Practical Rules for of the Research Paper</h3><p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p><p>While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you&#39;ll research information faster and process it easier. They also can help you memorize the APA formatting rules.</p><p>The APA Style can be used for different types of papers, such as essays, theses, dissertations, etc. You can also use these for argumentative research paper topics, expository essays for minor subjects and any more. Once you get used to this style of writing, you won&rsquo;t have to refer back to the style guides as much.</p><h3>Basic Writing Rules for APA Style</h3><p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p><p>While all this information may seem like a lot, in fact, it offers a rigid framework that your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you&#39;ll research information faster and process it easier.</p>',
                ]),
                'block_id' => 2,
                'block_template_id' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Banner
            [
                'text' => serialize([
                    'title' => 'Need Professional Editing Services?',
                    'content' => '<p>Maecenas a hendrerit diam. Etiam vulputate lacinia turpis ac lacinia. Nam auctor libero eu viverra eleifend. Donec non imperdiet erat, sit amet interdum l</p>',
                    'button_link' => 'https://www.google.com/',
                    'button_text' => 'Edit My Paper'
                ]),
                'block_id' => 1,
                'block_template_id' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Paraphrasing tool
            [
                'text' => serialize([
                    'title' => 'Complete Your Paper in Just <span>4 Easy Steps</span> Using Our <span>Paraphrasing Tool</span>',
                    'step_1' => 'Paste the text or upload the file you would like to reword.',
                    'step_2' => 'Choose mode: Simple, Advanced or Automatic rewording and click the "Paraphrase" button.',
                    'step_3' => 'Select synonyms for each of the highlighted words from the list offered or suggest your own.',
                    'step_4' => 'Click the "Rephrase" button. Copy the final text or download it. That\'s it!',
                    'input_placeholder' => 'add words that you want to exclude, comma separated (,)',
                    'textarea_placeholder' => 'Paste your text here',
                ]),
                'block_id' => 7,
                'block_template_id' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Ratting
            [
                'text' => serialize([
                    'title' => 'How Helpful It Was?',
                ]),
                'block_id' => 5,
                'block_template_id' => 9,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Information banner
            [
                'text' => serialize([
                    'title' => 'How Can We Make a Perfect Academic Match?',
                    'sub_title_1' => 'Your Unfinished Paper',
                    'text_1' => 'You have your unfinished paper and cannot put all things together.',
                    'sub_title_2' => 'Our Expert Editors and Writers',
                    'text_2' => 'We have expert editors who can polish everything up or write a new one from scratch.',
                ]),
                'block_id' => 4,
                'block_template_id' => 10,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Price banner
            [
                'text' => serialize([
                    'excerpt' => 'EQUALS',
                    'content' => 'Your perfectly edited piece of writing starting at: <span>$ <span>8</span>.99 <span class="per-page">per page</span></span>',
                    'button_link' => 'https://www.google.com/',
                    'button_text' => 'Edit My Paper'
                ]),
                'block_id' => 3,
                'block_template_id' => 11,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Text block
            [
                'text' => serialize([
                    'title' => 'Text About Conclusion Generator and Benefits',
                    'content' => '<h2>Essay Service That Cares</h2><p>There are many student services on the market that deliver similar academic assistance. The question is, are all of them credible enough. At Grab My Essay.com every customer gets more than fulfillment of write my essay for me request. Consider us as your personal writing consultant that is ready to help you and save your grades 24/7. Every team member is your friend, adviser, and friend who indeed cares about your college performance.</p><h3>Two General APA Concepts</h3><ol><li>Firstly, an APA style paper can be used for scientific research papers in order to present an existing and proven theory. This means that the paper must be written using present perfect or past tense when quoting and citing sources.</li><li>Secondly, an APA format research paper prioritizes the year of the publication. It should always be featured after each name sourced in the paper.</li></ol><p>For example:<br />&ldquo;Harrison (1997) posited that women were programmed to nurture their young.&rdquo;</p><p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p><p>While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use&nbsp;<a href="http://localhost/conclusion-generator#">EdTech</a>&nbsp;tools. With their help, you&#39;ll research information faster and process it easier. They also can help you memorize the APA formatting rules.</p><p>The APA Style can be used for different types of papers, such as essays, theses, dissertations, etc. You can also use these for&nbsp;<a href="http://localhost/conclusion-generator#">argumentative research paper topics</a>, expository essays for minor subjects and any more. Once you get used to this style of writing, you won&rsquo;t have to refer back to the style guides as much.</p><h2>What is the APA Style?</h2><p>The American Psychological Association or APA research format is a writing method recommended by the aforementioned organization. This is usually used in social science subjects and is written using two general concepts.</p><h3>Practical Rules for of the Research Paper</h3><p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p><p>While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you&#39;ll research information faster and process it easier. They also can help you memorize the APA formatting rules.</p><p>The APA Style can be used for different types of papers, such as essays, theses, dissertations, etc. You can also use these for argumentative research paper topics, expository essays for minor subjects and any more. Once you get used to this style of writing, you won&rsquo;t have to refer back to the style guides as much.</p><h3>Basic Writing Rules for APA Style</h3><p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p><p>While all this information may seem like a lot, in fact, it offers a rigid framework that your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you&#39;ll research information faster and process it easier.</p>',
                ]),
                'block_id' => 2,
                'block_template_id' => 12,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Banner
            [
                'text' => serialize([
                    'title' => 'Need Professional Editing Services?',
                    'content' => '<p>Maecenas a hendrerit diam. Etiam vulputate lacinia turpis ac lacinia. Nam auctor libero eu viverra eleifend. Donec non imperdiet erat, sit amet interdum l</p>',
                    'button_link' => 'https://www.google.com/',
                    'button_text' => 'Edit My Paper'
                ]),
                'block_id' => 1,
                'block_template_id' => 14,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
