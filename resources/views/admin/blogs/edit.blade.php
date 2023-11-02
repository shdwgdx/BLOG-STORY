@extends('layouts.admin')
@push('scripts')
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
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
    <h1 class="m-0 text-dark">Editing an article</h1>
    <div>
        <button id="enBtn">EN</button>
        <button id="lvBtn">LV</button>
    </div>
@endsection
@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('articles.index') }}">Articles</a></li>
            <li class="breadcrumb-item active">Editing an article</li>
        </ol>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('articles.update', ['article' => $blog->id]) }}" form="route" id="route"
        enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="content-sheet">
            <div class="content-sheet__title">Article</div>
            <div class="content-sheet__days-block">
                <div class="content-sheet__inner-block">
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Title of the article</label>
                        <input type="text" class="content-sheet__item-field" placeholder="Title of the article"
                            name="title" value="{{ $blog->title }}" required data-title="Article title"
                            data-language="en">
                        <input type="text" class="content-sheet__item-field" placeholder="Title of the article (LV)"
                            name="title_lv" value="{{ $blog->title_lv }}" required data-title="Article title (LV)"
                            data-language="lv">
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Add route</label>
                        <select class="content-sheet__item-field" name="route_id" data-title="Article route" required>
                            <option selected value="">Choose the route</option>
                            @foreach ($routes as $route)
                                <option {{ $route->id === $blog->route_id ? 'selected' : '' }} value="{{ $route->id }}">
                                    {{ $route->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Description</label>
                        <textarea id="editor" name="description" class="content-sheet__item-field" data-language="en">{{ $blog->description }}</textarea>
                        <textarea id="editor-lv" name="description_lv" class="content-sheet__item-field" data-language="lv">{{ $blog->description_lv }}</textarea>
                    </div>

                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Images</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="image/*" name="images[]"
                                multiple required data-title="Article images">
                        </label>
                        <div class="form__files-container" id="files-list-container"
                            data-images="{{ json_encode($blog->images) }}">
                            @foreach ($blog->images as $key => $image)
                                <div class="form__image-container js-remove-image" data-index="{{ $key }}">
                                    <img class="form__image" src="{{ $image->url }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Videos</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="video/*" name="videos[]"
                                required multiple data-title="Article videos">
                        </label>
                        <div class="form__files-container" id="files-list-container"
                            data-videos="{{ json_encode($blog->videos) }}">
                            @foreach ($blog->videos as $key => $video)
                                <div class="form__image-container js-remove-image" data-index="{{ $key }}">
                                    <video class="form__video" src="{{ $video->url }}" controls></video>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div class="content-sheet">
            <div class="content-sheet__title">Stories</div>
            <div class="content-sheet__days-block" id="content-sheet__days-block">
                @foreach ($blog->stories as $key => $story)
                    <div class="content-sheet__inner-block">
                        <div class="content-sheet__item">
                            <label for="" class="content-sheet__item-title">Title of the story</label>
                            <input type="text" class="content-sheet__item-field" placeholder="Title of the story"
                                name="story[{{ $key + 1 }}][title]" value="{{ $story->title }}" required
                                data-title="Story {{ $key + 1 }} title" data-language="en">
                            <input type="text" class="content-sheet__item-field" placeholder="Title of the story"
                                name="story[{{ $key + 1 }}][title_lv]" value="{{ $story->title_lv }}" required
                                data-title="Story {{ $key + 1 }} title" data-language="lv">
                        </div>
                        <div class="content-sheet__item">
                            <label for="" class="content-sheet__item-title">Description of the story</label>
                            <input type="text" class="content-sheet__item-field"
                                placeholder="Description of the story" name="story[{{ $key + 1 }}][description]"
                                value="{{ $story->description }}" required
                                data-title="Story {{ $key + 1 }} description" data-language="en">
                            <input type="text" class="content-sheet__item-field"
                                placeholder="Description of the story" name="story[{{ $key + 1 }}][description_lv]"
                                value="{{ $story->description_lv }}" required
                                data-title="Story {{ $key + 1 }} description (LV)" data-language="lv">
                        </div>
                        <div class="content-sheet__location-block">
                            <div class="content-sheet__item">
                                <label for="" class="content-sheet__item-title">Location</label>
                                <input type="text" class="content-sheet__item-field" placeholder="Location"
                                    name="story[{{ $key + 1 }}][location]" value="{{ $story->location }}" required
                                    data-title="Story {{ $key + 1 }} location" data-language="en">
                                <input type="text" class="content-sheet__item-field" placeholder="Location"
                                    name="story[{{ $key + 1 }}][location_lv]" value="{{ $story->location_lv }}"
                                    required data-title="Story {{ $key + 1 }} location (LV)" data-language="lv">
                            </div>
                        </div>
                        <div class="content-sheet__item">
                            <label for="" class="content-sheet__item-title">Image of story</label>
                            <label class="form__container" id="upload-container">
                                <div class="dropzone-block">
                                    <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                        alt="">
                                    <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                                </div>
                                <input class="form__file" id="upload-files" type="file" accept="image/*"
                                    name="story[{{ $key + 1 }}][required_image]" required
                                    data-title="Story {{ $key + 1 }} image of story">
                            </label>
                            <div class="form__files-container" id="files-list-container"
                                data-image="{{ json_encode($story) }}">
                                <div class="form__image-container js-remove-image" data-index="0">
                                    <img class="form__image" src="{{ $story->required_image }}">
                                </div>
                            </div>
                        </div>
                        <div class="content-sheet__item">
                            <label for="" class="content-sheet__item-title">Image/Video</label>
                            <label class="form__container" id="upload-container">
                                <div class="dropzone-block">
                                    <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                        alt="">
                                    <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                                </div>
                                <input class="form__file" id="upload-files" type="file" accept="video/* image/*"
                                    name="story[{{ $key + 1 }}][video]" required
                                    data-title="Story {{ $key + 1 }} image/video">
                            </label>
                            <div class="form__files-container" id="files-list-container"
                                @if ($story->url_video) data-videos="{{ json_encode($story) }}">
                            @else
                            data-images="{{ json_encode($story) }}"> @endif
                                <div class="form__image-container js-remove-image" data-index="0">
                                @if ($story->url_video)
                                    <video class="form__video" src="{{ $story->url_video }}" controls></video>
                                @else
                                    <img class="form__image" src="{{ $story->url_image }}">
                                @endif

                            </div>
                        </div>
                    </div>
            </div>
            @endforeach
            <div class="content-sheet__add-button" id="addDayButton">
                <div class="content-sheet__add-button-text">Add stories</div>
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
        <form id="delete-form{{ $blog->id }}" method="POST"
            action="{{ route('articles.destroy', ['article' => $blog->id]) }}">
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
                    if (field.tagName === 'TEXTAREA') {
                        editorEn.ui.view.element.style.display =
                            'block'; // отображение CKEditor для английского языка
                        editorLv.ui.view.element.style.display =
                            'none'; // скрытие CKEditor для латышского языка
                    }
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
                    if (field.tagName === 'TEXTAREA') {
                        field.style.display = 'none';
                        editorEn.ui.view.element.style.display =
                            'block'; // отображение CKEditor для английского языка
                        editorLv.ui.view.element.style.display =
                            'none'; // скрытие CKEditor для латышского языка
                    }
                } else {
                    field.style.display = 'none';
                }
            });
            lvBtn.classList.remove('active');
            enBtn.classList.add('active');
        });

        // Обработчик кнопки "LV"
        lvBtn.addEventListener('click', function() {
            fields.forEach(function(field) {
                if (field.getAttribute('data-language') === 'lv') {
                    field.style.display = 'block';
                    if (field.tagName === 'TEXTAREA') {
                        field.style.display = 'none';
                        editorEn.ui.view.element.style.display =
                            'none'; // скрытие CKEditor для английского языка
                        editorLv.ui.view.element.style.display =
                            'block'; // отображение CKEditor для латышского языка
                    }
                } else {
                    field.style.display = 'none';
                }
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
                const imageData = fileListContainer[containerIndex].dataset.image;
                const videosData = fileListContainer[containerIndex].dataset.videos;
                const fileObjects = [];
                if (videosData) {
                    const videos = JSON.parse(videosData);
                    if (videos.length === undefined) {

                        const imageUrl = videos.url_video;
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
                        const mimeType = `video/${extension}`;
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

                    } else {

                        videos.forEach((image, index) => {

                            const imageUrl = image.url;
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
                            const mimeType = `video/${extension}`;

                            fetch(imageUrl)

                                .then(response => response.blob())
                                .then(blob => {
                                    const file = new File([blob], imageName, {
                                        type: mimeType
                                    });
                                    const fileURL = URL.createObjectURL(file);
                                    const fileObject = {
                                        name: fileName + "." + extension,
                                        url: fileURL,
                                        file: file,
                                        isVideo: true,
                                        // blobURL: URL.createObjectURL(blob)
                                    };

                                    fileObjects.push(fileObject);

                                    if (fileObjects.length === videos.length) {
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
                                    }
                                });
                        });
                    }
                }
                if (imagesData) {
                    const images = JSON.parse(imagesData);
                    console.log(images.length);
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
                        const mimeType = `video/${extension}`;
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

                    } else {
                        images.forEach((image, index) => {

                            const imageUrl = image.url;
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
                                    const fileURL = URL.createObjectURL(file);
                                    const fileObject = {
                                        name: fileName + "." + extension,
                                        url: fileURL,
                                        file: file,
                                        // blobURL: URL.createObjectURL(blob)
                                    };

                                    fileObjects.push(fileObject);

                                    if (fileObjects.length === images.length) {
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
                                    }
                                });
                        });
                    }

                }
                if (imageData) {
                    const images = JSON.parse(imageData);
                    console.log(images.length);
                    if (images.length === undefined) {
                        const imageUrl = images.required_image;
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
                        const mimeType = `video/${extension}`;
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

                    } else {
                        images.forEach((image, index) => {

                            const imageUrl = image.url;
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
                                    const fileURL = URL.createObjectURL(file);
                                    const fileObject = {
                                        name: fileName + "." + extension,
                                        url: fileURL,
                                        file: file,
                                        // blobURL: URL.createObjectURL(blob)
                                    };

                                    fileObjects.push(fileObject);

                                    if (fileObjects.length === images.length) {
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
                                    }
                                });
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
                        if (!isVideo) {
                            const uploadedFiles = {
                                name: fileName,
                                url: fileURL,
                                isVideo: false,
                                file: file,
                            };
                            FILE_LISTS[containerIndex].push(uploadedFiles);
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

        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
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
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
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
            // CKEditor загружен, можно использовать editorEn
            editorEn = editor;
        });
        CKEDITOR.ClassicEditor.create(document.getElementById("editor-lv"), {
            // https://ckeditor.com/docs/ckeditor5/latest/features/toolbar/toolbar.html#extended-toolbar-configuration-format
            toolbar: {
                items: [
                    'exportPDF', 'exportWord', '|',
                    'findAndReplace', 'selectAll', '|',
                    'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript',
                    'removeFormat', '|',
                    'bulletedList', 'numberedList', 'todoList', '|',
                    'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    'link', 'insertImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed',
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
                        '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes',
                        '@chocolate', '@cookie', '@cotton', '@cream',
                        '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread',
                        '@gummi', '@ice', '@jelly-o',
                        '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding',
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
            // CKEditor загружен, можно использовать editorEn
            editorLv = editor;
        });


        //Добавление локации
        function addLocation(event, day = 1) {
            const addButton = event.currentTarget;

            const newItem = document.createElement('div');
            newItem.classList.add('content-sheet__item');
            newItem.innerHTML = `
    <label for="" class="content-sheet__item-title">Location</label>
    <input type="text" class="content-sheet__item-field" placeholder="Location"  name="days[${day}][location][]" >
  `;

            const parentBlock = addButton.parentElement;
            parentBlock.insertBefore(newItem, addButton);
        }

        //Добавление дня

        let storyCount = {{ count($blog->stories) }};
        const addDayButton = document.getElementById('addDayButton');
        const contentSheetWrapper = document.getElementById('content-sheet__days-block');

        addDayButton.addEventListener('click', () => {
            storyCount++;

            const newBlock = document.createElement('div');
            newBlock.classList.add('content-sheet__inner-block');
            newBlock.innerHTML = `
    <div class="content-sheet__inner-block">
        <div class="content-sheet__item">
            <label for="" class="content-sheet__item-title">Title of the story</label>
            <input type="text" class="content-sheet__item-field" placeholder="Title of the story"
                name="story[${storyCount}][title]" required data-title="Story ${storyCount} title" data-language="en">
            <input type="text" class="content-sheet__item-field" placeholder="Title of the story (LV)"
                name="story[${storyCount}][title_lv]" required data-title="Story ${storyCount} title (LV)" data-language="lv">
        </div>
        <div class="content-sheet__item">
            <label for="" class="content-sheet__item-title">Description of the story</label>
            <input type="text" class="content-sheet__item-field" placeholder="Description of the story"
                name="story[${storyCount}][description]" required data-title="Story ${storyCount} description" data-language="en">
            <input type="text" class="content-sheet__item-field" placeholder="Description of the story (LV)"
                name="story[${storyCount}][description_lv]" required data-title="Story ${storyCount} description (LV)" data-language="lv">
        </div>
        <div class="content-sheet__location-block">
            <div class="content-sheet__item">
                <label for="" class="content-sheet__item-title">Location</label>
                <input type="text" class="content-sheet__item-field" placeholder="Location"
                    name="story[${storyCount}][location]" required data-title="Story ${storyCount} location" data-language="en">
                <input type="text" class="content-sheet__item-field" placeholder="Location (LV)"
                    name="story[${storyCount}][location_lv]" required data-title="Story ${storyCount} location (LV)" data-language="lv">
            </div>
        </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Image of story</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="image/*"
                                name="story[${storyCount}][required_image]" required data-title="Story ${storyCount} required_image">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Image/Video</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="video/* image/*"
                                name="story[${storyCount}][video]" required data-title="Story ${storyCount} video">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
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
            fields = document.querySelectorAll('input[data-language], textarea[data-language]');
            // Обновляем списки элементов
            INPUT_FILES = document.querySelectorAll('.form__file');
            CONTAINERS = document.querySelectorAll('.form__container');
            FILES_LIST_CONTAINERS = document.querySelectorAll('.form__files-container');
            FILE_LISTS = [];

            // Применяем загрузку файла к новому блоку
            fileUpload(FILES_LIST_CONTAINERS.length - 1);
            fileUpload(FILES_LIST_CONTAINERS.length - 2);
            // for (let i = 0; i < FILES_LIST_CONTAINERS.length; i++) {
            //     fileUpload(i);
            // }

        });

        // // Применяем загрузку файла к изначальным блокам
        // for (let i = 0; i < FILES_LIST_CONTAINERS.length; i++) {
        //     fileUpload(i);
        // }
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
