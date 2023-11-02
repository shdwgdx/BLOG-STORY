<footer>
    <div class="container-xxl">
        <div class="row">
            <div class="col-12 col-lg-5 align_center">
                <div class="wrapper_logo">
                    <a href="/" class="logo_footer">
                        {{-- LATVIAN <span>STORIES</span> --}}
                        {{-- <img src="/img/logo-ls.svg" alt=""> --}}
                        <img src="/img/logo-ls-footer.svg" alt="">
                    </a>
                    <p class="coopy">© SIA LATVIAN STORIES 2023</p>
                </div>
            </div>
            <div class="col-12 col-lg-7 align_center wrapper_menu_list">
                <ul class="footer_menu_list">
                    {{-- <li class="footer_menu_item"><a href="#">Log in</a></li> --}}
                    {{-- <li class="footer_menu_item"><a href="#">Routes</a></li> --}}
                    <li class="footer_menu_item"><a href="{{ route('stories') }}">Stories</a></li>
                    <li class="footer_menu_item"><a href="{{ route('blog') }}">The blog</a></li>
                    <li class="footer_menu_item"><a href="{{ route('privacy-policy') }}">Privacy policy</a></li>
                    <li class="footer_menu_item"><a href="{{ route('cookies') }}">Terms and Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
