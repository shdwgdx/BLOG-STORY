<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="language" content="en">
    <meta name="robots" content="noindex, nofollow" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Latvian Stories</title>
    <meta name="description" content="">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    <div class="wrapper_all wrapper_route_item">
        <img src="/img/bg_blog_item.png" class="bg_route_item" alt="">
        <img src="/img/bg_forest.png" class="bg_forest" alt="">


        @include('layout.header')


        <section class="section_article_title">
            <div class="container-xxl">
                <div class="col-12">
                    <p class="article_subtitle">Route</p>
                    <p class="article_title">{{ $route->title }}</p>
                </div>
            </div>
        </section>

        <section class="section_route_information">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-12">
                        <div class="body_route_information">
                            <div class="title">Basic information</div>
                            <div class="wrapper_blocks">
                                <div class="info_txt">
                                    <div class="title">Description</div>
                                    <div class="txt">
                                        {{ $route->description }}
                                    </div>
                                </div>
                                <div class="line"></div>
                                <div class="info_cards">
                                    <div class="cards_wrapper">
                                        <div class="cards_item">
                                            <img src="/img/duration_icon.svg" alt="">
                                            <div>
                                                <div class="name">Duration</div>
                                                <div class="value">{{ $route->duration }} day</div>
                                            </div>
                                        </div>
                                        <div class="cards_item">
                                            <img src="/img/price_icon.svg" alt="">
                                            <div>
                                                <div class="name">Price</div>
                                                <div class="value">{{ $route->price }} €</div>
                                            </div>
                                        </div>
                                        <div class="cards_item">
                                            <img src="/img/distance.svg" alt="">
                                            <div>
                                                <div class="name">Distance</div>
                                                <div class="value">{{ $route->distance }} km</div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="category_wrapper">
                                        <div class="title">Category</div>
                                        <div class="wrapper_categoryes">
                                            @foreach ($route->categories as $category)
                                                <div class="item_categoryes">{{ $category->title }}</div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="category_wrapper">
                                        <div class="title">Availability</div>
                                        <div class="wrapper_categoryes">
                                            @foreach ($route->availabilities as $availability)
                                                <div class="item_categoryes">{{ $availability->title }}</div>
                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <section class="section_days">
            <div class="container-xxl">
                <div class="row">
                    <div class="col-1 col-lg-3 wrapper_line_vert">
                        <div class="stike_circle"></div>
                        <div class="line_vert"></div>
                    </div>
                    <div class="col-11 col-lg-9 wrapper_days">
                        <?php $count=0; ?>
                    @foreach ($route->days as $day)

                            @if ($loop->last && count($route->days) > 1)
                                <div class="day_wrapper last">
                                    <div class="day_name"><span>{{ $day->title }}</span></div>
                                    @foreach ($day->locations as $location)
                                        <?php $count++;?>
                                        <div class="location_body">
                                            <button class="toggle_btn {{ $count==1 ? 'active' : '' }}"></button>
                                            <div class="location_adress"> <span>{{ $location->location }}</span>
                                            </div>
                                            <div class="title">{{ $location->location_title }}</div>
                                            <div class="hide_toggle {{ $count==1 ? 'show' : '' }}">
                                                {!! $location->description !!}
                                                <img src="{{ $location->url_image }}" alt="">
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                @break
                            @endif
                            <div class="day_wrapper">
                                <div class="day_name"><span>{{ $day->title }}</span></div>
                                @foreach ($day->locations as $location)
                                <?php $count++;?>
                                    <div class="location_body">
                                        <button class="toggle_btn {{ $count==1 ? 'active' : '' }}"></button>
                                        <div class="location_adress"> <span>{{ $location->location }}</span>
                                        </div>
                                        <div class="title">{{ $location->location_title }}</div>
                                        <div class="hide_toggle {{ $count==1 ? 'show' : '' }}">
                                            {!! $location->description !!}
                                            <img src="{{ $location->url_image }}" alt="">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                    @endforeach
                    <div class="finish_wrapper">
                        <div class="day_name"><span></span></div>
                        <div class="finish">
                            <p>Finish</p>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </section>



    <section class="section_map">
        <div class="container-xxl">
            <div class="row">
                <div class="col-12">
                    <div id="map_route" class="map_route" style="position: relative; overflow: hidden;"></div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 wrapper_center">
                    <a href="{{ $route->url_map }}" class="btn_header fluid">View route on Google Maps</a>
                </div>
            </div>
        </div>
    </section>







    <div class="wrapper_footer_join">
        <img src="/img/flowers_footer.png" class="flowers_footer" alt="">
        <img src="/img/buckthorn_footer.png" class="buckthorn_footer" alt="">

        <img src="/img/wrapper_footer_join_1.png" class="wrapper_footer_join_1" alt="">
        <img src="/img/wrapper_footer_join_1.png" class="wrapper_footer_join_2" alt="">

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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYZoS9SE7yCgnjpgnU2qRHcLBQZuaaGgY"></script>


