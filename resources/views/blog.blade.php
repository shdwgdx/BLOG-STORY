<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Latvian Stories</title>
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper_all wrapper_stories wrapper_blog">
        <img src="/img/bg_stories_gradient.png" class="bg_stories_gradient" alt="">


        @include('layout.header')



        <section class="section_ss">
            <!-- <img src="/img/mushrooms.png" class="mushrooms" alt=""> -->

            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <h1 class="h1 text-start"><span>Blog</span>
                            <img src="/img/cone_blog.png" class="cone_blog" alt="">
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="wrapper_input">
                            <input class="input" id="filter_search_query" placeholder="Looking for adventures" type="text">
                            <button class="btn_header fluid">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>



        <section class="section_stories">
            <img src="/img/mushrooms_1.png" class="mushrooms_1" alt="">
            <img src="/img/flowers.png" class="flowers" alt="">
            <div class="container-xxl">
                <div class="row row_card_blog">
                    <div class="col-12 col-lg-3">
                        <button class="btn_filter" id="btn_filter">Filter</button>
                        <div class="body_filter">
                            <div class="title">Filter</div>

                            <form action="" id="form_filter">
                                <div class="select_wrapper">
                                    <div class="title">Regions</div>
                                    @foreach ($regions as $region)
                                        <div class="checkbox_wrapper">
                                            <input type="checkbox" id="custom-checkbox_region_{{ $region->id }}" checked value="{{ $region->id }}">
                                            <label for="custom-checkbox_region_{{ $region->id }}" class="custom-checkbox-label"><span>{{ $region->title }}</span></label>
                                        </div>
                                    @endforeach
                                </div>
    
                                <div class="select_wrapper mt10">
                                    <div class="title">Category</div>
                                    @foreach ($categories as $category)
                                        <div class="checkbox_wrapper">
                                            <input type="checkbox" id="custom-checkbox_category_{{ $category->id }}" checked value="{{ $category->id }}">
                                            <label for="custom-checkbox_category_{{ $category->id }}" class="custom-checkbox-label"><span>{{ $category->title }}</span></label>
                                        </div>
                                    @endforeach
                                </div>
    
                                <div class="select_wrapper mt10">
                                    <div class="title">Availability</div>
                                    @foreach ($availabilities as $availability)
                                        <div class="checkbox_wrapper">
                                            <input type="checkbox" id="custom-checkbox_availability_{{ $availability->id }}" checked value="{{ $availability->id }}">
                                            <label for="custom-checkbox_availability_{{ $availability->id }}" class="custom-checkbox-label"><span>{{ $availability->title }}</span></label>
                                        </div>
                                    @endforeach
                                </div>
                            </form>
                            
                        </div>
                    </div>



                    <div class="col-12 col-lg-9">
                        <div class="container-xxl p_sm_0">
                            <div class="row row_stories" id="row_stories">
                                @foreach ($blogs as $blog)
                                    <div class="col-12 col-lg-6">
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
                                                            <div class="item_category">+{{ $loop->remaining }}
                                                                categories</div>
                                                        @break
                                                    @endif
                                                @endforeach
                                            </div>
                                            <div class="arrow"></div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                            {{-- <div class="col-12 wrapper_center">
                                <a href="#" class="btn_header fluid">See all stories</a>
                            </div> --}}
                        </div>
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
                        <a href="#" class="btn_header fluid">Find a route</a>
                    </div>
                </div>
            </div>
        </section>


        @include('layout.footer')
    </div>


</div>

<script src="{{ asset('js/main.js') }}"></script>
<script>
    filter_menu();
</script>
</body>

</html>
