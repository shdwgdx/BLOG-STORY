@extends('layouts.admin')
@push('scripts')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- include libraries(jQuery, bootstrap) -->
    <script type="text/javascript" src="//code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@section('content-header')
    <h1 class="m-0 text-dark">Editing a routes</h1>
@endsection
@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('routes.index') }}">Routes</a></li>
            <li class="breadcrumb-item active">Editing a routes</li>
        </ol>
    </div>
    <div class="row">
        <div class="col-12">
            <div>
                <button id="enBtn">EN</button>
                <button id="lvBtn">LV</button>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('routes.update', ['route' => $route->id]) }}" form="route" id="route"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="content-sheet">
            <div class="content-sheet__title">Basic information</div>
            <img src="{{ asset('images/Vector 955.svg') }}" class="content-sheet__line" alt="">

            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Title of the article</label>
                <input type="text" class="content-sheet__item-field" placeholder="Title of the article" name="title"
                    value="{{ $route->title }}" required data-title="Route title" data-language="en">
                <input type="text" class="content-sheet__item-field" placeholder="Title of the article (LV)"
                    name="title_lv" value="{{ $route->title_lv }}" required data-title="Route title (LV)"
                    data-language="lv">
            </div>
            {{-- <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Location</label>
                <input type="text" class="content-sheet__item-field" placeholder="Location" name="location">
            </div> --}}
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Link to Google maps</label>
                <input type="text" class="content-sheet__item-field" placeholder="https:/" name="url_map"
                    value="{{ $route->url_map }}" required data-title="Route google map">
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Location</label>
                <input type="text" class="content-sheet__item-field" placeholder="Location" name="location"
                    value="{{ $route->location }}" required data-title="Route location" data-language="en">
                <input type="text" class="content-sheet__item-field" placeholder="Location (LV)" name="location_lv"
                    value="{{ $route->location_lv }}" required data-title="Route location (LV)" data-language="lv">
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Description</label>
                <input type="text" class="content-sheet__item-field" placeholder="Description" name="description"
                    value="{{ $route->description }}" required data-title="Route description" data-language="en">
                <input type="text" class="content-sheet__item-field" placeholder="Description (LV)" name="description_lv"
                    value="{{ $route->description_lv }}" required data-title="Route description (LV)" data-language="lv">
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Duration</label>
                <input type="text" class="content-sheet__item-field" placeholder="Duration" name="duration"
                    value="{{ $route->duration }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required
                    data-title="Route duration">
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Price</label>
                <input type="text" class="content-sheet__item-field" placeholder="€" name="price"
                    value="{{ $route->price }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required
                    data-title="Route price">
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Distance</label>
                <input type="text" class="content-sheet__item-field" placeholder="km" name="distance"
                    value="{{ $route->distance }}" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required
                    data-title="Route distance">
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Categories</label>
                <select class="form-select" id="multiple-select-categories-field" data-placeholder="Choose anything"
                    multiple name="categories[]">
                    @foreach ($categories as $category)
                        @if (count($category->childrens) > 0)
                            <optgroup label="{{ $category->title }}">
                                @foreach ($category->childrens as $children)
                                    <option @if ($route->categories->contains('id', $children->id)) selected @endif value="{{ $children->id }}">
                                        {{ $children->title }}</option>
                                @endforeach
                            </optgroup>
                        @else
                            <option @if ($route->categories->contains('id', $category->id) && $category->parent_id == null) selected @endif value="{{ $category->id }}">
                                {{ $category->title }}</option>
                        @endif
                    @endforeach
                </select>

            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Availability</label>
                <select class="form-select" id="multiple-select-availability-field" data-placeholder="Choose anything"
                    multiple name="availability[]">
                    @foreach ($availabilities as $availability)
                        <option
                            @foreach ($route->availabilities as $routeAvailability)  {{ $availability->id === $routeAvailability->id ? 'selected' : '' }} @endforeach
                            value="{{ $availability->id }}">{{ $availability->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Regions</label>
                <select class="form-select" id="multiple-select-regions-field" data-placeholder="Choose anything"
                    multiple name="regions[]">
                    @foreach ($regions as $region)
                        <option
                            @foreach ($route->regions as $routeRegion)  {{ $region->id === $routeRegion->id ? 'selected' : '' }} @endforeach
                            value="{{ $region->id }}">{{ $region->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Image</label>
                <label class="form__container" id="upload-container">
                    <div class="dropzone-block">
                        <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                            alt="">
                        <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                    </div>
                    <input class="form__file" id="upload-files" type="file" accept="image/*" name="url_image"
                        required>
                </label>
                <div class="form__files-container" id="files-list-container" data-images="{{ json_encode($route) }}">
                    <div class="form__image-container js-remove-image" data-index="0">
                        <img class="form__image" src="{{ $route->url_image }}">
                    </div>

                </div>
            </div>
        </div>
        <div class="content-sheet">
            <div class="content-sheet__title">Route</div>
            <div class="content-sheet__days-block" id="content-sheet__days-block">
                @foreach ($route->days as $key => $day)
                    <div class="content-sheet__inner-block">
                        <div class="content-sheet__inner-block-title">
                            Day {{ $day->number }}
                        </div>
                        <img src="{{ asset('images/Vector 955.svg') }}" class="content-sheet__line" alt="">
                        <div class="content-sheet__item">
                            <label for="" class="content-sheet__item-title">Name of the day</label>
                            <input type="text" class="content-sheet__item-field" placeholder="Name of the day"
                                name="days[{{ $day->number }}][title]" value="{{ $day->title }}" required required
                                data-title="Day {{ $day->number }} name" data-language="en">
                            <input type="text" class="content-sheet__item-field" placeholder="Name of the day (LV)"
                                name="days[{{ $day->number }}][title_lv]" value="{{ $day->title_lv }}" required
                                required data-title="Day {{ $day->number }} name (LV)" data-language="lv">
                        </div>
                        @foreach ($day->locations as $key => $location)
                            <div class="content-sheet__location-block">
                                <div class="content-sheet__item">
                                    <label for="" class="content-sheet__item-title">Title of the location</label>
                                    <input type="text" class="content-sheet__item-field"
                                        placeholder="Title of the location"
                                        name="days[{{ $day->number }}][location_title][]"
                                        value="{{ $location->location_title }}" required
                                        data-location="{{ $key + 1 }}"
                                        data-title="Day {{ $day->number }} locations title" data-language="en">
                                    <input type="text" class="content-sheet__item-field"
                                        placeholder="Title of the location (LV)"
                                        name="days[{{ $day->number }}][location_title_lv][]"
                                        value="{{ $location->location_title_lv }}" required
                                        data-location="{{ $key + 1 }}"
                                        data-title="Day {{ $day->number }} locations title (LV)" data-language="lv">
                                </div>
                                <div class="content-sheet__item">
                                    <label for="" class="content-sheet__item-title">Location</label>
                                    <input type="text" class="content-sheet__item-field" placeholder="Location"
                                        name="days[{{ $day->number }}][location][]" value="{{ $location->location }}"
                                        required data-title="Day {{ $day->number }} locations location"
                                        data-language="en">
                                    <input type="text" class="content-sheet__item-field" placeholder="Location (LV)"
                                        name="days[{{ $day->number }}][location_lv][]"
                                        value="{{ $location->location_lv }}" required
                                        data-title="Day {{ $day->number }} locations location (LV)" data-language="lv">
                                </div>
                            </div>
                            <div class="content-sheet__item">
                                <label for="" class="content-sheet__item-title">Description</label>
                                <textarea id="editorEn{{ $day->number }}{{ $key + 1 }}" name="days[{{ $day->number }}][description][]"
                                    class="content-sheet__item-field" data-language="en">{!! $location->description !!}</textarea>
                                <textarea id="editorLv{{ $day->number }}{{ $key + 1 }}" name="days[{{ $day->number }}][description_lv][]"
                                    class="content-sheet__item-field" data-language="lv">{!! $location->description_lv !!}</textarea>
                            </div>
                            <div class="content-sheet__item">
                                <label for="" class="content-sheet__item-title">Image</label>
                                <label class="form__container" id="upload-container">
                                    <div class="dropzone-block">
                                        <img src="{{ asset('images/ic_cloud_upload.svg') }}"
                                            class="img-fluid dropzone-image" alt="">
                                        <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                                    </div>
                                    <input class="form__file" id="upload-files" type="file" accept="image/*"
                                        name="days[{{ $day->number }}][image][]" required
                                        data-title="Day {{ $day->number }} locations image">
                                </label>
                                <div class="form__files-container" id="files-list-container"
                                    data-images="{{ json_encode($location) }}">
                                    <div class="form__image-container js-remove-image" data-index="{{ $key }}">
                                        <img class="form__image" src="{{ $location->url_image }}">
                                    </div>

                                </div>
                            </div>
                            <div class="content-sheet__item">
                                <label for="" class="content-sheet__item-title">Video</label>
                                <label class="form__container" id="upload-container">
                                    <div class="dropzone-block">
                                        <img src="{{ asset('images/ic_cloud_upload.svg') }}"
                                            class="img-fluid dropzone-image" alt="">
                                        <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                                    </div>
                                    <input class="form__file" id="upload-files" type="file" accept="video/*"
                                        name="days[{{ $day->number }}][video][]" required
                                        data-title="Day {{ $day->number }} locations video">
                                </label>
                                <div class="form__files-container" id="files-list-container"
                                    data-videos="{{ json_encode($location) }}">
                                    <div class="form__image-container js-remove-image" data-index="0">
                                        <video class="form__video" src="{{ $location->url_video }}" controls></video>
                                    </div>
                                </div>
                            </div>
                            @if ($key == count($day->locations) - 1)
                                <div class="content-sheet__add-button" onclick="addLocation(event,{{ $day->number }})"
                                    data-location="{{ count($day->locations) }}">
                                    <div class="content-sheet__add-button-text">Add Location</div>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 18 18" fill="none">
                                        <path d="M15.864 9.49995H3.13604" stroke="#919EAB" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                        <path d="M9.5 3.13599V15.8639" stroke="#919EAB" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                </div>
                            @endif
                        @endforeach

                    </div>
                @endforeach
                <div class="content-sheet__add-button" id="addDayButton">
                    <div class="content-sheet__add-button-text">Add day</div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                        fill="none">
                        <path d="M15.864 9.49995H3.13604" stroke="#919EAB" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M9.5 3.13599V15.8639" stroke="#919EAB" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                </div>
            </div>

        </div>
    </form>
    <div class="buttong-group">
        <form id="delete-form{{ $route->id }}" method="POST"
            action="{{ route('articles.destroy', ['article' => $route->id]) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="buttong-group__delete-button">
                <i class="fa fa-trash buttong-group__delete-button-icon"></i>
                <div class="buttong-group__delete-button-text">Delete</div>
            </button>
        </form>
        <button type="submit" form="route" class="buttong-group__save-button">
            <i class="fa fa-save buttong-group__save-button-icon"></i>
            <div class="buttong-group__save-button-text">Publish</div>
        </button>
    </div>

    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>

    <script>
        const enBtn = document.getElementById('enBtn');
        const lvBtn = document.getElementById('lvBtn');
        let fields = document.querySelectorAll('input[data-language], textarea[data-language]');
        window.addEventListener('DOMContentLoaded', function() {
            fields.forEach(function(field) {
                if (field.getAttribute('data-language') !== 'en') {
                    field.style.display = 'none';

                }
            });
            lvBtn.classList.remove('active');
            enBtn.classList.add('active');
        });

        // Обработчик кнопки "EN"
        enBtn.addEventListener('click', function() {
            fields.forEach(function(field) {
                if (field.getAttribute('data-language') !== 'lv') {
                    field.style.display = 'block';

                } else {
                    field.style.display = 'none';
                }
            });
            let enItems = document.querySelectorAll('[id^="editorEn"]');
            enItems.forEach(function(item) {
                let itemId = item.id;
                window[itemId].ui.view.element.style.display = 'block';
            });
            let lvItems = document.querySelectorAll('[id^="editorLv"]');
            lvItems.forEach(function(item) {
                let itemId = item.id;
                window[itemId].ui.view.element.style.display = 'none';
            });
            lvBtn.classList.remove('active');
            enBtn.classList.add('active');
        });

        // Обработчик кнопки "LV"
        lvBtn.addEventListener('click', function() {
            fields.forEach(function(field) {
                if (field.getAttribute('data-language') === 'lv') {
                    field.style.display = 'block';

                } else {
                    field.style.display = 'none';
                }
            });
            let enItems = document.querySelectorAll('[id^="editorEn"]');
            enItems.forEach(function(item) {
                let itemId = item.id;
                window[itemId].ui.view.element.style.display = 'none';
            });
            let lvItems = document.querySelectorAll('[id^="editorLv"]');
            lvItems.forEach(function(item) {
                let itemId = item.id;
                window[itemId].ui.view.element.style.display = 'block';
            });
            enBtn.classList.remove('active');
            lvBtn.classList.add('active');
        });
        const fileListContainer = document.querySelectorAll('#files-list-container');


        // const fileListContainer = document.querySelector('.form__files-container');
        const displayUploadedFiles = () => {
            // Очистите контейнер перед отображением новых загруженных файлов
            fileListContainer.innerHTML = '';
            console.log(FILE_LISTS);

            FILE_LISTS.forEach((fileList, containerIndex) => {
                const imagesData = fileListContainer[containerIndex].dataset.images;
                const videosData = fileListContainer[containerIndex].dataset.videos;
                const fileObjects = [];


                if (imagesData) {
                    const images = JSON.parse(imagesData);
                    if (images.length === undefined) {
                        const imageUrl = images.url_image;

                        // Последний индекс символа `/` в строке filePath
                        const lastSlashIndex = imageUrl.lastIndexOf("/");

                        // Отрезаем все до последнего индекса `/` для получения названия файла с расширением
                        const fileNameWithExtension = imageUrl.substring(lastSlashIndex + 1);

                        // Индекс последней точки в названии файла
                        const lastDotIndex = fileNameWithExtension.lastIndexOf(".");

                        // Получаем название файла
                        const fileName = fileNameWithExtension.substring(0, lastDotIndex);

                        // Получаем расширение файла
                        const extension = fileNameWithExtension.substring(lastDotIndex + 1);
                        const imageName = fileName;
                        const mimeType = `image/${extension}`;
                        fetch(imageUrl)

                            .then(response => response.blob())
                            .then(blob => {
                                const file = new File([blob], imageName, {
                                    type: mimeType
                                });
                                console.log(file);
                                const fileURL = URL.createObjectURL(file);
                                const fileObject = {
                                    name: fileName + "." + extension,
                                    url: fileURL,
                                    file: file,
                                    isVideo: false,
                                    // blobURL: URL.createObjectURL(blob)
                                };

                                fileObjects.push(fileObject);
                                console.log(fileObjects);

                                // все файлы загружены
                                //   FILES_LISTS.push(fileObjects);
                                FILE_LISTS[containerIndex] = fileObjects;

                                const input = document.createElement('input');
                                input.type = 'file';
                                const updatedFiles = new DataTransfer();
                                FILE_LISTS[containerIndex].forEach(file => {
                                    updatedFiles.items.add(new File([file.file],
                                        file
                                        .name, {
                                            type: file.type
                                        }));
                                });
                                input.files = updatedFiles.files;

                                // Update the 'files' property of INPUT_FILES[containerIndex]
                                INPUT_FILES[containerIndex].files = input.files;
                                console.log(FILE_LISTS[containerIndex]);
                                fileList.forEach((file, index) => {
                                    const content =
                                        `<div class="form__image-container js-remove-image" data-index="${index}">${file.isVideo ? `<video class="form__video"src="${file.url}" alt="${file.name}" controls></video>` : `<img class="form__image" src="${file.url}" alt="${file.name}">`}</div>`;
                                    fileListContainer.insertAdjacentHTML(
                                        'beforeEnd',
                                        content);
                                });
                                previewImages(containerIndex);
                                removeFile(containerIndex);

                            });






                    }

                }
                if (videosData) {
                    const images = JSON.parse(videosData);
                    if (images.length === undefined) {
                        const videoUrl = images.url_video;
                        // Последний индекс символа `/` в строке filePath
                        const lastSlashIndex = videoUrl.lastIndexOf("/");

                        // Отрезаем все до последнего индекса `/` для получения названия файла с расширением
                        const fileNameWithExtension = videoUrl.substring(lastSlashIndex + 1);

                        // Индекс последней точки в названии файла
                        const lastDotIndex = fileNameWithExtension.lastIndexOf(".");

                        // Получаем название файла
                        const fileName = fileNameWithExtension.substring(0, lastDotIndex);

                        // Получаем расширение файла
                        const extension = fileNameWithExtension.substring(lastDotIndex + 1);
                        const imageName = fileName;
                        const mimeType = `video/${extension}`;
                        fetch(videoUrl)

                            .then(response => response.blob())
                            .then(blob => {
                                const file = new File([blob], imageName, {
                                    type: mimeType
                                });
                                console.log(file);
                                const fileURL = URL.createObjectURL(file);
                                const fileObject = {
                                    name: fileName + "." + extension,
                                    url: fileURL,
                                    file: file,
                                    isVideo: true,
                                    // blobURL: URL.createObjectURL(blob)
                                };

                                fileObjects.push(fileObject);
                                console.log(fileObjects);

                                // все файлы загружены
                                //   FILES_LISTS.push(fileObjects);
                                FILE_LISTS[containerIndex] = fileObjects;

                                const input = document.createElement('input');
                                input.type = 'file';
                                const updatedFiles = new DataTransfer();
                                FILE_LISTS[containerIndex].forEach(file => {
                                    updatedFiles.items.add(new File([file.file],
                                        file
                                        .name, {
                                            type: file.type
                                        }));
                                });
                                input.files = updatedFiles.files;

                                // Update the 'files' property of INPUT_FILES[containerIndex]
                                INPUT_FILES[containerIndex].files = input.files;
                                console.log(FILE_LISTS[containerIndex]);
                                fileList.forEach((file, index) => {
                                    const content =
                                        `<div class="form__image-container js-remove-image" data-index="${index}">${file.isVideo ? `<video class="form__video"src="${file.url}" alt="${file.name}" controls></video>` : `<img class="form__image" src="${file.url}" alt="${file.name}">`}</div>`;
                                    fileListContainer.insertAdjacentHTML(
                                        'beforeEnd',
                                        content);
                                });
                                previewImages(containerIndex);
                                removeFile(containerIndex);

                            });
                    }
                }
                // FILE_LISTS[containerIndex] = fileObjects;
            });

        };
        window.addEventListener('DOMContentLoaded', displayUploadedFiles);

        let INPUT_FILES = document.querySelectorAll('.form__file');
        let CONTAINERS = document.querySelectorAll('.form__container');
        let FILES_LIST_CONTAINERS = document.querySelectorAll('.form__files-container');
        let FILE_LISTS = [];

        const multipleEvents = (element, eventNames, listener) => {
            const events = eventNames.split(' ');
            events.forEach(event => {
                element.addEventListener(event, listener, false);
            });
        };

        const previewImages = (containerIndex) => {
            FILES_LIST_CONTAINERS[containerIndex].innerHTML = '';
            if (FILE_LISTS[containerIndex].length > 0) {
                FILE_LISTS[containerIndex].forEach((addedFile, index) => {
                    const content = `
        <div class="form__image-container js-remove-image" data-index="${index}">
            ${addedFile.isVideo ? `<video class="form__video" src="${addedFile.url}" alt="${addedFile.name}" controls></video>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    ` : `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <img class="form__image" src="${addedFile.url}" alt="${addedFile.name}">`}
        </div>
    `;
                    FILES_LIST_CONTAINERS[containerIndex].insertAdjacentHTML('beforeEnd', content);
                });
            } else {
                console.log('empty')
                INPUT_FILES[containerIndex].value = "";
            }
        }

        const fileUpload = (containerIndex) => {
            if (FILES_LIST_CONTAINERS[containerIndex]) {
                multipleEvents(INPUT_FILES[containerIndex], 'click dragstart dragover', () => {
                    CONTAINERS[containerIndex].classList.add('active');
                });

                multipleEvents(INPUT_FILES[containerIndex], 'dragleave dragend drop change blur', () => {
                    CONTAINERS[containerIndex].classList.remove('active');
                });

                INPUT_FILES[containerIndex].addEventListener('change', () => {
                    const files = [...INPUT_FILES[containerIndex].files];
                    console.log("changed");
                    if (!FILE_LISTS[containerIndex]) {
                        FILE_LISTS[containerIndex] = [];
                    }
                    files.forEach(file => {

                        const fileURL = URL.createObjectURL(file);
                        const fileName = file.name;
                        const fileExtension = fileName.split('.').pop().toLowerCase();
                        const isVideo =
                            fileExtension === "webm" ||
                            fileExtension === "mp4" ||
                            fileExtension === "ogg";
                        if (!isVideo && !file.type.match("image/")) {
                            alert(file.name + " is neither an image nor a video");
                            console.log(file.type);
                        } else {
                            const uploadedFiles = {
                                name: fileName,
                                url: fileURL,
                                isVideo: isVideo,
                                file: file,
                            };
                            FILE_LISTS[containerIndex].push(uploadedFiles);
                        }
                    });
                    const input = document.createElement('input');
                    input.type = 'file';

                    // Create a new FileList object from the updated array
                    const updatedFiles = new DataTransfer();
                    console.log(FILE_LISTS[containerIndex]);
                    FILE_LISTS[containerIndex].forEach(file => {
                        updatedFiles.items.add(new File([file.file], file.name, {
                            type: file.type
                        }));
                    });
                    input.files = updatedFiles.files;

                    // Update the 'files' property of INPUT_FILES[containerIndex]
                    INPUT_FILES[containerIndex].files = input.files;

                    console.log(FILE_LISTS[containerIndex]); // final list of uploaded files
                    previewImages(containerIndex);
                    removeFile(containerIndex);

                });
            }
        };
        const removeFile = (containerIndex) => {
            const UPLOADED_FILES = FILES_LIST_CONTAINERS[containerIndex].querySelectorAll(".js-remove-image");

            UPLOADED_FILES.forEach(image => {
                image.addEventListener('click', function() {
                    const index = parseInt(this.getAttribute('data-index'));
                    FILE_LISTS[containerIndex].splice(index, 1);

                    // Create a temporary input element
                    const input = document.createElement('input');
                    input.type = 'file';

                    // Create a new FileList object from the updated array
                    const updatedFiles = new DataTransfer();
                    FILE_LISTS[containerIndex].forEach(file => {
                        updatedFiles.items.add(new File([file.file], file.name, {
                            type: file.type
                        }));
                    });
                    input.files = updatedFiles.files;

                    // Update the 'files' property of INPUT_FILES[containerIndex]
                    INPUT_FILES[containerIndex].files = input.files;

                    previewImages(containerIndex);
                    removeFile(
                        containerIndex
                    ); // Call the function again to ensure event listeners are reattached
                });
            });
        };
        for (let i = 0; i < INPUT_FILES.length; i++) {
            FILE_LISTS.push([])
            fileUpload(i);
        }




        $('#multiple-select-categories-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true
        });
        $('#multiple-select-availability-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true
        });
        $('#multiple-select-regions-field').select2({
            theme: "bootstrap-5",
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '' : 'style',
            placeholder: $(this).data('placeholder'),
            closeOnSelect: false,
            tags: true
        });
        Dropzone.options.myGreatDropzone = { // camelized version of the `id`
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 2, // MB
            autoProcessQueue: false,
        };

        //Добавление локации
        function addLocation(event, day = 1) {
            let addButton = event.currentTarget;
            let dataLocation = addButton.dataset.location;
            addButton.onclick = function(event) {
                addLocation(event, dataLocation + 1);
            };
            addButton.setAttribute('data-location', +dataLocation + 1);
            let locationCount = +dataLocation + 1;
            const newItem = document.createElement('div');
            newItem.innerHTML;
            newItem.innerHTML = `<div class="content-sheet__location-block">
                <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Title of the location</label>
                        <input type="text" class="content-sheet__item-field" placeholder="Title of the location"
                            name="days[${dayCount}][location_title][]" required data-title="Day ${dayCount} locations title" data-language="en">
                            <input type="text" class="content-sheet__item-field" placeholder="Title of the location (LV)"
                            name="days[${dayCount}][location_title_lv][]" required data-title="Day ${dayCount} locations title (LV)" data-language="lv">
                    </div>
                        <div class="content-sheet__item">
                            <label for="" class="content-sheet__item-title">Location</label>
                            <input type="text" class="content-sheet__item-field" placeholder="Location"
                                name="days[${dayCount}][location][]" required data-title="Day ${dayCount} locations location" data-language="en">
                                <input type="text" class="content-sheet__item-field" placeholder="Location (LV)"
                                name="days[${dayCount}][location_lv][]" required data-title="Day ${dayCount} locations location (LV)" data-language="lv">
                        </div>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Description</label>
                        <textarea id="editorEn${dayCount}${locationCount}" name="days[${dayCount}][description][]" class="content-sheet__item-field" data-language="en"></textarea>
                        <textarea id="editorLv${dayCount}${locationCount}" name="days[${dayCount}][description_lv][]" class="content-sheet__item-field" data-language="lv"></textarea>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Image</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="image/*"
                                name="days[${dayCount}][image][]" required data-title="Day ${dayCount} locations image">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Video</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="video/*"
                                name="days[${dayCount}][video][]" required data-title="Day ${dayCount} locations video">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
  `;

            const activeLanguage = enBtn.classList.contains('active') ? 'en' : 'lv';
            fieldsNewBlock = newItem.querySelectorAll('input[data-language], textarea[data-language]');;
            fieldsNewBlock.forEach(function(field) {
                if (field.getAttribute('data-language') == activeLanguage) {
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                }
            });

            const parentBlock = addButton.parentElement;
            parentBlock.insertBefore(newItem, addButton);
            CKEDITOR.ClassicEditor.create(document.getElementById(`editorEn${dayCount}${locationCount}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            }).then(function(editor) {
                let var_name = `editorEn${dayCount}${locationCount}`;
                window[var_name] = editor;
                activeLanguage == 'en' ? editor.ui.view.element.style.display = 'block' : editor.ui.view.element
                    .style.display = 'none';
            });
            CKEDITOR.ClassicEditor.create(document.getElementById(`editorLv${dayCount}${locationCount}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome... (LV)',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            }).then(function(editor) {
                let var_name = `editorLv${dayCount}${locationCount}`;
                window[var_name] = editor;
                activeLanguage == 'lv' ? editor.ui.view.element.style.display = 'block' : editor.ui.view.element
                    .style.display = 'none';
            });
            fields = document.querySelectorAll('input[data-language], textarea[data-language]');
            // Обновляем списки элементов
            INPUT_FILES = document.querySelectorAll('.form__file');
            CONTAINERS = document.querySelectorAll('.form__container');
            FILES_LIST_CONTAINERS = document.querySelectorAll('.form__files-container');
            FILE_LISTS = [];

            // Применяем загрузку файла к новому блоку
            for (let i = 0; i < FILES_LIST_CONTAINERS.length; i++) {
                fileUpload(i);
            }
            CKEDITOR.ClassicEditor.create(document.getElementById(`editor${dayCount}${locationCount}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            });
        }

        //Добавление дня
        let dayCount = {{ count($route->days) }};
        const addDayButton = document.getElementById('addDayButton');
        const contentSheetWrapper = document.getElementById('content-sheet__days-block');

        addDayButton.addEventListener('click', () => {
            let locationCount = 1;
            dayCount++;

            const newBlock = document.createElement('div');
            newBlock.classList.add('content-sheet__inner-block');
            newBlock.innerHTML = `
            <div class="content-sheet__inner-block">
                <div class="content-sheet__inner-block-title">
                    Day ${dayCount}
                </div>
                <img src="{{ asset('images/Vector 955.svg') }}" class="content-sheet__line" alt="">
                <div class="content-sheet__item">
                    <label for="" class="content-sheet__item-title">Name of the day</label>
                    <input type="text" class="content-sheet__item-field" placeholder="Name of the day" name="days[${dayCount}][title]" required data-title="Day ${dayCount} name" data-language="en">
                    <input type="text" class="content-sheet__item-field" placeholder="Name of the day (LV)" name="days[${dayCount}][title_lv]" required data-title="Day ${dayCount} name (LV)" data-language="lv">
                </div>
                <div class="content-sheet__location-block">
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Title of the location</label>
                        <input type="text" class="content-sheet__item-field" placeholder="Title of the location"  name="days[${dayCount}][location_title][]" required data-title="Day ${dayCount} locations title" data-language="en">
                        <input type="text" class="content-sheet__item-field" placeholder="Title of the location (LV)"  name="days[${dayCount}][location_title_lv][]" required data-title="Day ${dayCount} locations title (LV)" data-language="lv">
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Location</label>
                        <input type="text" class="content-sheet__item-field" placeholder="Location"  name="days[${dayCount}][location][]" required data-title="Day ${dayCount} locations location" data-language="en">
                        <input type="text" class="content-sheet__item-field" placeholder="Location (LV)"  name="days[${dayCount}][location_lv][]" required data-title="Day ${dayCount} locations location (LV)" data-language="lv">
                    </div>
                </div>
                <div class="content-sheet__item">
                    <label for="" class="content-sheet__item-title">Description</label>
                    <textarea id="editorEn${dayCount}${locationCount}" name="days[${dayCount}][description][]" class="content-sheet__item-field" data-language="en"></textarea>
                    <textarea id="editorLv${dayCount}${locationCount}" name="days[${dayCount}][description_lv][]" class="content-sheet__item-field" data-language="lv"></textarea>
                </div>
                <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Image</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="image/*" name="days[${dayCount}][image][]" required data-title="Day ${dayCount} locations image">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Video</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="video/*" name="days[${dayCount}][video][]" required data-title="Day ${dayCount} locations video">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                    <div class="content-sheet__add-button" onclick="addLocation(event,${dayCount})" data-location="1">
                        <div class="content-sheet__add-button-text">Add Location</div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                            fill="none">
                            <path d="M15.864 9.49995H3.13604" stroke="#919EAB" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M9.5 3.13599V15.8639" stroke="#919EAB" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
            </div>
    `;
            const activeLanguage = enBtn.classList.contains('active') ? 'en' : 'lv';
            fieldsNewBlock = newBlock.querySelectorAll(`input[data-language]`);
            fieldsNewBlock.forEach(function(field) {
                if (field.getAttribute('data-language') == activeLanguage) {
                    console.log(field);
                    field.style.display = 'block';
                } else {
                    field.style.display = 'none';
                }
            });
            contentSheetWrapper.insertBefore(newBlock, addDayButton);
            CKEDITOR.ClassicEditor.create(document.getElementById(`editorEn${dayCount}${locationCount}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            }).then(function(editor) {
                let var_name = `editorEn${dayCount}${locationCount}`;
                window[var_name] = editor;
                activeLanguage == 'en' ? editor.ui.view.element.style.display = 'block' : editor.ui.view
                    .element
                    .style.display = 'none';
            });
            CKEDITOR.ClassicEditor.create(document.getElementById(`editorLv${dayCount}${locationCount}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome... (LV)',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            }).then(function(editor) {
                let var_name = `editorLv${dayCount}${locationCount}`;
                window[var_name] = editor;
                activeLanguage == 'lv' ? editor.ui.view.element.style.display = 'block' : editor.ui.view
                    .element
                    .style.display = 'none';
            });
            fields = document.querySelectorAll('input[data-language], textarea[data-language]');
            // Обновляем списки элементов
            INPUT_FILES = document.querySelectorAll('.form__file');
            CONTAINERS = document.querySelectorAll('.form__container');
            FILES_LIST_CONTAINERS = document.querySelectorAll('.form__files-container');
            FILE_LISTS = [];

            for (let i = 0; i < FILES_LIST_CONTAINERS.length; i++) {
                fileUpload(i);
            }

        });
        lvBtn.classList.remove('active');
        enBtn.classList.add('active');
        let activeLanguageStart = enBtn.classList.contains('active') ? 'en' : 'lv';
        console.log(activeLanguageStart);
        var editorsEn = document.querySelectorAll('[id^="editorEn"]');
        editorsEn.forEach(function(editor) {
            CKEDITOR.ClassicEditor.create(document.getElementById(`${editor.id}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            }).then(function(editorItem) {
                let var_name = editor.id;
                window[var_name] = editorItem;
                activeLanguageStart == 'en' ? editorItem.ui.view.element.style.display = 'block' :
                    editorItem.ui
                    .view.element
                    .style.display = 'none';
            })
        });
        var editorsLv = document.querySelectorAll('[id^="editorLv"]');
        editorsLv.forEach(function(editor) {
            CKEDITOR.ClassicEditor.create(document.getElementById(`${editor.id}`), {
                // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript',
                        'superscript',
                        'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock',
                        'htmlEmbed',
                        '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
                // Changing the language of the interface requires loading the language file using the <script> tag.
                // language: 'es',
                list: {
                    properties: {
                        styles: true,
                        startIndex: true,
                        reversed: true
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/headings.html#configuration
                heading: {
                    options: [{
                            model: 'paragraph',
                            title: 'Paragraph',
                            class: 'ck-heading_paragraph'
                        },
                        {
                            model: 'heading1',
                            view: 'h1',
                            title: 'Heading 1',
                            class: 'ck-heading_heading1'
                        },
                        {
                            model: 'heading2',
                            view: 'h2',
                            title: 'Heading 2',
                            class: 'ck-heading_heading2'
                        },
                        {
                            model: 'heading3',
                            view: 'h3',
                            title: 'Heading 3',
                            class: 'ck-heading_heading3'
                        },
                        {
                            model: 'heading4',
                            view: 'h4',
                            title: 'Heading 4',
                            class: 'ck-heading_heading4'
                        },
                        {
                            model: 'heading5',
                            view: 'h5',
                            title: 'Heading 5',
                            class: 'ck-heading_heading5'
                        },
                        {
                            model: 'heading6',
                            view: 'h6',
                            title: 'Heading 6',
                            class: 'ck-heading_heading6'
                        }
                    ]
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/editor-placeholder.html#using-the-editor-configuration
                placeholder: 'Write something awesome...',
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-family-feature
                fontFamily: {
                    options: [
                        'default',
                        'Arial, Helvetica, sans-serif',
                        'Courier New, Courier, monospace',
                        'Georgia, serif',
                        'Lucida Sans Unicode, Lucida Grande, sans-serif',
                        'Tahoma, Geneva, sans-serif',
                        'Times New Roman, Times, serif',
                        'Trebuchet MS, Helvetica, sans-serif',
                        'Verdana, Geneva, sans-serif'
                    ],
                    supportAllValues: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/font.html#configuring-the-font-size-feature
                fontSize: {
                    options: [10, 12, 14, 'default', 18, 20, 22],
                    supportAllValues: true
                },
                // Be careful with the setting below. It instructs CKEditor to accept ALL HTML markup.
                // https://ckeditor.com/docs/ckeditor5/latest/features/general-html-support.html#enabling-all-html-features
                htmlSupport: {
                    allow: [{
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }]
                },
                // Be careful with enabling previews
                // https://ckeditor.com/docs/ckeditor5/latest/features/html-embed.html#content-previews
                htmlEmbed: {
                    showPreviews: true
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/link.html#custom-link-attributes-decorators
                link: {
                    decorators: {
                        addTargetToExternalLinks: true,
                        defaultProtocol: 'https://',
                        toggleDownloadable: {
                            mode: 'manual',
                            label: 'Downloadable',
                            attributes: {
                                download: 'file'
                            }
                        }
                    }
                },
                // https://ckeditor.com/docs/ckeditor5/latest/features/mentions.html#configuration
                mention: {
                    feeds: [{
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy',
                            '@canes',
                            '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake',
                            '@gingerbread',
                            '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum',
                            '@pudding',
                            '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }]
                },
                // The "super-build" contains more premium features that require additional configuration, disable them below.
                // Do not turn them on unless you read the documentation and know how to configure them and setup the editor.
                removePlugins: [
                    // These two are commercial, but you can try them out without registering to a trial.
                    // 'ExportPdf',
                    // 'ExportWord',
                    'CKBox',
                    'CKFinder',
                    'EasyImage',
                    // This sample uses the Base64UploadAdapter to handle image uploads as it requires no configuration.
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/base64-upload-adapter.html
                    // Storing images as Base64 is usually a very bad idea.
                    // Replace it on production website with other solutions:
                    // https://ckeditor.com/docs/ckeditor5/latest/features/images/image-upload/image-upload.html
                    // 'Base64UploadAdapter',
                    'RealTimeCollaborativeComments',
                    'RealTimeCollaborativeTrackChanges',
                    'RealTimeCollaborativeRevisionHistory',
                    'PresenceList',
                    'Comments',
                    'TrackChanges',
                    'TrackChangesData',
                    'RevisionHistory',
                    'Pagination',
                    'WProofreader',
                    // Careful, with the Mathtype plugin CKEditor will not load when loading this sample
                    // from a local file system (file://) - load this site via HTTP server if you enable MathType.
                    'MathType',
                    // The following features are part of the Productivity Pack and require additional license.
                    'SlashCommand',
                    'Template',
                    'DocumentOutline',
                    'FormatPainter',
                    'TableOfContents',
                    'PasteFromOfficeEnhanced'
                ]
            }).then(function(editorItem) {
                let var_name = editor.id;
                window[var_name] = editorItem;
                activeLanguageStart == 'lv' ? editorItem.ui.view.element.style.display = 'block' :
                    editorItem.ui
                    .view
                    .element
                    .style.display = 'none';
            })
        });

        function checkRequiredFields() {
            let requiredFields = document.querySelectorAll('[required]');

            let emptyFields = [];
            requiredFields.forEach(field => {
                let fieldName = field.getAttribute('data-title');
                let fieldValue = field.value.trim();

                if (fieldValue === '') {
                    emptyFields.push(fieldName);
                }
            });

            if (emptyFields.length > 0) {
                let emptyFieldsString = emptyFields.join(', ');
                alert('Fields not filled in: ' + emptyFieldsString);
            } else {
                document.getElementById('route').submit();
            }
        }

        document.querySelector('.buttong-group__save-button').addEventListener('click', function(event) {
            event.preventDefault();
            checkRequiredFields();
        });
    </script>
@endsection
