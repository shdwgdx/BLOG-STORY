<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latvian Stories</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper_all bg_road">
        <img src="/img/big_road_3.svg" class="road_main" alt="">
        <img src="/img/big_road_mob.svg" class="road_main_mob" alt="">
        @include('layout.header')
        <section class="section_fs">
            <div class="container-xxl">
                <img src="/img/leaves_fs.png" class="leaves_fs" alt="">
                <div class="row justify-content-center">
                    <div class="col-12 col-lg-9">
                        <h1 class="h1">Find all the
                            hidden gems </h1>
                    </div>
                    <div class="col-12 col-sm-8 col-lg-6 wrapper_center">
                        <div class="description">Welcome to LATVIAN STORIES, where you can explore our curated routes or
                            design your own adventure, crafting a personalized itinerary that caters to your unique
                            interests and preferences. </div>
                        <a href="{{ route('blog') }}" class="btn_header fluid">Find a route</a>
                    </div>

                </div>
            </div>

            <div class="gradient_blur"></div>
        </section>


        <section class="section_ss">
            <img src="/img/section_ss_cone.png" class="section_ss_cone" alt="">
            <img src="/img/section_ss_fir.png" class="section_ss_fir" alt="">
            <div class="container-xxl">
                <div class="row align_center ">
                    <div class="col-12 col-lg-6 section_ss_col_relative">
                        <img src="/img/section_ss_img_1.png" class="section_ss_img_1" alt="">
                        <h2 class="h2">Go exploring!</h2>
                    </div>
                    <div class="col-12 col-lg-6">
                        <p class="description">Explore our curated routes or design your own adventure, crafting a
                            personalised
                            itinerary that caters to your unique interests!</p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="wrapper_input">
                            <input class="input" id="search_main_page" placeholder="Looking for adventures"
                                type="text">
                            <button class="btn_header fluid">Search</button>


                            <div class="body_search_result">
                                {{-- <a href="#" class="result_item">Made in Latvia</a> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row row_section_ss_img">
                    <div class="col-12 col-lg-5">
                        <img src="/img/section_ss_img.png" class="section_ss_img" alt="">
                    </div>
                </div>
            </div>
        </section>
        <section class="section_stories">
            <img src="/img/section_stories_img.png" class="section_stories_img" alt="">
            <img src="/img/section_stories_img2.png" class="section_stories_img2" alt="">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <h2 class="h2 mb60">Stories</h2>
                    </div>
                </div>


                <div class="row row_card_stories">
                    @foreach ($stories as $story)
                        <div class="col-12 col-lg-4">
                            <div class="card_stories">
                                @if ($story->required_image)
                                    <img src="{{ $story->required_image }}" alt="">
                                @endif

                                <div class="row_title">
                                    <div class="title">{{ $story->title }}</div>
                                    <a href="{{ route('blog-item', ['blog' => $story->blog->id]) }}" class="arrow"></a>
                                </div>
                                <div class="desctiption">{{ $story->description }}</div>
                            </div>
                        </div>
                    @endforeach


                    <div class="col-12 wrapper_center">
                        <a href="{{ route('stories') }}" class="btn_header fluid">See all stories</a>
                    </div>
                </div>
            </div>
        </section>
        <section class="section_blog">
            <img src="/img/section_blog_img1.png" class="section_blog_img1" alt="">
            <img src="/img/section_blog_img2.png" class="section_blog_img2" alt="">
            <img src="/img/section_blog_img3.png" class="section_blog_img3" alt="">
            <div class="container-xxl">
                <div class="row mb60">
                    <div class="col-12 col-lg-7">
                        <h2 class="h2">The blog</h2>
                    </div>
                    <div class="col-12 col-lg-5 col_btn">
                        <a href="{{ route('blog') }}" class="btn_header fluid">Watch all</a>
                    </div>
                </div>

                <div class="row row_card_blog">
                    @foreach ($blogs as $blog)
                        <div class="col-12 col-lg-4">
                            <a href="{{ route('blog-item', ['blog' => $blog->id]) }}" class="card_blog">
                                <img src="{{ $blog->image }}" alt="">
                                <div class="title">{{ $blog->title }}</div>
                                <div class="description">{{ $blog->route->description }}</div>
                                <div class="location">{{ $blog->route->location }}</div>
                                <div class="line"></div>
                                <div class="category_wrapper">
                                    <div class="category_body">
                                        @foreach ($blog->route->categories as $key => $category)
                                            <div class="item_category">{{ $category->title }}</div>
                                            @if ($key === 2 && $loop->remaining > 0)
                                                <div class="item_category">+{{ $loop->remaining }} categories</div>
                                            @break
                                        @endif
                                    @endforeach
                                </div>
                                <div class="arrow"></div>
                            </div>
                        </a>
                    </div>
                @endforeach

            </div>


            <div class="row">
                <div class="col-12 col_btn_for_mob">
                    <a href="{{ route('blog') }}" class="btn_header fluid">Watch all</a>
                </div>
            </div>

        </div>
    </section>
    <section class="section_supported">

        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <h2 class="h2 mb60">
                        Supported by
                    </h2>
                </div>
            </div>

            <div class="row">
                <div class="col-12 supported_body_wrapper">
                    <img src="img/supported_img_fir_1.png" class="supported_img_fir_1" alt="">
                    <img src="/img/supported_img_fir_2.png" class="supported_img_fir_2" alt="">
                    <div class="supported_body">
                        @foreach ($partners as $partner)
                            <a href="{{ $partner->url }}"><img src="{{ $partner->url_image }}" class="item"
                                    alt=""></a>
                        @endforeach
                        {{-- <img src="/img/supported_img.png" class="item" alt=""> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="wrapper_footer_join">

        <img src="/img/wrapper_footer_join_1.png" class="wrapper_footer_join_1" alt="">
        <img src="/img/wrapper_footer_join2.png" class="wrapper_footer_join_2" alt="">

        <div class="gradient_blur"></div>
        <section class="section_join">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <h2 class="h2 mb60">
                            Join us!
                        </h2>
                    </div>
                    <div class="col-12 wrapper_center">
                        <a href="{{ route('blog') }}" class="btn_header fluid">Find a route</a>
                    </div>
                </div>
            </div>
        </section>

        @include('layout.footer')

    </div>



</div>

<script src="{{ asset('js/main.js') }}"></script>
</body>

</html>
