@extends('layouts.admin')
@section('content-header')
    <div class="content-header-block">
        <h1 class="m-0 text-dark content-header">Partners</h1>
        <a href="{{ route('partners.create') }}"><button type="submit" form="route" class="buttong-group__save-button">
                <div class="buttong-group__save-button-text">Add a partner</div>
                <i class="fa fa-plus buttong-group__save-button-icon"></i>
            </button></a>
    </div>
@endsection
@section('content')
    @foreach ($partners as $partner)
        <div class="card__item">
            <img src="{{ asset($partner->url_image) }}" class="card__item-image img-fluid" alt="">

            <div class="card__item-content">
                <div class="card__item-header">
                    <div class="card__item-header-head">
                        <div class="card__item-header-title">{{ $partner->title }}</div>
                        <div class="dropdown">
                            <img class="card__item-header-head-icon" src="{{ asset('images/majesticons_more-menu.svg') }}"
                                alt="">
                            <ul class="dropdown-menu">
                                <li><a href="{{ route('partners.edit', ['partner' => $partner->id]) }}"><i
                                            class='fas fa-pen dropdown-menu-icon' style='color:#12A297'></i>Edit</a></li>
                                <form id="delete-form{{ $partner->id }}" method="POST"
                                    action="{{ route('partners.destroy', ['partner' => $partner->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <li class="cursor-pointer"><a
                                            onclick="document.getElementById('delete-form{{ $partner->id }}').submit(); return false;"><i
                                                class='fas fa-trash dropdown-menu-icon' style='color:#FF5630'></i>Delete</a>
                                    </li>
                                </form>
                            </ul>
                        </div>
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
