<header>
    <div class="header">
        <ul class="header_menu_list">
            {{-- <li class="header_menu_item"><a href="#">Routes</a></li> --}}
            <li class="header_menu_item"><a href="{{ route('stories') }}">Stories</a></li>
            <li class="header_menu_item"><a href="{{ route('blog') }}">The blog</a></li>
        </ul>

        <a href="{{ route('index') }}" class="header_logo">
            <img src="/img/logo-ls.svg" alt="">
        </a>

        <div class="wrapper_btn_header end_flex">
            <div class="wrapper_link_contact">
                <a href="mailto:latvian-stories@mail.com" class="btn_header email">latvian-stories@mail.com</a>
                <a href="#" class="btn_header phone">+371 876 68 89</a>
            </div>
            <a href="#" class="lang_link active">EN</a>
            <a href="#" class="lang_link">LV</a>
        </div>

        <button id="btn_burger" class="btn_burger">
            <span class="first"></span>
            <span class="middle"></span>
            <span class="last"></span>
        </button>
    </div>


    <div class="mob_menu">
        <div class="wrapper">
            <ul class="header_menu_list">
                {{-- <li class="header_menu_item"><a href="#">Log in</a></li> --}}
                {{-- <li class="header_menu_item"><a href="#">Routes</a></li> --}}
                <li class="header_menu_item"><a href="{{ route('stories') }}">Stories</a></li>
                <li class="header_menu_item"><a href="{{ route('blog') }}">The blog</a></li>
                <li class="header_menu_item"><a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                {{-- <li class="header_menu_item"><a href="#">Cookies</a></li> --}}
            </ul>
            <div class="wrapper_btn_header">
                <a href="mailto:latvian-stories@mail.com" class="btn_header email_a">latvian-stories@mail.com</a>
                <a href="tel:3718766889" class="btn_header phone_a">+371 876 68 89</a>
            </div>
        </div>

        <img src="/img/fir_img.png" class="fir_img" alt="">
        <img src="/img/bulrush.png" class="bulrush_img" alt="">
    </div>
</header>
