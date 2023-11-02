@extends('layouts.admin')
@section('content-header')
    <div class="content-header-block">
        <h1 class="m-0 text-dark content-header">Routes</h1>
        <a href="{{ route('routes.create') }}"><button type="submit" form="route" class="buttong-group__save-button">
                <div class="buttong-group__save-button-text">Add a routes</div>
                <i class="fa fa-plus buttong-group__save-button-icon"></i>
            </button></a>
    </div>
@endsection
@section('content')
    @foreach ($routes as $route)
        <div class="card__item">
            <img src="{{ asset($route->url_image) }}" class="card__item-image img-fluid" alt="">
            <div class="card__item-content">
                <div class="card__item-header">
                    <div class="card__item-header-head">
                        <div class="card__item-header-title">{{ $route->title }}</div>
                        <div class="dropdown">
                            <img class="card__item-header-head-icon" src="{{ asset('images/majesticons_more-menu.svg') }}"
                                alt="">
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('routes.edit', ['route' => $route->id]) }}"><i
                                            class='fas fa-pen dropdown-menu-icon' style='color:#12A297'></i>Edit</a></li>
                                <form id="delete-form{{ $route->id }}" method="POST"
                                    action="{{ route('routes.destroy', ['route' => $route->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <li class="cursor-pointer"><a
                                            onclick="document.getElementById('delete-form{{ $route->id }}').submit(); return false;"><i
                                                class='fas fa-trash dropdown-menu-icon' style='color:#FF5630'></i>Delete</a>
                                    </li>
                                </form>
                            </ul>
                        </div>
                    </div>

                    <div class="card__item-header-description">
                        {{ str()->words("$route->description", 45, '...') }}
                    </div>
                </div>
                <div class="card__item-body">
                    <div class="card__item-body-info">
                        <img src="{{ asset('images/calendar.svg') }}" alt="" class="card__item-body-info-icon">
                        <div class="card__item-body-info-text">
                            <p class="card__item-body-info-text_title">Duration</p>
                            <p class="card__item-body-info-text_description">{{ $route->duration }} day</p>
                        </div>
                    </div>
                    <div class="card__item-body-info">
                        <img src="{{ asset('images/price.svg') }}" alt="" class="card__item-body-info-icon">
                        <div class="card__item-body-info-text">
                            <p class="card__item-body-info-text_title">Price</p>
                            <p class="card__item-body-info-text_description">{{ $route->price }} €</p>
                        </div>
                    </div>
                    <div class="card__item-body-info">
                        <img src="{{ asset('images/distance.svg') }}" alt="" class="card__item-body-info-icon">
                        <div class="card__item-body-info-text">
                            <p class="card__item-body-info-text_title">Distance</p>
                            <p class="card__item-body-info-text_description">{{ $route->distance }} km</p>
                        </div>
                    </div>
                </div>
                <div class="card__item-footer">
                    <div class="card__item-footer-routes">
                        <div class="card__item-footer-routes-item">
                            <img src="{{ asset('images/bxs_map.svg') }}"
                                class="card__item-footer-routes-item-image img-fluid" alt="">
                            <div class="card__item-footer-routes-item-text">{{ $route->location }}</div>
                        </div>
                        {{-- <div class="card__item-footer-routes-line"><svg xmlns="http://www.w3.org/2000/svg" width="2"
                                height="6" viewBox="0 0 2 6" fill="none">
                                <path d="M1 6V0" stroke="#12A297" />
                            </svg></div>
                        <div class="card__item-footer-routes-item">
                            <img src="{{ asset('images/bxs_map.svg') }}"
                class="card__item-footer-routes-item-image img-fluid" alt="">
                <div class="card__item-footer-routes-item-text">Laska V21, Vagonu 21 ,Riga, Latvia</div>
            </div> --}}
                    </div>
                    <div class="card__item-footer-line"><svg xmlns="http://www.w3.org/2000/svg" width="894"
                            height="2" viewBox="0 0 894 2" fill="none">
                            <path d="M0 1H894" stroke="#EAEAEA" />
                        </svg></div>
                    <div class="card__item-footer-tags">
                        @foreach ($route->categories as $category)
                            <div class="card__item-footer-tag">
                                {{ $category->title }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endforeach



    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dropdowns = document.querySelectorAll('.dropdown');

            dropdowns.forEach(function(dropdown) {
                dropdown.addEventListener('click', function() {
                    this.classList.toggle('show');
                });
            });

            window.addEventListener('click', function(event) {
                dropdowns.forEach(function(dropdown) {
                    if (!dropdown.contains(event.target)) {
                        dropdown.classList.remove('show');
                    }
                });
            });
        });
    </script>
@endsection
