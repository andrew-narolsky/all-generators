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
                    'title' => '<span>Conclusion Generator</span>:Create Your Perfect Paper Summary  In<span>4 Easy Steps</span>',
                    'step_1' => 'Copy and paste your title and text in correspondent fields',
                    'step_2' => 'Choose the word count for the summary',
                    'step_3' => 'Click the "Generate My Conclusion" button',
                    'step_4' => 'Enjoy the result!',
                    'input_placeholder' => 'Type/paste your title here',
                    'textarea_placeholder' => 'Insert your text here (200 words minimum)',
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
                    'text_1' => 'You have your draft and don’t know how to put all things together.',
                    'sub_title_2' => 'Our Expert Editors and Writers',
                    'text_2' => 'We have specialists who can polish everything up or write a new paper from scratch.',
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
                    'content' => 'Your perfectly edited piece of writing, starting at: <span>$ <span>8</span>.99 <span class="per-page">per page</span></span>',
                    'button_link' => 'https://www.grabmyessay.com/order?service=5&assignment_type=1&words=275&coupon=GME15OFF&academic_level=1&urgency=1',
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
                    'title' => 'Conclusion Generator: Final Stroke Your Essay Needs',
                    'content' => '<p>Over the years, people came up with lots of useful academic tools, and conclusion generator is a definite leader. Students usually focus on essay body, they rarely give much thought to the last paragraph. As a result, their conclusion is often weak, short, and it ruins the overall positive impression of a reader. GrabMyEssay offers you two options: there is a free automatic tool and professional human help. Both have advantages and weaknesses. We&rsquo;ll discuss them and leave the choice to you. The important fact is, finishing your paper will be easier.</p>

                        <h2>Reasons to Try Essay Conclusion Generator</h2>

                        <p>Students typically order <a href="https://www.grabmyessay.com/term-paper-writing-service">term paper writing service</a> when they don&rsquo;t feel up to writing. Many prefer to do their homework on their own, but they aren&rsquo;t always successful. Conclusion is a major problem because most people just don&rsquo;t take it seriously. After anonymous questioning of more than a hundred students, we found out that more than 72% never considered the last paragraph relevant. They thought it was just a rehash of what they already wrote, so they added a couple of sentences and called it a day. But in reality, conclusion can bring you 10% of your overall grade &mdash; or it can take these 10% away. It&rsquo;s frustrating to know that you wrote an excellent paper with great research only to lose points for weak conclusions. Laziness, tiredness, and ignorance are three main reasons for why students struggle with writing it.</p>

                        <p>Conclusion paragraph writer can make a difference. This is a way for clients to get something or someone to summarize their work without any effort. Online tools could make an automatic scanning of their text and generate a conclusion on its basis. It would take just a minute, usually less, especially if they pick a good platform with well-developed technology. Similarly, you could get a human summarizer who would do the same, but in a much more efficient manner. They would read what you wrote and come up with the logical, interesting closing part, leaving readers with positive thoughts about your essay as a whole. This kind of assistance is quick and either free or cheap. More and more students use it as a life hack to get top results in the shortest amount of time.</p>

                        <h2>Pros &amp; Cons of Using Conclusion Paragraph Generator</h2>

                        <p>Whether you need <a href="https://www.grabmyessay.com/essay-maker">essay maker</a> or conclusion creator, you will have two options to choose from. Both options have different features, so students should decide which one suits them better.</p>

                        <p>First, let&rsquo;s look at automatic generator:</p>

                        <h3>Strengths</h3>

                        <ul>
                            <li>It is free. This is the biggest advantage of an automatic conclusion sentence generator. You don&rsquo;t have to pay anything for it: find an effective option &amp; use it. There might be other perks there, like <a href="https://www.grabmyessay.com/plagiarism-fixer">plagiarism fixer</a> or grammar checker. You might have to pay extra for some of them, but in most cases, the conclusion builder itself never costs a cent.</li>
                            <li>It&rsquo;s the fastest tool. An automatic conclusion maker could give you results within a few seconds. Even if your situation is urgent and you need to compose your last paragraph right here, right now, you have this option: just paste your paper into an online box &amp; you&rsquo;ll have instant results.</li>
                            <li>You could shift between several variants. If you read a conclusion your tool created and didn&rsquo;t like it, try another platform. There are many available options. You could keep generating various concluding parts until you find the one you like most. Flexibility is great for a student, especially when they don&rsquo;t have to pay for anything.</li>
                        </ul>

                        <h3>Weaknesses</h3>

                        <ul>
                            <li>It&rsquo;s blind to context. Any online concluding sentence generator is a machine, and you have to understand that machines aren&rsquo;t ideal. Some of them select paragraphs better than others, but they could still do it in the wrong way. For example, you might see that your generated conclusion starts with a random phrase. At times, conclusions could be wholly illogical, with a mix of phrases that don&rsquo;t work together at all. You&rsquo;d have to read every variant &amp; decide how acceptable it is before you use it in a real essay.</li>
                            <li>Text is copy-pasted. Another issue with essay conclusion maker is the fact that it takes sentences from your own text. If you&rsquo;ve been studying at college long enough, you probably know that it&rsquo;s a big mistake. Yes, the conclusion should restate your previous points and it shouldn&rsquo;t have any new information, but it doesn&rsquo;t mean that you could fill it with reused sentences. You could rephrase them or add something new &mdash; direct copy-paste is not acceptable. It means when relying on an automatic generator, use provided ideas and do some rewording as well.</li>
                            <li>It might break academic rules. This drawback is closely related to the second one. The online conclusion tool doesn&rsquo;t understand academic demands. There are different rules that control essay writing, and students should follow them carefully. A few examples: the last paragraph shouldn&rsquo;t have direct quotes; it must repeat the thesis in different words; it needs to address all major points you described in the body. The generator doesn&rsquo;t have this information. It might fail to take all rules into consideration, just be careful and attentive.</li>
                        </ul>

                        <p>Now it is time to count pros &amp; cons of human concluding provider, specifically the one we offer.</p>

                        <h2>Strengths</h2>

                        <ul>
                            <li>Personal approach. Human conclusion paragraph maker is a person who studies your text and creates a customized closing part for it. They won&rsquo;t make mistakes that automatic free generator does. You&rsquo;ll get a perfect paragraph that restates your thesis, mentions every relevant key point, and presents parting words that will stay in the minds of readers for a long time.</li>
                            <li>Quick assistance. While humans cannot produce results instantly, our company work&nbsp;in a quick way. We could complete a project in under 3 hours &mdash; writing conclusion doesn&rsquo;t take long. If you need it urgently, we could do it.</li>
                            <li>Cheap prices. Our service doesn&rsquo;t cost much. The minimal price for one complete page is only $14.99. Obviously, it means that conclusion alone costs even less. We have discounts, too &mdash; they&rsquo;ll make your price even smaller.</li>
                            <li>Guaranteed quality. Human conclusion writer represents our whole service. They fall under our policies and are bound to offer 100% quality. If they fail, clients have a right to revision as well as refunds. This protects your interests and solidifies the fact that you&rsquo;ll be satisfied with our work.</li>
                        </ul>

                        <h2>Weaknesses</h2>

                        <ul>
                            <li>Paid version. While we offer low prices coupled with good discounts, it&rsquo;s still a paid service. Not every student feels ready to do that.</li>
                        </ul>

                        <p>Both options of conclusion creators have their strong and weak sides. We listed as many major points as possible to help you make an informed decision. But before that, there are still more things to discuss.</p>

                        <h2>Principles of Work: How to Use Conclusion Maker</h2>

                        <p>Another positive side of both generators is that it is very easy to use. For online tools, simply visit the website you chose and insert text from your paper there. Most generators will offer several choices as to the size of conclusion. We recommend settling on 10%. Then click &ldquo;generate&rdquo; and your last part could be ready within a minute, probably less than that. Read it and try again in case this version doesn&rsquo;t make enough sense.</p>

                        <p>As for human conclusion typer, placing an order with our company is equally simple. You can see the order form on our website&rsquo;s front page. Put details about your assignment there. We made everything very intuitive that it won&rsquo;t take you longer than a couple of minutes. If you can&rsquo;t see what you want in particular, you could always chat with our operators. They stay online 24/7 to help clients with any questions or issues. Contact them and they could help you place an order.</p>

                        <h2>More Options You Could Get by Cooperating With Us</h2>

                        <p>Human conclusion sentence maker isn&rsquo;t the only thing our team offers. We have <a href="https://www.grabmyessay.com/scholarship-essay-writing-service">professional scholarship writers</a> and research paper specialists who could craft an essay or its part. If you want the last section, great! If you need an intro or body, we could do them as well. Our service has diversity and flexibility you won&rsquo;t find among online tools. We provide editing and proofreading as well. For instance, if a client finished their paper by themselves but they don&rsquo;t think everything looks as good as they hoped, hiring us could soothe their concerns. Our experts would read their essays and make necessary corrections.<br />
                        &nbsp;<br />
                        The fact that we don&rsquo;t offer conclusion generator free version, doesn&rsquo;t mean we have nothing else to propose to our customers for no price. You could find samples on our website on various academic topics. Try any of them that fit your request. They are all completely free, and you could order them to be delivered to your email. Take ideas from them, use them as inspiration, or just rely on them as a guide throughout your academic journey. We plan on expanding our lucrative offers for students. Stay tuned and watch for updates.</p>

                        <h2>Get Help with Your Conclusion and Ease Your Writing</h2>

                        <p>Using concluding paragraph maker is the best solution for students who feel fed up with their homework and want to be done with it as soon as possible. Get in contact with us any time you need and explain what you&rsquo;d like us to do. Our team will craft a unique closing paragraph for you no matter how complex your topic is!<br />
                        &nbsp;</p>'
                ]),
                'block_id' => 2,
                'block_template_id' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // FAQ
            [
                'text' => serialize([
                    'title' => 'Frequently Asked Questions',
                    'subtitle' => '',
                    'faq' => [
                        1 => [
                            'question' => 'How do you write a good conclusion?',
                            'answer' => '<p>By knowing academic rules and following them. The conclusion is a 10%-long essay part that has to restate major findings from your paper. It should be original yet concise.</p>'
                        ],
                        2 => [
                            'question' => 'What is a conclusion generator?',
                            'answer' => '<p>Concluding paragraph generator is a tool or an expert who could produce conclusion on the basis of the text you wrote. This could be automatic or customized work: the decision is up to you.</p>'
                            ],
                        3 => [
                            'question' => 'What is the best free conclusion generator?',
                            'answer' => '<p>Among free generators, we could recommend Summarizing-Tool. It is as effective as an online machine could be. But of course, human help still has better quality.</p>'
                        ]
                    ]
                ]),
                'block_id' => 8,
                'block_template_id' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            // Banner
            [
                'text' => serialize([
                    'title' => 'Need Professional Editing Services?',
                    'content' => '<p>Writing is only half of the work. Get expert editing help to eliminate mistakes and get the most of your paper.</p>',
                    'button_link' => 'https://www.grabmyessay.com/order?service=5&assignment_type=1&words=275&coupon=GME15OFF&academic_level=1&urgency=1',
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
