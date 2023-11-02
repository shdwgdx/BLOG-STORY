<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stories - Latvian Stories</title>
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper_all wrapper_stories wrapper_stories_z">
        <img src="/img/bg_stories_gradient.png" class="bg_stories_gradient" alt="">



        @include('layout.header')



        <section class="section_ss">
            <img src="/img/mushrooms.png" class="mushrooms" alt="">

            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <h1 class="h1 text-start">Stories</h1>
                    </div>
                </div>

                {{-- <div class="row">
                    <div class="col-12">
                        <div class="wrapper_input">
                            <input class="input" id="search_stories_page" placeholder="Looking for adventures" type="text">
                            <button class="btn_header fluid">Search</button>

                            <div class="body_search_result">
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
        </section>



        <section class="section_stories">
            <img src="/img/grass.png" class="grass" alt="">
            <img src="/img/pngegg.png" class="pngegg" alt="">
            <div class="container-xxl">
                <div class="row row_card_stories">

                    {{-- <div class="col-12 col-lg-3">
                        <button class="btn_filter" id="btn_filter">Filter</button>
                        <div class="body_filter">
                            <div class="title">Filter</div>
                            <div class="select_wrapper">
                                <select name="" id="" class="select">
                                    <option value="">Region</option>
                                    <option value="">Kurzeme, Latgale</option>
                                    <option value="">Zemgale</option>
                                </select>

                                <div class="selected_item"><span>Kurzeme, Latgale</span><button
                                        class="btn_selected"></button></div>
                                <div class="selected_item"><span>Zemgale</span><button class="btn_selected"></button>
                                </div>
                            </div>

                            <div class="select_wrapper">
                                <select name="" id="" class="select">
                                    <option value="">Category</option>
                                    <option value="">Kurzeme, Latgale</option>
                                    <option value="">Zemgale</option>
                                </select>
                                <!-- <div class="selected_item"><span>Kurzeme, Latgale</span><button
                                        class="btn_selected"></button></div>
                                <div class="selected_item"><span>Zemgale</span><button class="btn_selected"></button>
                                </div> -->
                            </div>

                            <div class="select_wrapper">
                                <select name="" id="" class="select">
                                    <option value="">Availability</option>
                                    <option value="">Kurzeme, Latgale</option>
                                    <option value="">Zemgale</option>
                                </select>

                                <div class="selected_item"><span>Kurzeme, Latgale</span><button
                                        class="btn_selected"></button></div>
                                <div class="selected_item"><span>Zemgale</span><button class="btn_selected"></button>
                                </div>
                            </div>
                        </div>

                    </div> --}}

                    <div class="col-12 col-lg-12">
                        <div class="container-xxl p_sm_0">
                            <div class="row row_stories">
                                @foreach ($stories as $story)
                                    <div class="col-12 col-lg-4">
                                        <a href="{{ route('blog-item', ['blog' => $story->blog->id]) }}"
                                            class="card_stories">
                                            <img src="{{ $story->required_image }}" alt="">
                                            <div class="row_title">
                                                <div class="title">{{ $story->title }}</div>
                                                <div class="arrow"></div>
                                            </div>
                                            <div class="desctiption">{{ $story->description }}</div>
                                        </a>
                                    </div>
                                @endforeach



                                <div class="col-12 wrapper_center">
                                    <a href="#" class="btn_header fluid">See all stories</a>
                                </div>
                            </div>
                        </div>
                    </div>




                </div>
            </div>
        </section>


        <div class="wrapper_footer_join">
            <img src="/img/wrapper_footer_join_1.png" class="wrapper_footer_join_1" alt="">
            <img src="/img/wrapper_footer_join2.png" class="wrapper_footer_join_2" alt="">

            <img src="/img/grass.png" class="grass_mob" alt="">
            <img src="/img/pngegg.png" class="pngegg_mob" alt="">

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
    <script>
        filter_menu();
    </script>
</body>

</html>
