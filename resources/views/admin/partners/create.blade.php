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
    <h1 class="m-0 text-dark">Adding a partner</h1>
@endsection
@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('partners.index') }}">Partners</a></li>
            <li class="breadcrumb-item active">Adding a partner</li>
        </ol>
    </div>
@endsection
@section('content')
    <form method="POST" action="{{ route('partners.store') }}" form="route" id="route" enctype="multipart/form-data">
        @csrf

        <div class="content-sheet">
            <div class="content-sheet__title">Partners</div>
            <div class="content-sheet__days-block" id="content-sheet__days-block">
                <div class="content-sheet__inner-block">
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Title of the partner</label>
                        <input type="text" class="content-sheet__item-field" placeholder="Title of the partner"
                            name="partner[1][title]" required data-title="Partner 1 partner" data-language="en">
                    </div>

                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">
                            Partner link</label>
                        <input type="text" class="content-sheet__item-field" placeholder="Partner link"
                            name="partner[1][url]" required data-title="Partner 1 link" data-language="en">

                    </div>
                    <div class="content-sheet__item">
                        <label for="" class="content-sheet__item-title">Image of partner</label>
                        <label class="form__container" id="upload-container">
                            <div class="dropzone-block">
                                <img src="{{ asset('images/ic_cloud_upload.svg') }}" class="img-fluid dropzone-image"
                                    alt="">
                                <div class="dropzone-text">Drag and drop files here or click to upload.</div>
                            </div>
                            <input class="form__file" id="upload-files" type="file" accept="image/*"
                                name="partner[1][url_image]" required data-title="Partner 1 image">
                        </label>
                        <div class="form__files-container" id="files-list-container"></div>
                    </div>
                </div>

            </div>
        </div>
    </form>
    <div class="buttong-group justify-content-end">
        <button type="submit" form="route" class="buttong-group__save-button">
            <i class="fa fa-save buttong-group__save-button-icon"></i>
            <div class="buttong-group__save-button-text">Publish</div>
        </button>
    </div>


    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
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
                    ${addedFile.isVideo ? `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <video class="form__video" src="${addedFile.url}" alt="${addedFile.name}" controls></video>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        ` : `
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            <img class="form__image" src="${addedFile.url}" alt="${addedFile.name}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        `}
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
                            };

                            FILE_LISTS[containerIndex].push(uploadedFiles);
                        }
                    });

                    console.log(FILE_LISTS[containerIndex]); // final list of uploaded files
                    previewImages(containerIndex);
                    removeFile(containerIndex);
                });
            }
        };


        const removeFile = (containerIndex) => {
            const UPLOADED_FILES = FILES_LIST_CONTAINERS[containerIndex].querySelectorAll(".js-remove-image");

            if (UPLOADED_FILES) {
                UPLOADED_FILES.forEach(image => {
                    image.addEventListener('click', function() {
                        const index = parseInt(image.dataset.index);
                        FILE_LISTS[containerIndex].splice(index, 1);
                        previewImages(containerIndex);
                    });
                });
            }
        };
        for (let i = 0; i < INPUT_FILES.length; i++) {
            FILE_LISTS.push([])
            fileUpload(i);
        }





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