<script>
    let url = "{{ $route->url_map }}";

    url = url.replace("https://www.google.lv/maps/dir/", "");
    url = url.split("/@")[0];
    let pointsArray = url = url.split("/");

    function init_map() {
        var myOptions = {
            zoom: 12.44,
            center: new google.maps.LatLng(56.959, 24.069),
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            disableDefaultUI: true,
            language: 'en',
            styles: [{
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#29444C"
                    }]
                },
                {
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },
                {
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#212121"
                    }]
                },
                {
                    "featureType": "administrative",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },
                {
                    "featureType": "administrative.country",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#9e9e9e"
                    }]
                },
                {
                    "featureType": "administrative.land_parcel",
                    "stylers": [{
                        "visibility": "off"
                    }]
                },
                {
                    "featureType": "administrative.locality",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#bdbdbd"
                    }]
                },
                {
                    "featureType": "poi",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#181818"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#616161"
                    }]
                },
                {
                    "featureType": "poi.park",
                    "elementType": "labels.text.stroke",
                    "stylers": [{
                        "color": "#1b1b1b"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "geometry.fill",
                    "stylers": [{
                        "color": "#2c2c2c"
                    }]
                },
                {
                    "featureType": "road",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#8a8a8a"
                    }]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#808C89"
                    }]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#97A09D"
                    }]
                },
                {
                    "featureType": "road.highway.controlled_access",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#4e4e4e"
                    }]
                },
                {
                    "featureType": "road.local",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#616161"
                    }]
                },
                {
                    "featureType": "transit",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#757575"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [{
                        "color": "#000000"
                    }]
                },
                {
                    "featureType": "water",
                    "elementType": "labels.text.fill",
                    "stylers": [{
                        "color": "#3d3d3d"
                    }]
                }
            ]
        };
        map = new google.maps.Map(document.getElementById("map_route"), myOptions);
        // marker = new google.maps.Marker({
        //     map: map,
        //     position: new google.maps.LatLng(56.954126036368805, 24.022787986508586),
        //     icon: {
        //         url: '/img/ph_map-pin-fill.svg'
        //     }
        // });

        var directionsService = new google.maps.DirectionsService();
        var directionsDisplay = new google.maps.DirectionsRenderer();
        directionsDisplay.setMap(map);

        let pointsArrayNew = [];

        pointsArray.forEach((element, key) => {
            let newElement = decodeURIComponent(element)
            pointsArrayNew[key] = {
                location: newElement,
                stopover: true
            }
        });

        let waypointsArray = [...pointsArrayNew];

        waypointsArray.shift();
        waypointsArray.pop();

        console.log(pointsArrayNew?.[0]?.location);
        console.log(waypointsArray);
        console.log(pointsArrayNew?.[pointsArrayNew.length - 1]?.location);

        var request = {
            origin: pointsArrayNew?.[0]?.location,
            destination: pointsArrayNew?.[pointsArrayNew.length - 1]?.location,
            waypoints: waypointsArray,
            travelMode: google.maps.TravelMode.DRIVING
        };

        // Запустите запрос маршрута
        directionsService.route(request, function(response, status) {
            if (status == google.maps.DirectionsStatus.OK) {
                directionsDisplay.setDirections(response);
            }
        });
        // google.maps.event.addListener(marker, "click", function () {
        //   infowindow.open(map, marker);
        // });
        // infowindow.open(map, marker);
    }

    google.maps.event.addDomListener(window, 'load', init_map);

    // fixedBlockScroll();
</script>
</body>

</html>
