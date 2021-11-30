@extends('backend.master')

@section('content')
    <div class="form">
        <div class="wrap">
            <div class="h1">Complete Your Paper in Just <span>4 Easy Steps</span> Using Our <span>Conclusion Generator</span></div>
            <div class="steps">
                <div class="item"><span>1.</span> Copy and paste your title and text in the relative fields</div>
                <div class="item"><span>2.</span> Choose the word count for the summary</div>
                <div class="item"><span>3.</span> Click the "Generate My Conclusion" button</div>
                <div class="item"><span>4.</span> Enjoy the result!</div>
            </div>
            <form class="conclusion_generator">
                @csrf
                <div class="result">
                    <div class="h2">Here is Your Summary:</div>
                    <div class="summary">
                        <div class="item">Original Length: <span class="original-words">1234567 words</span></div>
                        <div class="item">Summary Length: <span class="summary-words">1234567 words</span></div>
                        <div class="item">Summary Ratio: <span class="percent">89%</span></div>
                    </div>
                </div>
                <div class="form-group">
                    <input type="text" name="title" class="form-control" placeholder="Type/paste your title here">
                </div>
                <div class="form-group">
                    <textarea class="form-control" name="text" rows="3" placeholder="Type/ paste your text here (minimum 200 words required)"></textarea>
                </div>
                <div class="form-group radio-buttons">
                    <div class="text">How long should your summary be?</div>
                    <label class="radio-inline" for="inlineRadio1">
                        <input name="count" checked type="radio" id="inlineRadio1" value="150">
                        <span></span>150 words
                    </label>
                    <label class="radio-inline" for="inlineRadio2">
                        <input name="count" type="radio" id="inlineRadio2" value="200">
                        <span></span>200 words
                    </label>
                    <label class="radio-inline" for="inlineRadio3">
                        <input name="count" type="radio" id="inlineRadio3" value="300">
                        <span></span>
                        <input type="text" class="form-control ss" name="count_value" placeholder="300">
                    </label>
                </div>
                <div class="form-group submit">
                    <button type="submit" class="button black" id="summarize-button">Generate My Conclusion</button>
                </div>
            </form>
        </div>
    </div>
    <div class="ratting">
        <div class="wrap">
            <div class="title">How Helpful It Was?</div>
            <div class="stars">
                <label for="rate_1" class="active">
                    <input type="radio" name="rate" value="1" id="rate_1">
                </label>
                <label for="rate_2" class="active">
                    <input type="radio" name="rate" value="2" id="rate_2">
                </label>
                <label for="rate_3" class="active">
                    <input type="radio" name="rate" value="3" id="rate_3">
                </label>
                <label for="rate_4" class="active">
                    <input type="radio" name="rate" value="4" id="rate_4">
                </label>
                <label for="rate_5">
                    <input type="radio" name="rate" value="5" id="rate_5">
                </label>
            </div>
            <div class="votes">Votes: 23</div>
        </div>
    </div>
    <div class="ideal-match">
        <div class="wrap">
            <div class="h1">How Can We Make a Perfect Academic Match?</div>
            <div class="steps">
                <div class="item">
                    <img src="{{ asset('backend/img/pic.png') }}" alt="">
                    <div class="info">
                        <div class="title">Your Unfinished Paper</div>
                        <p>You have your unfinished paper and cannot put all things together.</p>
                    </div>
                </div>
                <div class="item">
                    <img src="{{ asset('backend/img/pic1.png') }}" alt="">
                    <div class="info">
                        <div class="title">Our Expert Editors and Writers</div>
                        <p>We have expert editors who can polish everything up or write a new one from scratch.</p>
                    </div>
                </div>
            </div>
            <div class="prices">
                <div class="subtitle">EQUALS</div>
                <div class="title">Your perfectly edited piece of writing starting at: <span>$ <span>8</span>.99 <span class="per-page">per page</span></span></div>
                <a href="#" class="button green">Edit My Paper</a>
            </div>
        </div>
    </div>
    <div class="text-block">
        <div class="wrap">
            <div class="h1">Text About Conclusion Generator and Benefits</div>
            <div class="content">
                <h2>Essay Service That Cares</h2>
                <p>There are many student services on the market that deliver similar academic assistance. The question is, are all of them credible enough. At Grab My Essay.com every customer gets more than fulfillment of write my essay for me request. Consider us as your personal writing consultant that is ready to help you and save your grades 24/7. Every team member is your friend, adviser, and friend who indeed cares about your college performance.</p>
                <h3>Two General APA Concepts</h3>
                <ol>
                    <li>Firstly, an APA style paper can be used for scientific research papers in order to present an existing and proven theory. This means that the paper must be written using present perfect or past tense when quoting and citing sources.</li>
                    <li>Secondly, an APA format research paper prioritizes the year of the publication. It should always be featured after each name sourced in the paper.</li>
                </ol>
                <p>For example:<br> “Harrison (1997) posited that women were programmed to nurture their young.”</p>
                <p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p>
                <p>While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use <a href="#">EdTech</a> tools. With their help, you'll research information faster and process it easier. They also can help you memorize the APA formatting rules.</p>
                <p>The APA Style can be used for different types of papers, such as essays, theses, dissertations, etc. You can also use these for <a href="#">argumentative research paper topics</a>, expository essays for minor subjects and any more. Once you get used to this style of writing, you won’t have to refer back to the style guides as much.</p>
                <h2>What is the APA Style?</h2>
                <p>The American Psychological Association or APA research format is a writing method recommended by the aforementioned organization. This is usually used in social science subjects and is written using two general concepts.</p>
                <h3>Practical Rules for of the Research Paper</h3>
                <p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p>
                <p>While all this information may seem like a lot, in fact, it offers a rigid framework that structurizes your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you'll research information faster and process it easier. They also can help you memorize the APA formatting rules.</p>
                <p>The APA Style can be used for different types of papers, such as essays, theses, dissertations, etc. You can also use these for argumentative research paper topics, expository essays for minor subjects and any more. Once you get used to this style of writing, you won’t have to refer back to the style guides as much.</p>
                <h3>Basic Writing Rules for APA Style</h3>
                <p>When writing an abstract, it is best to remember that this is the most eye-catching part of the paper. The content, although condensed, must be accurate and readable. There is no need to add a paragraph indentation on this page.</p>
                <p>While all this information may seem like a lot, in fact, it offers a rigid framework that your writing thus making it easier to digest. If you find formatting your paper difficult, use EdTech tools. With their help, you'll research information faster and process it easier. </p>
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="wrap">
            <div class="h2">Need Professional Editing Services?</div>
            <p>Maecenas a hendrerit diam. Etiam vulputate lacinia turpis ac lacinia. Nam auctor libero eu viverra eleifend. Donec non imperdiet erat, sit amet interdum l</p>
            <a href="#" class="button green">Edit My Paper</a>
        </div>
    </div>
@endsection
