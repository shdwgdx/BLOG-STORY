<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latvian Stories</title>
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper_all wrapper_blog_item">
        <img src="/img/bg_blog_item.png" class="bg_blog_item" alt="">
        <img src="/img/bg_forest.png" class="bg_forest" alt="">


        @include('layout.header')


        <section class="section_article_title">
            <div class="container-xxl">
                <div class="col-12">
                    <p class="article_subtitle">Article</p>
                    <p class="article_title">{{ $blog->title }}</p>
                </div>
            </div>
        </section>

        <section class="section_article_content">
            <div class="container-xxl">
                <div class="row_grid">
                    <div class="body_stories">
                        <div class="title">See how it was</div>
                        <div class="wrapper_stories_circle {{ count($blog->stories) < 5 ? 'flex_start' : '' }}">
                            @foreach ($blog->stories as $key => $story)
                                @if ($key === 7 && $loop->remaining >= 0)
                                    <div class="stories_circle_item last">
                                        <div class="lasc_count">+{{ $loop->remaining + 1 }}</div>
                                        <img src="{{ $story->required_image }}" alt="">
                                    </div>
                                @break
                            @endif
                            <div class="stories_circle_item" onclick="modalStoriesActive({{ $key }})">
                                <img src="{{ $story->required_image }}" alt="">
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="body_content_article">
                    {!! $blog->description !!}

                    @if ($blog_videos->url)
                        <video  class="video_blog" controls='controls' controls preload="none" playsinline>
                            <source src="{{ $blog_videos->url }}">
                        </video>
                    @endif
                    {{-- <div class="body_see_route">
                        <div class="title">Get a route</div>
                        <form method="POST" class="wrapper_input">
                            @csrf
                            <input type="email" placeholder="Enter your email adress" name="email">
                            <input type="hidden" name="route_id" value="{{ $blog->route->id }}">
                            <button id="saveButton">Save</button>
                        </form>

                    </div> --}}
                </div>

                <div class="grid_b">
                    <div class="body_table_contents">
                        <div class="title">Contents</div>
                        <ul class="list_table_contents">
                            <li>Route 1</li>
                            <li>Laska V21 presents: SESTRA band's long-awaited return to the stage! </li>
                            <li>Route 1</li>
                            <li>Route 1</li>
                        </ul>
                    </div>
                </div>


            </div>
        </div>
    </section>







    <div class="wrapper_footer_join">
        <img src="/img/wrapper_footer_join_1.png" class="wrapper_footer_join_1" alt="">
        <img src="/img/wrapper_footer_join_1.png" class="wrapper_footer_join_2" alt="">

        <div class="gradient_blur"></div>


        <section class="section_download_route">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="download_route_body">
                            <img src="/img/download_route_body_left.png" class="download_route_body_left"
                                alt="">
                            <img src="/img/download_route_body_2.png" class="download_route_body_2" alt="">
                            <div class="title">Get a route</div>
                            {{-- <div class="wrapper_input"> --}}
                            <form method="POST" class="form2 wrapper_input">
                                @csrf
                                <input type="email" placeholder="Enter your email adress" name="email">
                                <input type="hidden" name="route_id" value="{{ $blog->route->id }}">
                                <button id="saveButton2">Save</button>
                            </form>
                            {{-- </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>


        @include('layout.footer')
    </div>


    <div class="modal_thank_you">
        <div class="body">
            <img src="/img/modal_thank_you.png" alt="">
            <div>
                <div class="title">Thank you for your interest</div>
                <p class="description">Your application has been accepted and you can view the itinerary</p>
            </div>

            <div class="wrapper_btn">
                <button class="btn_header border_btn" onclick="openModalToggle()">Stay on page</button>
                <a href="{{ route('route', ['route' => $blog->route->id]) }}" class="btn_header fluid">Go to
                    route</a>
            </div>
        </div>
    </div>


    <div class="modal_stories">
        <button class="close" onclick="modalStoriesClose()"></button>
        <div class="body">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    @foreach ($blog->stories as $key => $story)
                        <div class="swiper-slide">
                            <div class="body_stories_info">
                                <div class="title">{{ $story->title }}</div>
                                <div class="description">{{ $story->description }}</div>
                                <div class="location"><span>{{ $story->location }}</span></div>
                            </div>
                            @if ($story->url_video)
                                <video src="{{ $story->url_video }}" class="img_story" controls></video>
                            @else
                                <img src="{{ $story->url_image }}" class="img_story" alt="">
                            @endif
                        </div>
                    @endforeach

                </div>
                <!-- If we need pagination -->
                <div class="swiper-pagination"></div>

                <!-- If we need navigation buttons -->
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
        </div>
    </div>


</div>

<script src="{{ asset('js/main.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>


<script>
    // Получаем кнопку по идентификатору
    var sendButton = document.getElementById('saveButton');
    // Добавляем слушатель события "click" на кнопку
    sendButton.addEventListener('click', sendForm);
    var sendButton2 = document.getElementById('saveButton2');
    // Добавляем слушатель события "click" на кнопку
    sendButton2.addEventListener('click', sendForm2);

    function sendForm() {
        event.preventDefault(); // предотвращаем отправку формы

        // Получаем значения полей формы
        var email = document.querySelector('input[name="email"]').value;
        var routeId = document.querySelector('input[name="route_id"]').value;
        if (!validateEmail(email)){
            alert('Incorect email');
            return
        }
        // Опции для запроса
        var options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '{{ csrf_token() }}' // подставьте тут токен CSRF вашего фреймворка
            },
            body: JSON.stringify({
                email: email,
                route_id: routeId
            })
        };

        // Отправляем запрос
        fetch('{{ route('sendRoute') }}', options)
            .then(response => response.json())
            .then(data => {
                // Обрабатываем ответ от сервера
                console.log(data);
                openModalToggle()
                // и тд...
            })
            .catch(error => {
                // Обрабатываем ошибку
                console.error(error);
            });
    }

    function sendForm2() {
        event.preventDefault(); // предотвращаем отправку формы
        let form2 = document.querySelector('.form2');
        // Получаем значения полей формы
        var email = form2.querySelector('input[name="email"]').value;
        var routeId = form2.querySelector('input[name="route_id"]').value;
        if (!validateEmail(email)){
            alert('Incorect email');
            return
        }
        // Опции для запроса
        var options = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': '{{ csrf_token() }}' // подставьте тут токен CSRF вашего фреймворка
            },
            body: JSON.stringify({
                email: email,
                route_id: routeId
            })
        };

        // Отправляем запрос
        fetch('{{ route('sendRoute') }}', options)
            .then(response => response.json())
            .then(data => {
                // Обрабатываем ответ от сервера
                console.log(data);
                openModalToggle()
                // и тд...
            })
            .catch(error => {
                // Обрабатываем ошибку
                console.error(error);
            });
    }

    function validateEmail(email) {
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
    return regex.test(email);
}

    function openModalToggle() {       
        document.querySelector('.modal_thank_you').classList.toggle('active');
    }


    const swiper = new Swiper('.swiper', {
        direction: 'horizontal',
        effect: "coverflow",
        grabCursor: true,
        centeredSlides: true,
        slidesPerView: 3,
        spaceBetween: 50,

        breakpoints: {
            300: {
                slidesPerView: 1.1,
                spaceBetween: 40
            },
            576: {
                slidesPerView: 1.6,
            },
            992: {
                slidesPerView: 3,
            }
        },

        coverflowEffect: {
            rotate: 0,
            stretch: 0,
            depth: 100,
            modifier: 1,
            slideShadows: true,
        },
        pagination: {
            el: '.swiper-pagination',
            dynamicBullets: true,
            color: 'fff'
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });

    CreateAncorBlog()
</script>
</body>

</html>
